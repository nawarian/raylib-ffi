<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class Rectangle
{
    /**
     * Rectangle top-left corner position x
     */
    public float $x;

    /**
     * Rectangle top-left corner position y
     */
    public float $y;

    /**
     * Rectangle width
     */
    public float $width;

    /**
     * Rectangle height
     */
    public float $height;

    public function __construct(float $x, float $y, float $width, float $height)
    {
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Rectangle');
        $type->x = $this->x;
        $type->y = $this->y;
        $type->width = $this->width;
        $type->height = $this->height;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self($cdata->x, $cdata->y, $cdata->width, $cdata->height);
    }
}

