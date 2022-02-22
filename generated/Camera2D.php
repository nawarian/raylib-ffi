<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class Camera2D
{
    /**
     * Camera offset (displacement from target)
     */
    public \Nawarian\Raylib\Generated\Vector2 $offset;

    /**
     * Camera target (rotation and zoom origin)
     */
    public \Nawarian\Raylib\Generated\Vector2 $target;

    /**
     * Camera rotation in degrees
     */
    public float $rotation;

    /**
     * Camera zoom (scaling), should be 1.0f by default
     */
    public float $zoom;

    public function __construct(\Nawarian\Raylib\Generated\Vector2 $offset, \Nawarian\Raylib\Generated\Vector2 $target, float $rotation, float $zoom)
    {
        $this->offset = $offset;
        $this->target = $target;
        $this->rotation = $rotation;
        $this->zoom = $zoom;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Camera2D');
        $type->offset = $this->offset->toCData();
        $type->target = $this->target->toCData();
        $type->rotation = $this->rotation;
        $type->zoom = $this->zoom;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self(\Nawarian\Raylib\Generated\Vector2::fromCData($cdata->offset), \Nawarian\Raylib\Generated\Vector2::fromCData($cdata->target), $cdata->rotation, $cdata->zoom);
    }
}

