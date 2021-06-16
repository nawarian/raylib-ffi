<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class RenderTexture2D
{
    public int $id;
    public Texture2D $texture;
    public Texture2D $depth;

    public function __construct(int $id, Texture2D $texture, Texture2D $depth)
    {
        $this->id = $id;
        $this->texture = $texture;
        $this->depth = $depth;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $renderTexture = $ffi->new('RenderTexture');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct RenderTexture"'
            );
        }

        $renderTexture->id = $this->id;
        $renderTexture->texture = $this->texture->toCData($ffi);
        $renderTexture->depth = $this->depth->toCData($ffi);

        return $renderTexture;
    }
}
