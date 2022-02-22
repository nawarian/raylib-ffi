<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Command;

use FFI\CData;
use Laminas\Code\DeclareStatement;
use Laminas\Code\Generator\AbstractMemberGenerator;
use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\FileGenerator;
use Nawarian\Raylib\Generator\CustomMethodGenerator;
use Nawarian\Raylib\Generator\CustomParameterGenerator;
use Nawarian\Raylib\Generator\CustomPropertyGenerator;
use RuntimeException;
use stdClass;

final class GenerateRaylibWrappers
{
    private const OUTPUT_DIR = __DIR__ . '/../../generated';
    private const SKIP_FUNCTIONS = [
        'SetTraceLogCallback',
        'TraceLog',
        'SetLoadFileDataCallback',
        'SetSaveFileDataCallback',
        'SetLoadFileTextCallback',
        'SetSaveFileTextCallback',
        'TextFormat',
        'TextJoin',
    ];

    private static array $knownTypes = [];

    public static function generate(): void
    {
        $spec = json_decode(file_get_contents(__DIR__ . '/../../resources/raylib_api.json'));

        foreach ($spec->structs as $struct) {
            self::generateTypeFromDefinition($struct);
        }

        self::$knownTypes = array_unique(self::$knownTypes);

        $fileGenerator = new FileGenerator();
        $functions = [];
        $uses = [];
        foreach ($spec->functions as $function) {
            if (in_array($function->name, self::SKIP_FUNCTIONS)) {
                continue;
            }

            $functionDefinition = self::generateFunctionFromDefinition($function);

            $functions[] = $functionDefinition->generate();
        }

        $fileGenerator
            ->setDeclares([DeclareStatement::strictTypes(1)])
            ->setUses($uses)
            ->setBody(implode(PHP_EOL, $functions))
            ->setFilename(self::OUTPUT_DIR . '/functions.php')
            ->setNamespace('Nawarian\\Raylib\\Generated')
            ->write();
    }

    private static function generateFunctionFromDefinition(stdClass $definition): CustomMethodGenerator
    {
        $method = new CustomMethodGenerator();
        $method
            ->setDocBlock(new DocBlockGenerator($definition->description))
            ->setName($definition->name)
            ->removeFlag(AbstractMemberGenerator::FLAG_PUBLIC)
            ->setIndentation('');

        $params = [];
        foreach ($definition->params ?? [] as $key => $param) {
            $paramGen = new CustomParameterGenerator("param{$key}");
            $paramGen->setType(self::getTypeFromParam($param));
            $params[] = $paramGen;
        }

        $method
            ->setParameters($params)
            ->setReturnType(self::getTypeFromParam($definition->returnType));

        $paramsStr = implode(
            ', ',
            array_map(function (CustomParameterGenerator $param) {
                $toCData = self::shouldCallToCData($param->getType()) ? '->toCData()' : '';

                return "\${$param->getName()}{$toCData}";
            }, $params)
        );
        $returnType = $method->getReturnType()->generate();
        $returnStr = $returnType !== 'void' ? 'return ' : '';

        $raylibGlobalVar = '$raylib';
        $methodBody = ["global {$raylibGlobalVar};"];

        if (in_array($returnType, self::$knownTypes)) {
            $methodBody[] = "return {$returnType}::fromCData({$raylibGlobalVar}->{$definition->name}({$paramsStr}));";
        } else {
            $methodBody[] = "{$returnStr}{$raylibGlobalVar}->{$definition->name}({$paramsStr});";
        }

        $method->setBody(implode(PHP_EOL, $methodBody));

        return $method;
    }

    private static function generateTypeFromDefinition(stdClass $definition): void
    {
        $class = new ClassGenerator($definition->name, 'Nawarian\\Raylib\\Generated');
        $constructor = new CustomMethodGenerator('__construct');
        $constructor->setVisibility(AbstractMemberGenerator::VISIBILITY_PUBLIC);
        $class->addMethodFromGenerator($constructor);

        $constructorParams = [];

        foreach ($definition->fields as $field) {
            $docBlock = new DocBlockGenerator($field->description);

            $newPropertyNames = [$field->name];
            if ($definition->name === 'Matrix') {
                $newPropertyNames = array_map('trim', explode(', ', $field->name));
            }
            foreach ($newPropertyNames as $propertyName) {
                $propertyName = self::sanitizePropertyName($propertyName);
                $property = new CustomPropertyGenerator($propertyName);

                $type = self::getTypeFromField($field);

                $property
                    ->addFlag(AbstractMemberGenerator::FLAG_PUBLIC)
                    ->setDocBlock($docBlock)
                    ->omitDefaultValue(true)
                    ->setType($type);
                $class->addPropertyFromGenerator($property);

                $paramGen = new CustomParameterGenerator($propertyName);
                $paramGen->setType($type);

                $constructorParams[] = $paramGen;
            }
        }

        $constructorBody = implode(
            PHP_EOL,
            array_map(
                fn (CustomParameterGenerator $p) => "\$this->{$p->getName()} = \${$p->getName()};",
                $constructorParams
            )
        );
        $constructor
            ->setParameters($constructorParams)
            ->setBody($constructorBody);

        $class->addMethodFromGenerator(self::generateToCData($class));
        $class->addMethodFromGenerator(self::generateFromCData($class));

        self::$knownTypes[] = '\\' . $class->getNamespaceName() . '\\' . $class->getName();

        $fileGenerator = new FileGenerator();
        $fileGenerator
            ->setDeclares([DeclareStatement::strictTypes(1)])
            ->setClass($class)
            ->setFilename(self::OUTPUT_DIR . '/' . $definition->name . '.php')
            ->write();
    }

    private static function generateFromCData(ClassGenerator $class): CustomMethodGenerator
    {
        $cdataParameter = new CustomParameterGenerator('cdata');
        $cdataParameter->setType(CData::class);

        $method = new CustomMethodGenerator('fromCData');

        $constructorArgs = array_map(function (CustomPropertyGenerator $p) {
            if (self::shouldCallToCData($p->getType())) {
                return "{$p->getType()}::fromCData(\$cdata->{$p->getName()})";
            }
            return "\$cdata->{$p->getName()}";
        }, $class->getProperties());
        $constructorArgs = implode(', ', $constructorArgs);

        return $method
            ->setParameters([$cdataParameter])
            ->setBody(
                "return new self({$constructorArgs});"
            )
            ->setVisibility(AbstractMemberGenerator::VISIBILITY_PUBLIC)
            ->setStatic(true);
    }

    private static function generateToCData(ClassGenerator $class): CustomMethodGenerator
    {
        $class->addUse('FFI');

        $method = new CustomMethodGenerator('toCData');
        $functionBody = [
            "global \$raylib;",
            "\$type = \$raylib->new('{$class->getName()}');",
        ];

        /** @var CustomPropertyGenerator $property */
        foreach ($class->getProperties() as $property) {
            $callToCData = self::shouldCallToCData($property->getType())
                ? '->toCData()' : '';

            $functionBody[] = "\$type->{$property->getName()} = \$this->{$property->getName()}{$callToCData};";
        }

        $functionBody[] = 'return $type;';

        $method
            ->setVisibility(AbstractMemberGenerator::VISIBILITY_PUBLIC)
            ->setReturnType(CData::class)
            ->setBody(implode(PHP_EOL, $functionBody));

        return $method;
    }

    private static function shouldCallToCData(?string $type): bool
    {
        return match ($type) {
            'float', 'int', 'string', CData::class, 'array' => false,
            default => true,
        };
    }

    private static function sanitizePropertyName(string $name): string
    {
        return explode('[', $name)[0];
    }

    private static function getTypeFromField(stdClass $field): string
    {
        if (preg_match('#\[[\w]+\]$#', $field->name)) {
            return 'array';
        }

        return match($field->type) {
            'char', 'const char *', 'char *' => 'string',
            'float' => 'float',
            'bool' => 'bool',
            'int', 'unsigned char', 'unsigned int' => 'int',
            'Texture', 'Rectangle', 'Image', 'Vector2', 'Vector3', 'Color', 'Shader',
            'Matrix', 'AudioStream', 'Camera2D', 'RenderTexture2D', 'VrStereoConfig', 'VrDeviceInfo'
            => "\\Nawarian\\Raylib\\Generated\\{$field->type}",
            'Camera' => "\\Nawarian\\Raylib\\Generated\\Camera3D",
            'Texture2D' => "\\Nawarian\\Raylib\\Generated\\Texture",
            'Quaternion' => "\\Nawarian\\Raylib\\Generated\\Vector4",
            'CharInfo *' => "\\Nawarian\\Raylib\\Generated\\CharInfo",
            'Rectangle *', 'Rectangle **', 'GlyphInfo *', 'float *', 'unsigned char *', 'unsigned short *',
            'MaterialMap *', 'unsigned int *', 'int *', 'Mesh *', 'Material *', 'BoneInfo *', 'Transform *',
            'Transform **' => 'array',
            'void *', 'rAudioBuffer *', 'const void *' => CData::class,
            default => throw new RuntimeException("Unknown type {$field->type} found at raylib_api.json.")
        };
    }

    private static function getTypeFromParam(string $param): string
    {
        return match($param) {
            'char', 'const char *', 'char *' => 'string',
            'double', 'float' => 'float',
            'bool' => 'bool',
            'void' => 'void',
            'long', 'int', 'unsigned char', 'unsigned int' => 'int',
            'Texture', 'Rectangle', 'Image', 'Vector2', 'Vector3', 'Color', 'Shader', 'Font', 'NPatchInfo', 'Vector4',
            'Matrix', 'AudioStream', 'Camera2D', 'Camera3D', 'RenderTexture', 'VrStereoConfig', 'VrDeviceInfo', 'Ray',
            'Mesh', 'Model', 'BoundingBox', 'Material', 'ModelAnimation', 'Wave', 'Sound', 'Music', 'GlyphInfo',
            'RayCollision' => "\\Nawarian\\Raylib\\Generated\\{$param}",
            'Camera', 'Camera *' => "\\Nawarian\\Raylib\\Generated\\Camera3D",
            'Color *' => "\\Nawarian\\Raylib\\Generated\\Color",
            'CharInfo *', 'const CharInfo *' => "\\Nawarian\\Raylib\\Generated\\CharInfo",
            'Image *' => "\\Nawarian\\Raylib\\Generated\\Image",
            'Model *' => "\\Nawarian\\Raylib\\Generated\\Model",
            'Vector2 *' => "\\Nawarian\\Raylib\\Generated\\Vector2",
            'GlyphInfo *', 'const GlyphInfo *' => "\\Nawarian\\Raylib\\Generated\\GlyphInfo",
            'Texture2D', 'Texture2D *', 'TextureCubemap' => "\\Nawarian\\Raylib\\Generated\\Texture",
            'Quaternion' => "\\Nawarian\\Raylib\\Generated\\Vector4",
            'Wave *' => "\\Nawarian\\Raylib\\Generated\\Wave",
            'RenderTexture2D' => "\\Nawarian\\Raylib\\Generated\\RenderTexture",
            'Rectangle *', 'Rectangle **', 'float *', 'unsigned char *', 'const unsigned char *',
            'unsigned short *', 'MaterialMap *', 'unsigned int *', 'int *', 'Mesh *', 'Material *', 'BoneInfo *',
            'Transform *', 'Transform **', 'Vector3 *', 'Matrix *', 'ModelAnimation*', 'ModelAnimation *', 'char **',
            'const char **' => 'array',
            'void *', 'rAudioBuffer *', 'const void *' => CData::class,
            default => throw new RuntimeException("Unknown type {$param} found at raylib_api.json.")
        };
    }
}
