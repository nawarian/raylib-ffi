<?php

namespace Nawarian\Raylib\Generator;

use Laminas\Code\Generator\ParameterGenerator;
use Laminas\Code\Generator\ValueGenerator;

class CustomParameterGenerator extends ParameterGenerator
{
    private bool $variadic = false;

    private bool $omitDefaultValue = false;

    public function generate()
    {
        $output = $this->generateTypeHint();

        if (true === $this->passedByReference) {
            $output .= '&';
        }

        if ($this->variadic) {
            $output .= '... ';
        }

        $output .= '$' . $this->name;

        if ($this->omitDefaultValue) {
            return $output;
        }

        if ($this->defaultValue instanceof ValueGenerator) {
            $output .= ' = ';
            $this->defaultValue->setOutputMode(ValueGenerator::OUTPUT_SINGLE_LINE);
            $output .= $this->defaultValue;
        }

        return $output;
    }

    private function generateTypeHint()
    {
        if (null === $this->type) {
            return '';
        }

        return $this->type->generate() . ' ';
    }
}
