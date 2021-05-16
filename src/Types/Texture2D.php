<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Texture2D
{
    public int $id;
    public int $width;
    public int $height;
    public int $mipmaps;
    public int $format;

    public function __construct(int $id, int $width, int $height, int $mipmaps, int $format)
    {
        $this->id = $id;
        $this->width = $width;
        $this->height = $height;
        $this->mipmaps = $mipmaps;
        $this->format = $format;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $texture = $ffi->new('Texture');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Texture"'
            );
        }

        $texture->id = $this->id;
        $texture->width = $this->width;
        $texture->height = $this->height;
        $texture->mipmaps = $this->mipmaps;
        $texture->format = $this->format;

        return $texture;
    }
}
