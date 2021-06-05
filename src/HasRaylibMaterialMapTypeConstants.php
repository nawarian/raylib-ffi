<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

interface HasRaylibMaterialMapTypeConstants
{
    public const MAP_ALBEDO = 0;       // MAP_DIFFUSE
    public const MAP_METALNESS = 1;       // MAP_SPECULAR
    public const MAP_NORMAL = 2;
    public const MAP_ROUGHNESS = 3;
    public const MAP_OCCLUSION = 4;
    public const MAP_EMISSION = 5;
    public const MAP_HEIGHT = 6;
    public const MAP_CUBEMAP = 7;          // NOTE: Uses GL_TEXTURE_CUBE_MAP
    public const MAP_IRRADIANCE = 8;          // NOTE: Uses GL_TEXTURE_CUBE_MAP
    public const MAP_PREFILTER = 9;          // NOTE: Uses GL_TEXTURE_CUBE_MAP
    public const MAP_BRDF = 10;

    public const MAP_DIFFUSE = self::MAP_ALBEDO;
    public const MAP_SPECULAR = self::MAP_METALNESS;
}
