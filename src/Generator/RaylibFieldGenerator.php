<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generator;

use FFI\CData;
use Laminas\Code\Exception\RuntimeException;
use Laminas\Code\Generator\AbstractMemberGenerator;
use Laminas\Code\Generator\PropertyGenerator;
use stdClass;

class RaylibFieldGenerator extends PropertyGenerator
{
    private string $type;
    private bool $omitDefaultValue = true;

    public function getType(): string
    {
        return $this->normalizeType($this->getName(), $this->type);
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function omitDefaultValue(bool $omit = true): self
    {
        $this->omitDefaultValue = $omit;

        return $this;
    }

    public static function fromRaylibStruct(stdClass $field, string $propertyName): self
    {
        $instance = new self();
        $instance
            ->omitDefaultValue()
            ->setName($propertyName)
            ->setType($field->type !== 'array' ? $field->type : '')
            ->setVisibility(AbstractMemberGenerator::VISIBILITY_PUBLIC)
            ->setDocBlock($field->description);

        return $instance;
    }

    public function generate()
    {
        $name         = $this->getName();
        $defaultValue = $this->getDefaultValue();

        $output = '';

        if (($docBlock = $this->getDocBlock()) !== null) {
            $docBlock->setIndentation('    ');
            $output .= $docBlock->generate();
        }

        if ($this->isConst()) {
            if ($defaultValue !== null && ! $defaultValue->isValidConstantType()) {
                throw new RuntimeException(sprintf(
                    'The property %s is said to be '
                    . 'constant but does not have a valid constant value.',
                    $this->name
                ));
            }
            return $output
                . $this->indentation
                . ($this->isFinal() ? 'final ' : '')
                . $this->getVisibility()
                . ' const '
                . $name . ' = '
                . ($defaultValue !== null ? $defaultValue->generate() : 'null;');
        }

        $output .= $this->indentation
            . $this->getVisibility()
            . ($this->isReadonly() ? ' readonly' : '')
            . ($this->getType() ? " {$this->getType()}" : '')
            . ($this->isStatic() ? ' static' : '')
            . ' $' . $name;

        if ($this->omitDefaultValue) {
            return $output . ';';
        }

        return $output . ' = ' . ($defaultValue !== null ? $defaultValue->generate() : 'null;');
    }

    private function normalizeType(string $name, string $type): string
    {
        if (preg_match('#\[[\w]+\]$#', $name)) {
            return 'array';
        }

        return match($type) {
            'char', 'const char *', 'char *' => 'string',
            'float' => 'float',
            'bool' => 'bool',
            'int', 'unsigned char', 'unsigned int' => 'int',
            'Texture', 'Rectangle', 'Image', 'Vector2', 'Vector3', 'Color', 'Shader',
            'Matrix', 'AudioStream', 'Camera2D', 'RenderTexture2D', 'VrStereoConfig', 'VrDeviceInfo'
            => "\\Nawarian\\Raylib\\Generated\\{$type}",
            'Camera' => "\\Nawarian\\Raylib\\Generated\\Camera3D",
            'Texture2D' => "\\Nawarian\\Raylib\\Generated\\Texture",
            'Quaternion' => "\\Nawarian\\Raylib\\Generated\\Vector4",
            'CharInfo *' => "\\Nawarian\\Raylib\\Generated\\CharInfo",
            'Rectangle *', 'Rectangle **', 'GlyphInfo *', 'float *', 'unsigned char *', 'unsigned short *',
            'MaterialMap *', 'unsigned int *', 'int *', 'Mesh *', 'Material *', 'BoneInfo *', 'Transform *',
            'Transform **' => 'array',
            'void *', 'rAudioBuffer *', 'const void *' => CData::class,
            default => throw new RuntimeException("Unknown type {$type} found at raylib_api.json.")
        };
    }
}
