<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

interface HasRaylibImageProcessConstants
{
    const NONE = 0;
    const COLOR_GRAYSCALE = 1;
    const COLOR_TINT = 2;
    const COLOR_INVERT = 3;
    const COLOR_CONTRAST = 4;
    const COLOR_BRIGHTNESS = 5;
    const FLIP_VERTICAL = 6;
    const FLIP_HORIZONTAL = 7;
}