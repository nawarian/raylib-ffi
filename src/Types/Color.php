<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;
use Webmozart\Assert\Assert;

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

    private static function assertUint8(int $value): void
    {
        Assert::greaterThanEq($value, 0);
        Assert::lessThanEq($value, 255);
    }

    public static function beige(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(211, 176, 131, $alpha);
    }

    public static function lightGray(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(200, 200, 200, $alpha);
    }

    public static function gray(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(130, 130, 130, $alpha);
    }

    public static function darkGray(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(80, 80, 80, $alpha);
    }

    public static function darkGreen(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(0, 117, 44, $alpha);
    }

    public static function darkPurple(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(112, 31, 126, $alpha);
    }

    public static function darkBrown(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(76, 63, 47, $alpha);
    }

    public static function blue(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(0, 121, 241, $alpha);
    }

    public static function darkBlue(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(0, 82, 172, $alpha);
    }

    public static function gold(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(255, 203, 0, $alpha);
    }

    public static function green(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(0, 228, 48, $alpha);
    }

    public static function lime(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(0, 158, 47, $alpha);
    }

    public static function maroon(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(190, 33, 55, $alpha);
    }

    public static function orange(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(255, 161, 0, $alpha);
    }

    public static function skyBlue(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(102, 191, 255, $alpha);
    }

    public static function red(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(230, 41, 55, $alpha);
    }

    public static function black(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(0, 0, 0, $alpha);
    }

    public static function blank(int $alpha = 0): Color
    {
        return self::black($alpha);
    }

    public static function rayWhite(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(245, 245, 245, $alpha);
    }

    public static function white(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(255, 255, 255, $alpha);
    }

    public static function purple(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(200, 122, 255, $alpha);
    }

    public static function violet(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(135, 60, 190, $alpha);
    }

    public static function brown(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(127, 106, 79, $alpha);
    }

    public static function pink(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(255, 109, 194, $alpha);
    }

    public static function yellow(int $alpha = 255): Color
    {
        self::assertUint8($alpha);
        return new self(253, 249, 0, $alpha);
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $color = $ffi->new('Color');
        } catch (FFI\ParserException $e) {
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
