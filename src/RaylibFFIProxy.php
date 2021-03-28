<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;
use Nawarian\Raylib\Types\Vector2;

/**
 * @method FFI\CData new(string $type)
 * @method void BeginDrawing()
 * @method void BeginMode2D(FFI\CData $camera2D)
 * @method void ClearBackground(FFI\CData $camera2D)
 * @method void CloseWindow()
 * @method void DrawLine(int $x0, int $y0, int $x1, int $y1, FFI\CData $color)
 * @method void DrawRectangle(float $x, float $y, float $width, float $height, FFI\CData $color)
 * @method void DrawRectangleLines(float $x, float $y, float $width, float $height, FFI\CData $color)
 * @method void DrawRectangleRec(FFI\CData $rectangle, FFI\CData $color)
 * @method void DrawText(string $text, int $x, int $y, int $fontSize, FFI\CData $color)
 * @method void EndDrawing()
 * @method void EndMode2D()
 * @method FFI\CData Fade(FFI\CData $color, float $alpha)
 * @method float GetFrameTime()
 * @method float GetMouseWheelMove()
 * @method int GetRandomValue(int $min, int $max)
 * @method FFI\CData GetScreenToWorld2D(FFI\CData $position, FFI\CData $camera)
 * @method FFI\CData GetWorldToScreen2D(FFI\CData $position, FFI\CData $camera)
 * @method void InitWindow(int $width, int $height, string $title)
 * @method bool IsKeyDown(int $key)
 * @method bool IsKeyPressed(int $key)
 * @method void SetTargetFPS(int $fps)
 * @method bool WindowShouldClose()
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
