<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class Texture
{
    /**
     * OpenGL texture id
     */
    public int $id;

    /**
     * Texture base width
     */
    public int $width;

    /**
     * Texture base height
     */
    public int $height;

    /**
     * Mipmap levels, 1 by default
     */
    public int $mipmaps;

    /**
     * Data format (PixelFormat type)
     */
    public int $format;

    public function __construct(int $id, int $width, int $height, int $mipmaps, int $format)
    {
        $this->id = $id;
        $this->width = $width;
        $this->height = $height;
        $this->mipmaps = $mipmaps;
        $this->format = $format;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Texture');
        $type->id = $this->id;
        $type->width = $this->width;
        $type->height = $this->height;
        $type->mipmaps = $this->mipmaps;
        $type->format = $this->format;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self($cdata->id, $cdata->width, $cdata->height, $cdata->mipmaps, $cdata->format);
    }
}

