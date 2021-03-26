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
