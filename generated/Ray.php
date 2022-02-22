<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Ray
{
    /**
     * Ray position (origin)
     */
    public \Nawarian\Raylib\Generated\Vector3 $position;

    /**
     * Ray direction
     */
    public \Nawarian\Raylib\Generated\Vector3 $direction;

    public function __construct(\Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Vector3 $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Ray');
        $type->position = $this->position->toCData();
        $type->direction = $this->direction->toCData();
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Ray
    {
        return new self(\Nawarian\Raylib\Generated\Vector3::fromCData($cdata->position), \Nawarian\Raylib\Generated\Vector3::fromCData($cdata->direction));
    }
}
