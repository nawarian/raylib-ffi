<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class MaterialMap
{
    public Texture2D $texture;
    public Color $color;
    public float $value;

    public function __construct(Texture2D $texture, Color $color, float $value)
    {
        $this->texture = $texture;
        $this->color = $color;
        $this->value = $value;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $map */
            $map = $ffi->new('MaterialMap');
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct MaterialMap"'
            );
        }

        $map->texture = $this->texture->toCData($ffi);
        $map->color = $this->color->toCData($ffi);
        $map->value = $this->value;

        return $map;
    }
}
