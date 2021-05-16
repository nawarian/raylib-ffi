<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class BoundingBox
{
    public Vector3 $min;
    public Vector3 $max;

    public function __construct(Vector3 $min, Vector3 $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $box = $ffi->new('BoundingBox');
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct BoundingBox"'
            );
        }

        $box->min->x = $this->min->x;
        $box->min->y = $this->min->y;
        $box->min->z = $this->min->z;

        $box->max->x = $this->max->x;
        $box->max->y = $this->max->y;
        $box->max->z = $this->max->z;

        return $box;
    }
}
