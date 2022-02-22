<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class VrStereoConfig
{
    /**
     * VR projection matrices (per eye)
     */
    public array $projection[2];

    /**
     * VR view offset matrices (per eye)
     */
    public array $viewOffset[2];

    /**
     * VR left lens center
     */
    public array $leftLensCenter[2];

    /**
     * VR right lens center
     */
    public array $rightLensCenter[2];

    /**
     * VR left screen center
     */
    public array $leftScreenCenter[2];

    /**
     * VR right screen center
     */
    public array $rightScreenCenter[2];

    /**
     * VR distortion scale
     */
    public array $scale[2];

    /**
     * VR distortion scale in
     */
    public array $scaleIn[2];

    public function __construct(array $projection[2], array $viewOffset[2], array $leftLensCenter[2], array $rightLensCenter[2], array $leftScreenCenter[2], array $rightScreenCenter[2], array $scale[2], array $scaleIn[2])
    {
        $this->projection[2] = $projection[2];
        $this->viewOffset[2] = $viewOffset[2];
        $this->leftLensCenter[2] = $leftLensCenter[2];
        $this->rightLensCenter[2] = $rightLensCenter[2];
        $this->leftScreenCenter[2] = $leftScreenCenter[2];
        $this->rightScreenCenter[2] = $rightScreenCenter[2];
        $this->scale[2] = $scale[2];
        $this->scaleIn[2] = $scaleIn[2];
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('VrStereoConfig');
        $type->projection[2] = $this->projection[2];
        $type->viewOffset[2] = $this->viewOffset[2];
        $type->leftLensCenter[2] = $this->leftLensCenter[2];
        $type->rightLensCenter[2] = $this->rightLensCenter[2];
        $type->leftScreenCenter[2] = $this->leftScreenCenter[2];
        $type->rightScreenCenter[2] = $this->rightScreenCenter[2];
        $type->scale[2] = $this->scale[2];
        $type->scaleIn[2] = $this->scaleIn[2];
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\VrStereoConfig
    {
        return new self($cdata->projection[2], $cdata->viewOffset[2], $cdata->leftLensCenter[2], $cdata->rightLensCenter[2], $cdata->leftScreenCenter[2], $cdata->rightScreenCenter[2], $cdata->scale[2], $cdata->scaleIn[2]);
    }
}
