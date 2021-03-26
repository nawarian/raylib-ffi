<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;

/**
 * @method FFI\CData new(string $type)
 * @method void BeginMode2D(FFI\CData $camera2D)
 * @method void ClearBackground(FFI\CData $camera2D)
 * @method void DrawLine(int $x0, int $y0, int $x1, int $y1, FFI\CData $color)
 * @method void DrawRectangle(float $x, float $y, float $width, float $height, FFI\CData $color)
 * @method void DrawRectangleLines(float $x, float $y, float $width, float $height, FFI\CData $color)
 * @method void DrawRectangleRec(FFI\CData $rectangle, FFI\CData $color)
 * @method void DrawText(string $text, int $x, int $y, int $fontSize, FFI\CData $color)
 * @method FFI\CData Fade(FFI\CData $color, float $alpha)
 * @method int GetRandomValue(int $min, int $max)
 */
class RaylibFFIProxy
{
    private FFI $ffi;

    public function __construct(FFI $ffi)
    {
        $this->ffi = $ffi;
    }

    public function __call(string $method, array $args)
    {
        $callable = [$this->ffi, $method];
        return $callable(...$args);
    }
}
