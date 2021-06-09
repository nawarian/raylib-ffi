<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

interface HasRaylibPixelFormatConstants
{
    public const UNCOMPRESSED_GRAYSCALE = 1;
    public const UNCOMPRESSED_GRAY_ALPHA = 2;
    public const UNCOMPRESSED_R5G6B5 = 3;
    public const UNCOMPRESSED_R8G8B8 = 4;
    public const UNCOMPRESSED_R5G5B5A1 = 5;
    public const UNCOMPRESSED_R4G4B4A4 = 6;
    public const UNCOMPRESSED_R8G8B8A8 = 7;
    public const UNCOMPRESSED_R32 = 8;
    public const UNCOMPRESSED_R32G32B32 = 9;
    public const UNCOMPRESSED_R32G32B32A32 = 10;
    public const COMPRESSED_DXT1_RGB = 11;
    public const COMPRESSED_DXT1_RGBA = 12;
    public const COMPRESSED_DXT3_RGBA = 13;
    public const COMPRESSED_DXT5_RGBA = 14;
    public const COMPRESSED_ETC1_RGB = 15;
    public const COMPRESSED_ETC2_RGB = 16;
    public const COMPRESSED_ETC2_EAC_RGBA = 17;
    public const COMPRESSED_PVRT_RGB = 18;
    public const COMPRESSED_PVRT_RGBA = 19;
    public const COMPRESSED_ASTC_4X4_RGBA = 20;
    public const COMPRESSED_ASTC_8X8_RGBA = 21;
}
