<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generator;

use FFI\CData;
use Laminas\Code\Generator\AbstractMemberGenerator;
use Laminas\Code\Generator\ClassGenerator;
use Laminas\Code\Generator\DocBlockGenerator;
use Laminas\Code\Generator\MethodGenerator;
use Laminas\Code\Generator\ParameterGenerator;
use Nawarian\Raylib\Command\GenerateRaylibWrappers;
use stdClass;

final class RaylibClassTypeGenerator extends ClassGenerator
{
    public const TYPES_NAMESPACE = 'Nawarian\\Raylib\\Generated';

    /**
     * @var RaylibFieldGenerator[]
     */
    private array $fields;

    /**
     * @return RaylibFieldGenerator[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param RaylibFieldGenerator[] $fields
     */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

    public static function fromRaylibStruct(stdClass $struct): self
    {
        $instance = new self();
        $instance->name = $struct->name;
        $instance->namespaceName = self::TYPES_NAMESPACE;
        $instance->setDocBlock(new DocBlockGenerator($struct->description));

        $fields = [];
        foreach ($struct->fields as $field) {
            $properties = explode(', ', $field->name);
            foreach ($properties as $name) {
                $fields[] = RaylibFieldGenerator::fromRaylibStruct($field, $name);
            }
        }

        $instance->fields = $fields;

        return $instance;
    }

    public function generate(): string
    {
        $classGenerator = new ClassGenerator($this->name, $this->getNamespaceName());
        $classGenerator->addProperties($this->fields);

        $constructor = new CustomMethodGenerator('__construct');
        $constructor->setVisibility(AbstractMemberGenerator::VISIBILITY_PUBLIC);

        $constructor
            ->setParameters(array_map(
                function (RaylibFieldGenerator $p) {
                    return new ParameterGenerator($p->getName(), $p->getType());
                },
                $this->fields
            ))
            ->setBody(implode(
                PHP_EOL,
                array_map(
                    fn (RaylibFieldGenerator $p) => "\$this->{$p->getName()} = \${$p->getName()};",
                    $this->fields
                )
            ));

        $classGenerator->addMethodFromGenerator($constructor);
        $classGenerator->addMethodFromGenerator($this->craftToCDataMethodGenerator());
        $classGenerator->addMethodFromGenerator($this->craftFromCDataMethodGenerator());

        return $classGenerator->generate();
    }

    private function craftToCDataMethodGenerator(): MethodGenerator
    {
        $globalRaylibVar = GenerateRaylibWrappers::$globalRaylibVariable;
        $this->addUse('FFI');

        $method = new CustomMethodGenerator('toCData');
        $functionBody = [
            "global {$globalRaylibVar};",
            "\$type = \$raylib->new('{$this->getName()}');",
        ];

        /** @var CustomPropertyGenerator $property */
        foreach ($this->getFields() as $property) {
            $callToCData = $this->shouldCallToCData($property->getType())
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

    private function shouldCallToCData(string $type): bool
    {
        return match ($type) {
            'float', 'int', 'string', CData::class, 'array' => false,
            default => true,
        };
    }

    private function craftFromCDataMethodGenerator(): MethodGenerator
    {
        $cdataParameter = new CustomParameterGenerator('cdata');
        $cdataParameter->setType(CData::class);

        $method = new CustomMethodGenerator('fromCData');

        $constructorArgs = array_map(function (RaylibFieldGenerator $p) {
            if (self::shouldCallToCData($p->getType())) {
                return "{$p->getType()}::fromCData(\$cdata->{$p->getName()})";
            }
            return "\$cdata->{$p->getName()}";
        }, $this->getFields());
        $constructorArgs = implode(', ', $constructorArgs);

        return $method
            ->setParameters([$cdataParameter])
            ->setBody(
                "return new self({$constructorArgs});"
            )
            ->setVisibility(AbstractMemberGenerator::VISIBILITY_PUBLIC)
            ->setReturnType($this->getNamespaceName() . '\\' . $this->getName())
            ->setStatic(true);
    }
}
