<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

interface HasRaylibFilterModeConstants
{
    public const FILTER_POINT = 0; // No filter, just pixel aproximation
    public const FILTER_BILINEAR = 1;// Linear filtering
    public const FILTER_TRILINEAR = 2;// Trilinear filtering (linear with mipmaps)
    public const FILTER_ANISOTROPIC_4X = 3;// Anisotropic filtering 4x
    public const FILTER_ANISOTROPIC_8X = 4;// Anisotropic filtering 8x
    public const FILTER_ANISOTROPIC_16X = 5;// Anisotropic filtering 16x
}
