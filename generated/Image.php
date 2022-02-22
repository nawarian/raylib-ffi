<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Image
{
    /**
     * Image raw data
     */
    public FFI\CData $data;

    /**
     * Image base width
     */
    public int $width;

    /**
     * Image base height
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

    public function __construct(\FFI\CData $data, int $width, int $height, int $mipmaps, int $format)
    {
        $this->data = $data;
        $this->width = $width;
        $this->height = $height;
        $this->mipmaps = $mipmaps;
        $this->format = $format;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Image');
        $type->data = $this->data;
        $type->width = $this->width;
        $type->height = $this->height;
        $type->mipmaps = $this->mipmaps;
        $type->format = $this->format;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Image
    {
        return new self($cdata->data, $cdata->width, $cdata->height, $cdata->mipmaps, $cdata->format);
    }
}
