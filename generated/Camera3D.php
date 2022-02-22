<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Camera3D
{
    /**
     * Camera position
     */
    public \Nawarian\Raylib\Generated\Vector3 $position;

    /**
     * Camera target it looks-at
     */
    public \Nawarian\Raylib\Generated\Vector3 $target;

    /**
     * Camera up vector (rotation over its axis)
     */
    public \Nawarian\Raylib\Generated\Vector3 $up;

    /**
     * Camera field-of-view apperture in Y (degrees) in perspective, used as near plane
     * width in orthographic
     */
    public float $fovy;

    /**
     * Camera projection: CAMERA_PERSPECTIVE or CAMERA_ORTHOGRAPHIC
     */
    public int $projection;

    public function __construct(\Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Vector3 $target, \Nawarian\Raylib\Generated\Vector3 $up, float $fovy, int $projection)
    {
        $this->position = $position;
        $this->target = $target;
        $this->up = $up;
        $this->fovy = $fovy;
        $this->projection = $projection;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Camera3D');
        $type->position = $this->position->toCData();
        $type->target = $this->target->toCData();
        $type->up = $this->up->toCData();
        $type->fovy = $this->fovy;
        $type->projection = $this->projection;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Camera3D
    {
        return new self(\Nawarian\Raylib\Generated\Vector3::fromCData($cdata->position), \Nawarian\Raylib\Generated\Vector3::fromCData($cdata->target), \Nawarian\Raylib\Generated\Vector3::fromCData($cdata->up), $cdata->fovy, $cdata->projection);
    }
}
