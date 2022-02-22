<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class BoneInfo
{
    /**
     * Bone name
     */
    public array $name[32];

    /**
     * Bone parent
     */
    public int $parent;

    public function __construct(array $name[32], int $parent)
    {
        $this->name[32] = $name[32];
        $this->parent = $parent;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('BoneInfo');
        $type->name[32] = $this->name[32];
        $type->parent = $this->parent;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\BoneInfo
    {
        return new self($cdata->name[32], $cdata->parent);
    }
}
