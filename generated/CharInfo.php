<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class CharInfo
{
    /**
     * Character value (Unicode)
     */
    public int $value;

    /**
     * Character offset X when drawing
     */
    public int $offsetX;

    /**
     * Character offset Y when drawing
     */
    public int $offsetY;

    /**
     * Character advance position X
     */
    public int $advanceX;

    /**
     * Character image data
     */
    public \Nawarian\Raylib\Generated\Image $image;

    public function __construct(int $value, int $offsetX, int $offsetY, int $advanceX, \Nawarian\Raylib\Generated\Image $image)
    {
        $this->value = $value;
        $this->offsetX = $offsetX;
        $this->offsetY = $offsetY;
        $this->advanceX = $advanceX;
        $this->image = $image;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('CharInfo');
        $type->value = $this->value;
        $type->offsetX = $this->offsetX;
        $type->offsetY = $this->offsetY;
        $type->advanceX = $this->advanceX;
        $type->image = $this->image->toCData();
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\CharInfo
    {
        return new self($cdata->value, $cdata->offsetX, $cdata->offsetY, $cdata->advanceX, \Nawarian\Raylib\Generated\Image::fromCData($cdata->image));
    }
}
