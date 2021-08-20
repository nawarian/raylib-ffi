<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;
use Webmozart\Assert\Assert;

final class Matrix
{
    public function __construct(
        public float $m0,
        public float $m4,
        public float $m8,
        public float $m12,
        public float $m1,
        public float $m5,
        public float $m9,
        public float $m13,
        public float $m2,
        public float $m6,
        public float $m10,
        public float $m14,
        public float $m3,
        public float $m7,
        public float $m11,
        public float $m15
    ) {
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $matrix = $ffi->new('Matrix');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Matrix"'
            );
        }

        for ($i = 0; $i < 15; ++$i) {
            $matrix->{"m{$i}"} = $this->{"m{$i}"};
        }

        return $matrix;
    }
}
