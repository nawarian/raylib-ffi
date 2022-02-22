<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class VrDeviceInfo
{
    /**
     * Horizontal resolution in pixels
     */
    public int $hResolution;

    /**
     * Vertical resolution in pixels
     */
    public int $vResolution;

    /**
     * Horizontal size in meters
     */
    public float $hScreenSize;

    /**
     * Vertical size in meters
     */
    public float $vScreenSize;

    /**
     * Screen center in meters
     */
    public float $vScreenCenter;

    /**
     * Distance between eye and display in meters
     */
    public float $eyeToScreenDistance;

    /**
     * Lens separation distance in meters
     */
    public float $lensSeparationDistance;

    /**
     * IPD (distance between pupils) in meters
     */
    public float $interpupillaryDistance;

    /**
     * Lens distortion constant parameters
     */
    public array $lensDistortionValues[4];

    /**
     * Chromatic aberration correction parameters
     */
    public array $chromaAbCorrection[4];

    public function __construct(int $hResolution, int $vResolution, float $hScreenSize, float $vScreenSize, float $vScreenCenter, float $eyeToScreenDistance, float $lensSeparationDistance, float $interpupillaryDistance, array $lensDistortionValues[4], array $chromaAbCorrection[4])
    {
        $this->hResolution = $hResolution;
        $this->vResolution = $vResolution;
        $this->hScreenSize = $hScreenSize;
        $this->vScreenSize = $vScreenSize;
        $this->vScreenCenter = $vScreenCenter;
        $this->eyeToScreenDistance = $eyeToScreenDistance;
        $this->lensSeparationDistance = $lensSeparationDistance;
        $this->interpupillaryDistance = $interpupillaryDistance;
        $this->lensDistortionValues[4] = $lensDistortionValues[4];
        $this->chromaAbCorrection[4] = $chromaAbCorrection[4];
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('VrDeviceInfo');
        $type->hResolution = $this->hResolution;
        $type->vResolution = $this->vResolution;
        $type->hScreenSize = $this->hScreenSize;
        $type->vScreenSize = $this->vScreenSize;
        $type->vScreenCenter = $this->vScreenCenter;
        $type->eyeToScreenDistance = $this->eyeToScreenDistance;
        $type->lensSeparationDistance = $this->lensSeparationDistance;
        $type->interpupillaryDistance = $this->interpupillaryDistance;
        $type->lensDistortionValues[4] = $this->lensDistortionValues[4];
        $type->chromaAbCorrection[4] = $this->chromaAbCorrection[4];
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\VrDeviceInfo
    {
        return new self($cdata->hResolution, $cdata->vResolution, $cdata->hScreenSize, $cdata->vScreenSize, $cdata->vScreenCenter, $cdata->eyeToScreenDistance, $cdata->lensSeparationDistance, $cdata->interpupillaryDistance, $cdata->lensDistortionValues[4], $cdata->chromaAbCorrection[4]);
    }
}
