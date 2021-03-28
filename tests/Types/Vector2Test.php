<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib\Types;

use FFI;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;
use Nawarian\Raylib\Types\Vector2;
use PHPUnit\Framework\TestCase;

class Vector2Test extends TestCase
{
    public function test_add(): void
    {
        $v1 = new Vector2(20, 20);
        $v2 = new Vector2(40, 40);

        self::assertEquals(
            new Vector2(60, 60),
            $v1->add($v2),
        );
    }

    public function test_length(): void
    {
        $vec = new Vector2(1, 1);

        self::assertEquals(
            1.41421,
            round($vec->length(), 5),
        );
    }

    public function test_scale(): void
    {
        $vec = new Vector2(5, 5);

        self::assertEquals(
            new Vector2(10, 10),
            $vec->scale(2),
        );
    }

    public function test_subtract(): void
    {
        $v1 = new Vector2(5, 5);
        $v2 = new Vector2(2, 2);

        self::assertEquals(
            new Vector2(3, 3),
            $v1->subtract($v2),
        );
    }

    public function test_toCData_withInvalidFFIStructDef_throwsInvalidArgumentException(): void
    {
        $vec = new Vector2(1.0, 2.0);

        $ffi = FFI::cdef('');

        self::expectExceptionMessage('Object $ffi does not provide the type "struct Vector2"');
        self::expectException(InvalidArgumentException::class);
        $vec->toCData(new RaylibFFIProxy($ffi));
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

        $cdata = $vec->toCData(new RaylibFFIProxy($ffi));

        self::assertEquals(1.0, $cdata->x);
        self::assertEquals(2.0, $cdata->y);
    }
}
