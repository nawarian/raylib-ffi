<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Matrix
{
    /**
     * Matrix first row (4 components)
     */
    public float $m0;

    /**
     * Matrix first row (4 components)
     */
    public float $m4;

    /**
     * Matrix first row (4 components)
     */
    public float $m8;

    /**
     * Matrix first row (4 components)
     */
    public float $m12;

    /**
     * Matrix second row (4 components)
     */
    public float $m1;

    /**
     * Matrix second row (4 components)
     */
    public float $m5;

    /**
     * Matrix second row (4 components)
     */
    public float $m9;

    /**
     * Matrix second row (4 components)
     */
    public float $m13;

    /**
     * Matrix third row (4 components)
     */
    public float $m2;

    /**
     * Matrix third row (4 components)
     */
    public float $m6;

    /**
     * Matrix third row (4 components)
     */
    public float $m10;

    /**
     * Matrix third row (4 components)
     */
    public float $m14;

    /**
     * Matrix fourth row (4 components)
     */
    public float $m3;

    /**
     * Matrix fourth row (4 components)
     */
    public float $m7;

    /**
     * Matrix fourth row (4 components)
     */
    public float $m11;

    /**
     * Matrix fourth row (4 components)
     */
    public float $m15;

    public function __construct(float $m0, float $m4, float $m8, float $m12, float $m1, float $m5, float $m9, float $m13, float $m2, float $m6, float $m10, float $m14, float $m3, float $m7, float $m11, float $m15)
    {
        $this->m0 = $m0;
        $this->m4 = $m4;
        $this->m8 = $m8;
        $this->m12 = $m12;
        $this->m1 = $m1;
        $this->m5 = $m5;
        $this->m9 = $m9;
        $this->m13 = $m13;
        $this->m2 = $m2;
        $this->m6 = $m6;
        $this->m10 = $m10;
        $this->m14 = $m14;
        $this->m3 = $m3;
        $this->m7 = $m7;
        $this->m11 = $m11;
        $this->m15 = $m15;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Matrix');
        $type->m0 = $this->m0;
        $type->m4 = $this->m4;
        $type->m8 = $this->m8;
        $type->m12 = $this->m12;
        $type->m1 = $this->m1;
        $type->m5 = $this->m5;
        $type->m9 = $this->m9;
        $type->m13 = $this->m13;
        $type->m2 = $this->m2;
        $type->m6 = $this->m6;
        $type->m10 = $this->m10;
        $type->m14 = $this->m14;
        $type->m3 = $this->m3;
        $type->m7 = $this->m7;
        $type->m11 = $this->m11;
        $type->m15 = $this->m15;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Matrix
    {
        return new self($cdata->m0, $cdata->m4, $cdata->m8, $cdata->m12, $cdata->m1, $cdata->m5, $cdata->m9, $cdata->m13, $cdata->m2, $cdata->m6, $cdata->m10, $cdata->m14, $cdata->m3, $cdata->m7, $cdata->m11, $cdata->m15);
    }
}
