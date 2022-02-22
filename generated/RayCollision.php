<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class RayCollision
{
    /**
     * Did the ray hit something?
     */
    public bool $hit;

    /**
     * Distance to nearest hit
     */
    public float $distance;

    /**
     * Point of nearest hit
     */
    public \Nawarian\Raylib\Generated\Vector3 $point;

    /**
     * Surface normal of hit
     */
    public \Nawarian\Raylib\Generated\Vector3 $normal;

    public function __construct(bool $hit, float $distance, \Nawarian\Raylib\Generated\Vector3 $point, \Nawarian\Raylib\Generated\Vector3 $normal)
    {
        $this->hit = $hit;
        $this->distance = $distance;
        $this->point = $point;
        $this->normal = $normal;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('RayCollision');
        $type->hit = $this->hit->toCData();
        $type->distance = $this->distance;
        $type->point = $this->point->toCData();
        $type->normal = $this->normal->toCData();
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\RayCollision
    {
        return new self(bool::fromCData($cdata->hit), $cdata->distance, \Nawarian\Raylib\Generated\Vector3::fromCData($cdata->point), \Nawarian\Raylib\Generated\Vector3::fromCData($cdata->normal));
    }
}
