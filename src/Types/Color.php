<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;

final class Color
{
    public int $red;
    public int $green;
    public int $blue;
    public int $alpha;

    public function __construct(int $red, int $green, int $blue, int $alpha)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
        $this->alpha = $alpha;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(FFI $ffi): CData
    {
        /** @var CData|null $color */
        $color = $ffi->new('Color');

        if ($color === null) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Color"'
            );
        }

        $color->r = $this->red;
        $color->g = $this->green;
        $color->b = $this->blue;
        $color->a = $this->alpha;

        return $color;
    }
}
