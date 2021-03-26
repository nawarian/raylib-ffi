<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib\Types;

use FFI;
use InvalidArgumentException;
use Nawarian\Raylib\Types\Vector2;
use PHPUnit\Framework\TestCase;

class Vector2Test extends TestCase
{
    public function test_toCData_withInvalidFFIStructDef_throwsInvalidArgumentException(): void
    {
        $vec = new Vector2(1.0, 2.0);

        $ffi = FFI::cdef('');

        self::expectExceptionMessage('Object $ffi does not provide the type "struct Vector2"');
        self::expectException(InvalidArgumentException::class);
        $vec->toCData($ffi);
    }

    public function test_toCData_withValidFFIStructDef_returnsCDataValidObject(): void
    {
        $vec = new Vector2(1.0, 2.0);

        $ffi = FFI::cdef(<<<CDEF
            typedef struct Vector2 {
                float x;
                float y;            
            } Vector2;
        CDEF
        );

        $cdata = $vec->toCData($ffi);

        self::assertEquals(1.0, $cdata->x);
        self::assertEquals(2.0, $cdata->y);
    }
}
