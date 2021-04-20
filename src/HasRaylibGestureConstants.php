<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

interface HasRaylibGestureConstants
{
    public const GESTURE_NONE = 0;
    public const GESTURE_TAP = 1;
    public const GESTURE_DOUBLETAP = 2;
    public const GESTURE_HOLD = 4;
    public const GESTURE_DRAG = 8;
    public const GESTURE_SWIPE_RIGHT = 16;
    public const GESTURE_SWIPE_LEFT = 32;
    public const GESTURE_SWIPE_UP = 64;
    public const GESTURE_SWIPE_DOWN = 128;
    public const GESTURE_PINCH_IN = 256;
    public const GESTURE_PINCH_OUT = 512;
}
