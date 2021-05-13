<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;

/**
 * @method FFI\CData new(string $type)
 * @method void BeginDrawing()
 * @method void BeginMode2D(FFI\CData $camera2D)
 * @method void BeginMode3D(FFI\CData $camera3D)
 * @method void BeginScissorMode(int $x, int $y, int $width, int $height)
 * @method bool CheckCollisionPointRec(FFI\CData $point, FFI\CData $rec)
 * @method bool CheckCollisionRayBox(FFI\CData $ray, FFI\CData $box)
 * @method void ClearBackground(FFI\CData $color)
 * @method void CloseWindow()
 * @method void DrawCircleV(FFI\CData $center, float $radius, FFI\CData $color)
 * @method void DrawCube(FFI\CData $position, float $width, float $height, float $length, FFI\CData $color)
 * @method void DrawCubeWires(FFI\CData $position, float $width, float $height, float $length, FFI\CData $color)
 * @method void DrawFPS(int $posX, int $posY)
 * @method void DrawGrid(int $slices, float $spacing)
 * @method void DrawLine(int $x0, int $y0, int $x1, int $y1, FFI\CData $color)
 * @method void DrawPlane(FFI\CData $center, FFI\CData $size, FFI\CData $color)
 * @method void DrawRay(FFI\CData $ray, FFI\CData $color)
 * @method void DrawRectangle(float $x, float $y, float $width, float $height, FFI\CData $color)
 * @method void DrawRectangleLines(float $x, float $y, float $width, float $height, FFI\CData $color)
 * @method void DrawRectangleLinesEx(FFI\CData $rectangle, int $lineThick, FFI\CData $color)
 * @method void DrawRectangleRec(FFI\CData $rectangle, FFI\CData $color)
 * @method void DrawText(string $text, int $x, int $y, int $fontSize, FFI\CData $color)
 * @method void EndDrawing()
 * @method void EndMode2D()
 * @method void EndMode3D()
 * @method void EndScissorMode()
 * @method FFI\CData Fade(FFI\CData $color, float $alpha)
 * @method float GetFrameTime()
 * @method int GetGestureDetected()
 * @method FFI\CData GetMousePosition()
 * @method FFI\CData GetMouseRay(FFI\CData $mousePosition, FFI\CData $camera)
 * @method float GetMouseWheelMove()
 * @method int GetMouseX()
 * @method int GetMouseY()
 * @method int GetRandomValue(int $min, int $max)
 * @method FFI\CData GetScreenToWorld2D(FFI\CData $position, FFI\CData $camera)
 * @method int GetScreenWidth()
 * @method int GetScreenHeight()
 * @method FFI\CData GetTouchPosition(int $index)
 * @method FFI\CData GetWorldToScreen2D(FFI\CData $position, FFI\CData $camera)
 * @method void InitWindow(int $width, int $height, string $title)
 * @method bool IsKeyDown(int $key)
 * @method bool IsKeyPressed(int $key)
 * @method bool IsMouseButtonDown(int $button)
 * @method bool IsMouseButtonPressed(int $button)
 * @method int MeasureText(string $text, int $fontSize)
 * @method void SetCameraMode(FFI\CData $camera, int $mode)
 * @method void SetTargetFPS(int $fps)
 * @method void UpdateCamera(FFI\CData $camera)
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
