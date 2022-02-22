<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class Font
{
    /**
     * Base size (default chars height)
     */
    public int $baseSize;

    /**
     * Number of characters
     */
    public int $charsCount;

    /**
     * Padding around the chars
     */
    public int $charsPadding;

    /**
     * Characters texture atlas
     */
    public \Nawarian\Raylib\Generated\Texture $texture;

    /**
     * Characters rectangles in texture
     */
    public array $recs;

    /**
     * Characters info data
     */
    public \Nawarian\Raylib\Generated\CharInfo $chars;

    public function __construct(int $baseSize, int $charsCount, int $charsPadding, \Nawarian\Raylib\Generated\Texture $texture, array $recs, \Nawarian\Raylib\Generated\CharInfo $chars)
    {
        $this->baseSize = $baseSize;
        $this->charsCount = $charsCount;
        $this->charsPadding = $charsPadding;
        $this->texture = $texture;
        $this->recs = $recs;
        $this->chars = $chars;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Font');
        $type->baseSize = $this->baseSize;
        $type->charsCount = $this->charsCount;
        $type->charsPadding = $this->charsPadding;
        $type->texture = $this->texture->toCData();
        $type->recs = $this->recs;
        $type->chars = $this->chars->toCData();
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self($cdata->baseSize, $cdata->charsCount, $cdata->charsPadding, \Nawarian\Raylib\Generated\Texture::fromCData($cdata->texture), $cdata->recs, \Nawarian\Raylib\Generated\CharInfo::fromCData($cdata->chars));
    }
}

