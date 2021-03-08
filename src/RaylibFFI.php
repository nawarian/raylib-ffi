<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI\CData;
use FFI;
use RuntimeException;

final class RaylibFFI
{
    private const RAYLIB_H = __DIR__ . '/raylib.h';

    public const KEY_APOSTROPHE      = 39;
    public const KEY_COMMA           = 44;
    public const KEY_MINUS           = 45;
    public const KEY_PERIOD          = 46;
    public const KEY_SLASH           = 47;
    public const KEY_ZERO            = 48;
    public const KEY_ONE             = 49;
    public const KEY_TWO             = 50;
    public const KEY_THREE           = 51;
    public const KEY_FOUR            = 52;
    public const KEY_FIVE            = 53;
    public const KEY_SIX             = 54;
    public const KEY_SEVEN           = 55;
    public const KEY_EIGHT           = 56;
    public const KEY_NINE            = 57;
    public const KEY_SEMICOLON       = 59;
    public const KEY_EQUAL           = 61;
    public const KEY_A               = 65;
    public const KEY_B               = 66;
    public const KEY_C               = 67;
    public const KEY_D               = 68;
    public const KEY_E               = 69;
    public const KEY_F               = 70;
    public const KEY_G               = 71;
    public const KEY_H               = 72;
    public const KEY_I               = 73;
    public const KEY_J               = 74;
    public const KEY_K               = 75;
    public const KEY_L               = 76;
    public const KEY_M               = 77;
    public const KEY_N               = 78;
    public const KEY_O               = 79;
    public const KEY_P               = 80;
    public const KEY_Q               = 81;
    public const KEY_R               = 82;
    public const KEY_S               = 83;
    public const KEY_T               = 84;
    public const KEY_U               = 85;
    public const KEY_V               = 86;
    public const KEY_W               = 87;
    public const KEY_X               = 88;
    public const KEY_Y               = 89;
    public const KEY_Z               = 90;
    public const KEY_SPACE           = 32;
    public const KEY_ESCAPE          = 256;
    public const KEY_ENTER           = 257;
    public const KEY_TAB             = 258;
    public const KEY_BACKSPACE       = 259;
    public const KEY_INSERT          = 260;
    public const KEY_DELETE          = 261;
    public const KEY_RIGHT           = 262;
    public const KEY_LEFT            = 263;
    public const KEY_DOWN            = 264;
    public const KEY_UP              = 265;
    public const KEY_PAGE_UP         = 266;
    public const KEY_PAGE_DOWN       = 267;
    public const KEY_HOME            = 268;
    public const KEY_END             = 269;
    public const KEY_CAPS_LOCK       = 280;
    public const KEY_SCROLL_LOCK     = 281;
    public const KEY_NUM_LOCK        = 282;
    public const KEY_PRINT_SCREEN    = 283;
    public const KEY_PAUSE           = 284;
    public const KEY_F1              = 290;
    public const KEY_F2              = 291;
    public const KEY_F3              = 292;
    public const KEY_F4              = 293;
    public const KEY_F5              = 294;
    public const KEY_F6              = 295;
    public const KEY_F7              = 296;
    public const KEY_F8              = 297;
    public const KEY_F9              = 298;
    public const KEY_F10             = 299;
    public const KEY_F11             = 300;
    public const KEY_F12             = 301;
    public const KEY_LEFT_SHIFT      = 340;
    public const KEY_LEFT_CONTROL    = 341;
    public const KEY_LEFT_ALT        = 342;
    public const KEY_LEFT_SUPER      = 343;
    public const KEY_RIGHT_SHIFT     = 344;
    public const KEY_RIGHT_CONTROL   = 345;
    public const KEY_RIGHT_ALT       = 346;
    public const KEY_RIGHT_SUPER     = 347;
    public const KEY_KB_MENU         = 348;
    public const KEY_LEFT_BRACKET    = 91;
    public const KEY_BACKSLASH       = 92;
    public const KEY_RIGHT_BRACKET   = 93;
    public const KEY_GRAVE           = 96;
    public const KEY_KP_0            = 320;
    public const KEY_KP_1            = 321;
    public const KEY_KP_2            = 322;
    public const KEY_KP_3            = 323;
    public const KEY_KP_4            = 324;
    public const KEY_KP_5            = 325;
    public const KEY_KP_6            = 326;
    public const KEY_KP_7            = 327;
    public const KEY_KP_8            = 328;
    public const KEY_KP_9            = 329;
    public const KEY_KP_DECIMAL      = 330;
    public const KEY_KP_DIVIDE       = 331;
    public const KEY_KP_MULTIPLY     = 332;
    public const KEY_KP_SUBTRACT     = 333;
    public const KEY_KP_ADD          = 334;
    public const KEY_KP_ENTER        = 335;
    public const KEY_KP_EQUAL        = 336;

    private static FFI $ffi;

    public static function boot(): void
    {
        /** @var FFI|null $ffi */
        $ffi = FFI::load(self::RAYLIB_H);

        // TODO: find a way to test this exception
        if (is_null($ffi)) {
            throw new RuntimeException(
                'Could not load header file ' . self::RAYLIB_H,
            );
        }

        self::$ffi = $ffi;
    }

    public static function __callStatic(string $method, array $args)
    {
        $callable = [self::$ffi, $method];
        return $callable(...$args);
    }

    public static function Rectangle(float $x, float $y, float $width, float $height): CData
    {
        $rec = self::new('Rectangle');
        $rec->x = $x;
        $rec->y = $y;
        $rec->width = $width;
        $rec->height = $height;

        return $rec;
    }

    public static function Color(int $r, int $g, int $b, int $a): CData
    {
        $color = self::new('Color');
        $color->r = $r;
        $color->g = $g;
        $color->b = $b;
        $color->a = $a;

        return $color;
    }

    public static function Vector2(float $x, float $y): CData
    {
        $vec = self::new('Vector2');
        $vec->x = $x;
        $vec->y = $y;

        return $vec;
    }

    public static function Camera2D(CData $offset, CData $target, float $rotation, float $zoom): CData
    {
        $camera = self::new('Camera2D');
        $camera->offset = $offset;
        $camera->target = $target;
        $camera->rotation = $rotation;
        $camera->zoom = $zoom;

        return $camera;
    }
}
