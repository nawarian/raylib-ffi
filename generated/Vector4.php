<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class Vector4
{
    /**
     * Vector x component
     */
    public float $x;

    /**
     * Vector y component
     */
    public float $y;

    /**
     * Vector z component
     */
    public float $z;

    /**
     * Vector w component
     */
    public float $w;

    public function __construct(float $x, float $y, float $z, float $w)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->w = $w;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Vector4');
        $type->x = $this->x;
        $type->y = $this->y;
        $type->z = $this->z;
        $type->w = $this->w;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self($cdata->x, $cdata->y, $cdata->z, $cdata->w);
    }
}

