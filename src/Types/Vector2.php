<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;

final class Vector2
{
    public float $x;
    public float $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(FFI $ffi): CData
    {
        try {
            /** @var CData $vec */
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
