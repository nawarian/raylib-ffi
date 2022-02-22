<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Color
{
    /**
     * Color red value
     */
    public int $r;

    /**
     * Color green value
     */
    public int $g;

    /**
     * Color blue value
     */
    public int $b;

    /**
     * Color alpha value
     */
    public int $a;

    public function __construct(int $r, int $g, int $b, int $a)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->a = $a;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Color');
        $type->r = $this->r;
        $type->g = $this->g;
        $type->b = $this->b;
        $type->a = $this->a;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Color
    {
        return new self($cdata->r, $cdata->g, $cdata->b, $cdata->a);
    }
}
