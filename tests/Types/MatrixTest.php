<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib\Types;

use FFI;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;
use Nawarian\Raylib\Types\Matrix;
use PHPUnit\Framework\TestCase;

class MatrixTest extends TestCase
{
    public function test_toCData_withInvalidFFIStructDef_throwsInvalidArgumentException(): void
    {
        $matrixValues = array_fill(0, 16, 1.0);
        $matrix = new Matrix(...$matrixValues);

        $ffi = FFI::cdef('');

        self::expectExceptionMessage('Object $ffi does not provide the type "struct Matrix"');
        self::expectException(InvalidArgumentException::class);
        $matrix->toCData(new RaylibFFIProxy($ffi));
    }

    public function test_toCData_withValidFFIStructDef_returnsCDataValidObject(): void
    {
        $matrixValues = array_fill(0, 16, 1.0);
        $matrix = new Matrix(...$matrixValues);

        $ffi = FFI::cdef(<<<CDEF
            typedef struct Matrix {
                float m0, m4, m8, m12;
                float m1, m5, m9, m13;
                float m2, m6, m10, m14;
                float m3, m7, m11, m15;
            } Matrix;
        CDEF
        );

        $cdata = $matrix->toCData(new RaylibFFIProxy($ffi));

        for ($i = 0; $i < 15; ++$i) {
            self::assertEquals(1.0, $cdata->{"m{$i}"});
        }
    }
}

