<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class RenderTexture
{
    /**
     * OpenGL framebuffer object id
     */
    public int $id;

    /**
     * Color buffer attachment texture
     */
    public \Nawarian\Raylib\Generated\Texture $texture;

    /**
     * Depth buffer attachment texture
     */
    public \Nawarian\Raylib\Generated\Texture $depth;

    public function __construct(int $id, \Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Texture $depth)
    {
        $this->id = $id;
        $this->texture = $texture;
        $this->depth = $depth;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('RenderTexture');
        $type->id = $this->id;
        $type->texture = $this->texture->toCData();
        $type->depth = $this->depth->toCData();
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self($cdata->id, \Nawarian\Raylib\Generated\Texture::fromCData($cdata->texture), \Nawarian\Raylib\Generated\Texture::fromCData($cdata->depth));
    }
}

