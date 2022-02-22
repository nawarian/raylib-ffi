<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Vector2
{
    /**
     * Vector x component
     */
    public float $x;

    /**
     * Vector y component
     */
    public float $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Vector2');
        $type->x = $this->x;
        $type->y = $this->y;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Vector2
    {
        return new self($cdata->x, $cdata->y);
    }
}
