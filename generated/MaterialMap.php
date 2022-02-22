<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class MaterialMap
{
    /**
     * Material map texture
     */
    public \Nawarian\Raylib\Generated\Texture $texture;

    /**
     * Material map color
     */
    public \Nawarian\Raylib\Generated\Color $color;

    /**
     * Material map value
     */
    public float $value;

    public function __construct(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Color $color, float $value)
    {
        $this->texture = $texture;
        $this->color = $color;
        $this->value = $value;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('MaterialMap');
        $type->texture = $this->texture->toCData();
        $type->color = $this->color->toCData();
        $type->value = $this->value;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\MaterialMap
    {
        return new self(\Nawarian\Raylib\Generated\Texture::fromCData($cdata->texture), \Nawarian\Raylib\Generated\Color::fromCData($cdata->color), $cdata->value);
    }
}
