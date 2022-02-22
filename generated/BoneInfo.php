<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class BoneInfo
{
    /**
     * Bone name
     */
    public array $name;

    /**
     * Bone parent
     */
    public int $parent;

    public function __construct(array $name, int $parent)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('BoneInfo');
        $type->name = $this->name;
        $type->parent = $this->parent;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self($cdata->name, $cdata->parent);
    }
}

