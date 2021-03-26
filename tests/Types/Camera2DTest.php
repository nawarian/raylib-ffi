<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib\Types;

use FFI;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;
use Nawarian\Raylib\Types\Camera2D;
use Nawarian\Raylib\Types\Vector2;
use PHPUnit\Framework\TestCase;

class Camera2DTest extends TestCase
{
    public function test_toCData_withInvalidFFIStructDef_throwsInvalidArgumentException(): void
    {
        $offset = new Vector2(0, 0);
        $target = new Vector2(0, 0);
        $camera = new Camera2D($offset, $target, 0.0, 0.0);

        $ffi = FFI::cdef('');

        self::expectExceptionMessage('Object $ffi does not provide the type "struct Camera2D"');
        self::expectException(InvalidArgumentException::class);
        $camera->toCData(new RaylibFFIProxy($ffi));
    }

    public function test_toCData_withValidFFIStructDef_returnsCDataValidObject(): void
    {
        $offset = new Vector2(10, 10);
        $target = new Vector2(20, 20);
        $camera = new Camera2D($offset, $target, 5.0, 2.5);

        $ffi = FFI::cdef(<<<CDEF
            typedef struct Vector2 {
                float x;
                float y;
            } Vector2;

            typedef struct Camera2D {
                Vector2 offset;
                Vector2 target;
                float rotation;
                float zoom;            
            } Camera2D;
        CDEF
        );

        $cdata = $camera->toCData(new RaylibFFIProxy($ffi));

        self::assertEquals(10, $cdata->offset->x);
        self::assertEquals(10, $cdata->offset->y);
        self::assertEquals(20, $cdata->target->x);
        self::assertEquals(20, $cdata->target->y);
        self::assertEquals(5.0, $cdata->rotation);
        self::assertEquals(2.5, $cdata->zoom);
    }
}
