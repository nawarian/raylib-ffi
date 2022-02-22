<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class Vector3
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

    public function __construct(float $x, float $y, float $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Vector3');
        $type->x = $this->x;
        $type->y = $this->y;
        $type->z = $this->z;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self($cdata->x, $cdata->y, $cdata->z);
    }
}

