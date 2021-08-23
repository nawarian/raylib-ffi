<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Vector4
{
    public function __construct(public float $x, public float $y, public float $z, public float $w)
    {
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
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
}
