<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Transform
{
    /**
     * Translation
     */
    public \Nawarian\Raylib\Generated\Vector3 $translation;

    /**
     * Rotation
     */
    public \Nawarian\Raylib\Generated\Vector4 $rotation;

    /**
     * Scale
     */
    public \Nawarian\Raylib\Generated\Vector3 $scale;

    public function __construct(\Nawarian\Raylib\Generated\Vector3 $translation, \Nawarian\Raylib\Generated\Vector4 $rotation, \Nawarian\Raylib\Generated\Vector3 $scale)
    {
        $this->translation = $translation;
        $this->rotation = $rotation;
        $this->scale = $scale;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Transform');
        $type->translation = $this->translation->toCData();
        $type->rotation = $this->rotation->toCData();
        $type->scale = $this->scale->toCData();
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Transform
    {
        return new self(\Nawarian\Raylib\Generated\Vector3::fromCData($cdata->translation), \Nawarian\Raylib\Generated\Vector4::fromCData($cdata->rotation), \Nawarian\Raylib\Generated\Vector3::fromCData($cdata->scale));
    }
}
