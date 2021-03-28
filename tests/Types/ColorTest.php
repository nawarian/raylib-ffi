<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib\Types;

use FFI;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;
use Nawarian\Raylib\Types\Color;
use PHPUnit\Framework\TestCase;

class ColorTest extends TestCase
{
    public function test_lightGray(): void
    {
        self::assertEquals(Color::lightGray(), new Color(200, 200, 200, 255));
    }

    public function test_gray(): void
    {
        self::assertEquals(Color::gray(), new Color(130, 130, 130, 255));
    }

    public function test_darkGray(): void
    {
        self::assertEquals(Color::darkGray(), new Color(80, 80, 80, 255));
    }

    public function test_red(): void
    {
        self::assertEquals(Color::red(), new Color(230, 41, 55, 255));
    }

    public function test_black(): void
    {
        self::assertEquals(Color::black(), new Color(0, 0, 0, 255));
    }

    public function test_toCData_withInvalidFFIStructDef_throwsInvalidArgumentException(): void
    {
        $color = new Color(255, 255, 150, 110);

        $ffi = FFI::cdef('');

        self::expectExceptionMessage('Object $ffi does not provide the type "struct Color"');
        self::expectException(InvalidArgumentException::class);
        $color->toCData(new RaylibFFIProxy($ffi));
    }

    public function test_toCData_withValidFFIStructDef_returnsCDataValidObject(): void
    {
        $color = new Color(255, 255, 150, 110);

        $ffi = FFI::cdef(<<<CDEF
            typedef struct Color {
                int r;
                int g;
                int b;
                int a;
            } Color;
        CDEF
        );

        $cdata = $color->toCData(new RaylibFFIProxy($ffi));

        self::assertEquals(255, $cdata->r);
        self::assertEquals(255, $cdata->g);
        self::assertEquals(150, $cdata->b);
        self::assertEquals(110, $cdata->a);
    }
}
