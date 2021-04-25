<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Matrix
{
    public float $m0, $m4, $m8, $m12 = 0;
    public float $m1, $m5, $m9, $m13 = 0;
    public float $m2, $m6, $m10, $m14 = 0;
    public float $m3, $m7, $m11, $m15 = 0;

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $matrix  */
            $matrix = $ffi->new('Matrix');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Matrix"'
            );
        }

        $matrix->m0 = $this->m0;
        $matrix->m1 = $this->m1;
        $matrix->m2 = $this->m2;
        $matrix->m3 = $this->m3;
        $matrix->m4 = $this->m4;
        $matrix->m5 = $this->m5;
        $matrix->m6 = $this->m6;
        $matrix->m7 = $this->m7;
        $matrix->m8 = $this->m8;
        $matrix->m9 = $this->m9;
        $matrix->m10 = $this->m10;
        $matrix->m11 = $this->m11;
        $matrix->m12 = $this->m12;
        $matrix->m13 = $this->m13;
        $matrix->m14 = $this->m14;
        $matrix->m15 = $this->m15;

        return $matrix;
    }

    public static function fromVector4(Vector4 $vec): self
    {
        $result = self::identity();

        $a2 = 2 * ($vec->x * $vec->x);
        $b2 = 2 * ($vec->y * $vec->y);
        $c2 = 2 * ($vec->z * $vec->z);

        $ab = 2 * ($vec->x * $vec->y);
        $ac = 2 * ($vec->x * $vec->z);
        $bc = 2 * ($vec->y * $vec->z);
        $ad = 2 * ($vec->x * $vec->w);
        $bd = 2 * ($vec->y * $vec->w);
        $cd = 2 * ($vec->z * $vec->w);

        $result->m0 = 1 - $b2 - $c2;
        $result->m1 = $ab - $cd;
        $result->m2 = $ac + $bd;

        $result->m4 = $ab + $cd;
        $result->m5 = 1 - $a2 - $c2;
        $result->m6 = $bc - $ad;

        $result->m8 = $ac - $bd;
        $result->m9 = $bc + $ad;
        $result->m10 = 1 - $a2 - $b2;

        return $result;
    }

    public static function identity(): self
    {
        $matrix = new self();

        $matrix->m0 = 1;
        $matrix->m5 = 1;
        $matrix->m10 = 1;
        $matrix->m15 = 1;

        return $matrix;
    }

    public static function xRotation(float $angle): self
    {
        $matrix = self::identity();

        $cosres = cos($angle);
        $sinres = sin($angle);

        $matrix->m5 = $cosres;
        $matrix->m6 = -$sinres;
        $matrix->m9 = $sinres;
        $matrix->m10 = $cosres;

        return $matrix;
    }

    public static function yRotation(float $angle): self
    {
        $matrix = self::identity();

        $cosres = cos($angle);
        $sinres = sin($angle);

        $matrix->m0 = $cosres;
        $matrix->m2 = $sinres;
        $matrix->m8 = -$sinres;
        $matrix->m10 = $cosres;

        return $matrix;
    }

    public static function zRotation(float $angle): self
    {
        $matrix = self::identity();

        $cosres = cos($angle);
        $sinres = sin($angle);

        $matrix->m0 = $cosres;
        $matrix->m1 = -$sinres;
        $matrix->m4 = $sinres;
        $matrix->m5 = $cosres;

        return $matrix;
    }

    public function multiply(Matrix $matrix): self
    {
        $new = new self();

        $new->m0 =
            $this->m0 * $matrix->m0 + $this->m1 * $matrix->m4 + $this->m2 * $matrix->m8 + $this->m3 * $matrix->m12;
        $new->m1 =
            $this->m0 * $matrix->m1 + $this->m1 * $matrix->m5 + $this->m2 * $matrix->m9 + $this->m3 * $matrix->m13;
        $new->m2 =
            $this->m0 * $matrix->m2 + $this->m1 * $matrix->m6 + $this->m2 * $matrix->m10 + $this->m3 * $matrix->m14;
        $new->m3 =
            $this->m0 * $matrix->m3 + $this->m1 * $matrix->m7 + $this->m2 * $matrix->m11 + $this->m3 * $matrix->m15;
        $new->m4 =
            $this->m4 * $matrix->m0 + $this->m5 * $matrix->m4 + $this->m6 * $matrix->m8 + $this->m7 * $matrix->m12;
        $new->m5 =
            $this->m4 * $matrix->m1 + $this->m5 * $matrix->m5 + $this->m6 * $matrix->m9 + $this->m7 * $matrix->m13;
        $new->m6 =
            $this->m4 * $matrix->m2 + $this->m5 * $matrix->m6 + $this->m6 * $matrix->m10 + $this->m7 * $matrix->m14;
        $new->m7 =
            $this->m4 * $matrix->m3 + $this->m5 * $matrix->m7 + $this->m6 * $matrix->m11 + $this->m7 * $matrix->m15;
        $new->m8 =
            $this->m8 * $matrix->m0 + $this->m9 * $matrix->m4 + $this->m10 * $matrix->m8 + $this->m11 * $matrix->m12;
        $new->m9 =
            $this->m8 * $matrix->m1 + $this->m9 * $matrix->m5 + $this->m10 * $matrix->m9 + $this->m11 * $matrix->m13;
        $new->m10 =
            $this->m8 * $matrix->m2 + $this->m9 * $matrix->m6 + $this->m10 * $matrix->m10 + $this->m11 * $matrix->m14;
        $new->m11 =
            $this->m8 * $matrix->m3 + $this->m9 * $matrix->m7 + $this->m10 * $matrix->m11 + $this->m11 * $matrix->m15;
        $new->m12 =
            $this->m12 * $matrix->m0 + $this->m13 * $matrix->m4 + $this->m14 * $matrix->m8 + $this->m15 * $matrix->m12;
        $new->m13 =
            $this->m12 * $matrix->m1 + $this->m13 * $matrix->m5 + $this->m14 * $matrix->m9 + $this->m15 * $matrix->m13;
        $new->m14 =
            $this->m12 * $matrix->m2 + $this->m13 * $matrix->m6 + $this->m14 * $matrix->m10 + $this->m15 * $matrix->m14;
        $new->m15 =
            $this->m12 * $matrix->m3 + $this->m13 * $matrix->m7 + $this->m14 * $matrix->m11 + $this->m15 * $matrix->m15;

        return $new;
    }
}
