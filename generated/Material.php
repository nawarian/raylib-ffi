<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

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
    public array $params;

    public function __construct(\Nawarian\Raylib\Generated\Shader $shader, array $maps, array $params)
    {
        $this->shader = $shader;
        $this->maps = $maps;
        $this->params = $params;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Material');
        $type->shader = $this->shader->toCData();
        $type->maps = $this->maps;
        $type->params = $this->params;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self(\Nawarian\Raylib\Generated\Shader::fromCData($cdata->shader), $cdata->maps, $cdata->params);
    }
}

