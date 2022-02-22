<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generator;

use FFI\CData;
use Laminas\Code\Generator\AbstractMemberGenerator;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\MethodGenerator;
use Nawarian\Raylib\Command\GenerateRaylibWrappers;
use RuntimeException;
use stdClass;

class RaylibFunctionGenerator extends MethodGenerator
{
    public function getVisibility()
    {
        switch (true) {
            case $this->flags & self::FLAG_PROTECTED:
                return self::VISIBILITY_PROTECTED;
            case $this->flags & self::FLAG_PRIVATE:
                return self::VISIBILITY_PRIVATE;
            case $this->flags & self::FLAG_PUBLIC:
                return self::VISIBILITY_PUBLIC;
            default:
                return '';
        }
    }

    public static function fromRaylibStruct(stdClass $struct): self
    {
        $method = new self();
        $method
            ->setDocBlock(new DocBlockGenerator($struct->description))
            ->setName($struct->name)
            ->removeFlag(AbstractMemberGenerator::FLAG_PUBLIC)
            ->setIndentation('');

        $params = [];
        foreach ($struct->params ?? [] as $key => $param) {
            $paramGen = new CustomParameterGenerator($key);
            $paramGen->setType(self::getTypeFromParam($param));
            $params[] = $paramGen;
        }

        $method
            ->setParameters($params)
            ->setReturnType(self::getTypeFromParam($struct->returnType));

        $paramsStr = implode(
            ', ',
            array_map(function (CustomParameterGenerator $param) {
                $toCData = self::shouldCallToCData($param->getType()) ? '->toCData()' : '';

                return "\${$param->getName()}{$toCData}";
            }, $params)
        );
        $returnType = $method->getReturnType()->generate();
        $returnStr = $returnType !== 'void' ? 'return ' : '';

        $raylibGlobalVar = GenerateRaylibWrappers::$globalRaylibVariable;
        $methodBody = ["global {$raylibGlobalVar};"];

        if (in_array($returnType, GenerateRaylibWrappers::$knownTypes)) {
            $methodBody[] = "return {$returnType}::fromCData({$raylibGlobalVar}->{$struct->name}({$paramsStr}));";
        } else {
            $methodBody[] = "{$returnStr}{$raylibGlobalVar}->{$struct->name}({$paramsStr});";
        }

        $method->setBody(implode(PHP_EOL, $methodBody));

        return $method;
    }

    private static function shouldCallToCData(?string $type): bool
    {
        return match ($type) {
            'float', 'int', 'string', CData::class, 'array' => false,
            default => true,
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
