<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Ray
{
    public Vector3 $position;
    public Vector3 $direction;

    public function __construct(Vector3 $position, Vector3 $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $ray = $ffi->new('Ray');
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Ray"'
            );
        }

        $ray->position->x = $this->position->x;
        $ray->position->y = $this->position->y;
        $ray->position->z = $this->position->z;

        $ray->direction->x = $this->direction->x;
        $ray->direction->y = $this->direction->y;
        $ray->direction->z = $this->direction->z;

        return $ray;
    }
}
