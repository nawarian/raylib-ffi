<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Material
{
    public Shader $shader;

    /**
     * @var MaterialMap[]
     */
    public array $maps = [];

    /**
     * @var float[]
     */
    public array $params = [];

    /**
     * @param Shader $shader
     * @param MaterialMap[] $maps
     * @param float[] $params
     */
    public function __construct(Shader $shader, array $maps, array $params)
    {
        $this->shader = $shader;
        $this->maps = $maps;
        $this->params = $params;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $material */
            $material = $ffi->new('Material');
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Material"'
            );
        }

        $material->shader = $this->shader->toCData($ffi);
        $material->maps = array_map(fn (MaterialMap $map) => $map->toCData($ffi), $this->maps);
        $material->params = $this->params;

        return $material;
    }
}
