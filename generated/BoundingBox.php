<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class BoundingBox
{
    /**
     * Minimum vertex box-corner
     */
    public \Nawarian\Raylib\Generated\Vector3 $min;

    /**
     * Maximum vertex box-corner
     */
    public \Nawarian\Raylib\Generated\Vector3 $max;

    public function __construct(\Nawarian\Raylib\Generated\Vector3 $min, \Nawarian\Raylib\Generated\Vector3 $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('BoundingBox');
        $type->min = $this->min->toCData();
        $type->max = $this->max->toCData();
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\BoundingBox
    {
        return new self(\Nawarian\Raylib\Generated\Vector3::fromCData($cdata->min), \Nawarian\Raylib\Generated\Vector3::fromCData($cdata->max));
    }
}
