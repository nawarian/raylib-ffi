<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

class Font
{
    public int $baseSize;
    public int $charsCount;
    public int $charsPadding;
    public CData $texture;
    public CData $recs;
    public CData $chars;

    public function __construct(
        int $baseSize,
        int $charsCount,
        int $charsPadding,
        CData $texture,
        CData $recs,
        CData $chars
    ) {
        $this->baseSize = $baseSize;
        $this->charsCount = $charsCount;
        $this->charsPadding = $charsPadding;
        $this->texture = $texture;
        $this->recs = $recs;
        $this->chars = $chars;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $font = $ffi->new('Font');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Image"'
            );
        }

        $font->baseSize = $this->baseSize;
        $font->charsCount = $this->charsCount;
        $font->charsPadding = $this->charsPadding;
        $font->texture = $this->texture;
        $font->recs = $this->recs;
        $font->chars = $this->chars;

        return $font;
    }
}
