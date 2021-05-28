<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

interface HasRaylibImageProcessConstants
{
    public const NONE = 0;
    public const COLOR_GRAYSCALE = 1;
    public const COLOR_TINT = 2;
    public const COLOR_INVERT = 3;
    public const COLOR_CONTRAST = 4;
    public const COLOR_BRIGHTNESS = 5;
    public const FLIP_VERTICAL = 6;
    public const FLIP_HORIZONTAL = 7;
}
