<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generator;

use Laminas\Code\Exception\RuntimeException;
use Laminas\Code\Generator\PropertyGenerator;

class CustomPropertyGenerator extends PropertyGenerator
{
    private ?string $type = null;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function generate(): string
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
            . ($this->isStatic() ? ' static' : '')
            . ($this->getType() ? " {$this->getType()}" : '')
            . ' $' . $name;

        if ($this->omitDefaultValue()) {
            return $output . ';';
        }

        return $output . ' = ' . ($defaultValue !== null ? $defaultValue->generate() : 'null;');
    }
}
