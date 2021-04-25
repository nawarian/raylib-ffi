<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Vector3
{
    public float $x;
    public float $y;
    public float $z;

    public function __construct(float $x, float $y, float $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $vec */
            $vec = $ffi->new('Vector3');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Vector3"'
            );
        }

        $vec->x = $this->x;
        $vec->y = $this->y;
        $vec->z = $this->z;

        return $vec;
    }

    public static function eulerAngles(Vector4 $quaternion): self
    {
        $result = new self(0, 0, 0);
        $rad2deg = 180.0 / pi();

        // roll (x-axis rotation)
        $x0 = 2.0 * ($quaternion->w * $quaternion->x + $quaternion->y * $quaternion->z);
        $x1 = 1.0 - 2.0 * ($quaternion->x * $quaternion->x + $quaternion->y * $quaternion->y);
        $result->x = atan2($x0, $x1) * $rad2deg;

        // pitch (y-axis rotation)
        $y0 = 2.0 * ($quaternion->w * $quaternion->y - $quaternion->z * $quaternion->x);
        $y0 = $y0 > 1.0 ? 1.0 : $y0;
        $y0 = $y0 < -1.0 ? -1.0 : $y0;
        $result->y = asin($y0) * $rad2deg;

        // yaw (z-axis rotation)
        $z0 = 2.0 * ($quaternion->w * $quaternion->z + $quaternion->x * $quaternion->y);
        $z1 = 1.0 - 2.0 * ($quaternion->y * $quaternion->y + $quaternion->z * $quaternion->z);
        $result->z = atan2($z0, $z1) * $rad2deg;

        return $result;
    }
}
