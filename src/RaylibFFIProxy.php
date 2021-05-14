<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;
use FFI\CData;

/**
 * @method CData new(string $type)
 * @method void BeginDrawing()
 * @method void BeginMode2D(CData $camera2D)
 * @method void BeginMode3D(CData $camera3D)
 * @method void BeginScissorMode(int $x, int $y, int $width, int $height)
 * @method bool CheckCollisionPointRec(CData $point, CData $rec)
 * @method bool CheckCollisionRayBox(CData $ray, CData $box)
 * @method void ClearBackground(CData $color)
 * @method void CloseWindow()
 * @method void DrawCircleV(CData $center, float $radius, CData $color)
 * @method void DrawCube(CData $position, float $width, float $height, float $length, CData $color)
 * @method void DrawCubeWires(CData $position, float $width, float $height, float $length, CData $color)
 * @method void DrawFPS(int $posX, int $posY)
 * @method void DrawGrid(int $slices, float $spacing)
 * @method void DrawLine(int $x0, int $y0, int $x1, int $y1, CData $color)
 * @method void DrawPlane(CData $center, CData $size, CData $color)
 * @method void DrawRay(CData $ray, CData $color)
 * @method void DrawRectangle(float $x, float $y, float $width, float $height, CData $color)
 * @method void DrawRectangleLines(float $x, float $y, float $width, float $height, CData $color)
 * @method void DrawRectangleLinesEx(CData $rectangle, int $lineThick, CData $color)
 * @method void DrawRectangleRec(CData $rectangle, CData $color)
 * @method void DrawText(string $text, int $x, int $y, int $fontSize, CData $color)
 * @method CData DrawTextureEx(CData $texture, CData $position, float $rotation, float $scale, CData $tint)
 * @method void EndDrawing()
 * @method void EndMode2D()
 * @method void EndMode3D()
 * @method void EndScissorMode()
 * @method CData Fade(CData $color, float $alpha)
 * @method CData GetColor(int $hex)
 * @method float GetFrameTime()
 * @method int GetGestureDetected()
 * @method CData GetMousePosition()
 * @method CData GetMouseRay(CData $mousePosition, CData $camera)
 * @method float GetMouseWheelMove()
 * @method int GetMouseX()
 * @method int GetMouseY()
 * @method int GetRandomValue(int $min, int $max)
 * @method CData GetScreenToWorld2D(CData $position, CData $camera)
 * @method int GetScreenWidth()
 * @method int GetScreenHeight()
 * @method CData GetTouchPosition(int $index)
 * @method CData GetWorldToScreen(CData $position, CData $camera)
 * @method CData GetWorldToScreen2D(CData $position, CData $camera)
 * @method void InitWindow(int $width, int $height, string $title)
 * @method bool IsKeyDown(int $key)
 * @method bool IsKeyPressed(int $key)
 * @method bool IsMouseButtonDown(int $button)
 * @method bool IsMouseButtonPressed(int $button)
 * @method int LoadStorageValue(int $position)
 * @method CData LoadTexture(string $filename)
 * @method int MeasureText(string $text, int $fontSize)
 * @method bool SaveStorageValue(int $position, int $value)
 * @method void SetCameraMode(CData $camera, int $mode)
 * @method void SetTargetFPS(int $fps)
 * @method void UnloadTexture(CData $texture)
 * @method void UpdateCamera(CData $camera)
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
