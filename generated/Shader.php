<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class Shader
{
    /**
     * Shader program id
     */
    public int $id;

    /**
     * Shader locations array (MAX_SHADER_LOCATIONS)
     */
    public array $locs;

    public function __construct(int $id, array $locs)
    {
        $this->id = $id;
        $this->locs = $locs;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Shader');
        $type->id = $this->id;
        $type->locs = $this->locs;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self($cdata->id, $cdata->locs);
    }
}

