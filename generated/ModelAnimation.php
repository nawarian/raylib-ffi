<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class ModelAnimation
{
    /**
     * Number of bones
     */
    public int $boneCount;

    /**
     * Number of animation frames
     */
    public int $frameCount;

    /**
     * Bones information (skeleton)
     */
    public array $bones;

    /**
     * Poses array by frame
     */
    public array $framePoses;

    public function __construct(int $boneCount, int $frameCount, array $bones, array $framePoses)
    {
        $this->boneCount = $boneCount;
        $this->frameCount = $frameCount;
        $this->bones = $bones;
        $this->framePoses = $framePoses;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('ModelAnimation');
        $type->boneCount = $this->boneCount;
        $type->frameCount = $this->frameCount;
        $type->bones = $this->bones;
        $type->framePoses = $this->framePoses;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\ModelAnimation
    {
        return new self($cdata->boneCount, $cdata->frameCount, $cdata->bones, $cdata->framePoses);
    }
}
