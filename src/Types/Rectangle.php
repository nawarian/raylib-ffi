<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Rectangle
{
    public float $x;
    public float $y;
    public float $width;
    public float $height;

    public function __construct(float $x, float $y, float $width, float $height)
    {
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $rec */
            $rec = $ffi->new('Rectangle');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Rectangle"'
            );
        }

        $rec->x = $this->x;
        $rec->y = $this->y;
        $rec->width = $this->width;
        $rec->height = $this->height;

        return $rec;
    }
}
