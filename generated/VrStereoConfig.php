<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class VrStereoConfig
{
    /**
     * VR projection matrices (per eye)
     */
    public array $projection;

    /**
     * VR view offset matrices (per eye)
     */
    public array $viewOffset;

    /**
     * VR left lens center
     */
    public array $leftLensCenter;

    /**
     * VR right lens center
     */
    public array $rightLensCenter;

    /**
     * VR left screen center
     */
    public array $leftScreenCenter;

    /**
     * VR right screen center
     */
    public array $rightScreenCenter;

    /**
     * VR distortion scale
     */
    public array $scale;

    /**
     * VR distortion scale in
     */
    public array $scaleIn;

    public function __construct(array $projection, array $viewOffset, array $leftLensCenter, array $rightLensCenter, array $leftScreenCenter, array $rightScreenCenter, array $scale, array $scaleIn)
    {
        $this->projection = $projection;
        $this->viewOffset = $viewOffset;
        $this->leftLensCenter = $leftLensCenter;
        $this->rightLensCenter = $rightLensCenter;
        $this->leftScreenCenter = $leftScreenCenter;
        $this->rightScreenCenter = $rightScreenCenter;
        $this->scale = $scale;
        $this->scaleIn = $scaleIn;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('VrStereoConfig');
        $type->projection = $this->projection;
        $type->viewOffset = $this->viewOffset;
        $type->leftLensCenter = $this->leftLensCenter;
        $type->rightLensCenter = $this->rightLensCenter;
        $type->leftScreenCenter = $this->leftScreenCenter;
        $type->rightScreenCenter = $this->rightScreenCenter;
        $type->scale = $this->scale;
        $type->scaleIn = $this->scaleIn;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self($cdata->projection, $cdata->viewOffset, $cdata->leftLensCenter, $cdata->rightLensCenter, $cdata->leftScreenCenter, $cdata->rightScreenCenter, $cdata->scale, $cdata->scaleIn);
    }
}

