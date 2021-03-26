<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib\Types;

use FFI;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;
use Nawarian\Raylib\Types\Rectangle;
use PHPUnit\Framework\TestCase;

class RectangleTest extends TestCase
{
    public function test_toCData_withInvalidFFIStructDef_throwsInvalidArgumentException(): void
    {
        $rectangle = new Rectangle(1.0, 2.0, 3.0, 4.0);

        $ffi = FFI::cdef('');

        self::expectExceptionMessage('Object $ffi does not provide the type "struct Rectangle"');
        self::expectException(InvalidArgumentException::class);
        $rectangle->toCData(new RaylibFFIProxy($ffi));
    }

    public function test_toCData_withValidFFIStructDef_returnsCDataValidObject(): void
    {
        $rectangle = new Rectangle(1.0, 2.0, 3.0, 4.0);

        $ffi = FFI::cdef(<<<CDEF
            typedef struct Rectangle {
                float x;
                float y;
                float width;
                float height;
            } Rectangle;
        CDEF
        );

        $cdata = $rectangle->toCData(new RaylibFFIProxy($ffi));

        self::assertEquals(1.0, $cdata->x);
        self::assertEquals(2.0, $cdata->y);
        self::assertEquals(3.0, $cdata->width);
        self::assertEquals(4.0, $cdata->height);
    }
}
