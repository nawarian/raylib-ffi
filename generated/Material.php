<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Material
{
    /**
     * Material shader
     */
    public \Nawarian\Raylib\Generated\Shader $shader;

    /**
     * Material maps array (MAX_MATERIAL_MAPS)
     */
    public array $maps;

    /**
     * Material generic parameters (if required)
     */
    public array $params[4];

    public function __construct(\Nawarian\Raylib\Generated\Shader $shader, array $maps, array $params[4])
    {
        $this->shader = $shader;
        $this->maps = $maps;
        $this->params[4] = $params[4];
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Material');
        $type->shader = $this->shader->toCData();
        $type->maps = $this->maps;
        $type->params[4] = $this->params[4];
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Material
    {
        return new self(\Nawarian\Raylib\Generated\Shader::fromCData($cdata->shader), $cdata->maps, $cdata->params[4]);
    }
}
