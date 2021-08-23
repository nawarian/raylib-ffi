<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Vector2
{
    public function __construct(public float $x, public float $y)
    {
    }

    public function add(Vector2 $vec): Vector2
    {
        return new Vector2($this->x + $vec->x, $this->y + $vec->y);
    }

    public function length(): float
    {
        return sqrt(($this->x * $this->x) + ($this->y * $this->y));
    }

    public function scale(float $scale): Vector2
    {
        return new Vector2($this->x * $scale, $this->y * $scale);
    }

    public function subtract(Vector2 $vec): Vector2
    {
        return new Vector2($this->x - $vec->x, $this->y - $vec->y);
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $vec = $ffi->new('Vector2');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Vector2"'
            );
        }

        $vec->x = $this->x;
        $vec->y = $this->y;

        return $vec;
    }
}
