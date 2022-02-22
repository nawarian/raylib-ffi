<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class NPatchInfo
{
    /**
     * Texture source rectangle
     */
    public \Nawarian\Raylib\Generated\Rectangle $source;

    /**
     * Left border offset
     */
    public int $left;

    /**
     * Top border offset
     */
    public int $top;

    /**
     * Right border offset
     */
    public int $right;

    /**
     * Bottom border offset
     */
    public int $bottom;

    /**
     * Layout of the n-patch: 3x3, 1x3 or 3x1
     */
    public int $layout;

    public function __construct(\Nawarian\Raylib\Generated\Rectangle $source, int $left, int $top, int $right, int $bottom, int $layout)
    {
        $this->source = $source;
        $this->left = $left;
        $this->top = $top;
        $this->right = $right;
        $this->bottom = $bottom;
        $this->layout = $layout;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('NPatchInfo');
        $type->source = $this->source->toCData();
        $type->left = $this->left;
        $type->top = $this->top;
        $type->right = $this->right;
        $type->bottom = $this->bottom;
        $type->layout = $this->layout;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self(\Nawarian\Raylib\Generated\Rectangle::fromCData($cdata->source), $cdata->left, $cdata->top, $cdata->right, $cdata->bottom, $cdata->layout);
    }
}

