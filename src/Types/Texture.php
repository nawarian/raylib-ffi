<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

class Texture
{
    protected string $ffiType = 'Texture';

    public int $id = 0;
    public int $width = 0;
    public int $height = 0;
    public int $mipmaps = 0;
    public int $format = 0;

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $texture */
            $texture = $ffi->new($this->ffiType);
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                sprintf('Object $ffi does not provide the type "struct %s"', $this->ffiType)
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
