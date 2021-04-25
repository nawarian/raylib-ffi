<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

class Vector4
{
    public float $x;
    public float $y;
    public float $z;
    public float $w;

    public function __construct(float $x, float $y, float $z, float $w)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->w = $w;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $vec */
            $vec = $ffi->new('Vector4');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Vector4"'
            );
        }

        $vec->x = $this->x;
        $vec->y = $this->y;
        $vec->z = $this->z;
        $vec->w = $this->w;

        return $vec;
    }

    public static function fromEulerAngles(float $roll, float $pitch, float $yaw): self
    {
        $x0 = cos($roll * 0.5);
        $x1 = sin($roll * 0.5);

        $y0 = cos($pitch * 0.5);
        $y1 = sin($pitch * 0.5);

        $z0 = cos($yaw * 0.5);
        $z1 = sin($yaw * 0.5);

        return new self(
            $x1 * $y0 * $z0 - $x0 * $y1 * $z1,
            $x0 * $y1 * $z0 + $x1 * $y0 * $z1,
            $x0 * $y0 * $z1 - $x1 * $y1 * $z0,
            $x0 * $y0 * $z0 + $x1 * $y1 * $z1,
        );
    }
}
