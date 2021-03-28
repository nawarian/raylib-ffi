<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;

final class Raylib implements HasRaylibKeysConstants
{
    private RaylibFFIProxy $ffi;

    public function __construct(RaylibFFIProxy $ffi)
    {
        $this->ffi = $ffi;
    }

    public function beginDrawing(): void
    {
        $this->ffi->BeginDrawing();
    }

    public function beginMode2D(Types\Camera2D $camera): void
    {
        $this->ffi->BeginMode2D($camera->toCData($this->ffi));
    }

    public function beginMode3D(Types\Camera3D $camera): void
    {
        $this->ffi->BeginMode3D($camera->toCData($this->ffi));
    }

    public function clearBackground(Types\Color $color): void
    {
        $this->ffi->ClearBackground($color->toCData($this->ffi));
    }

    public function closeWindow(): void
    {
        $this->ffi->CloseWindow();
    }

    public function drawCube(
        Types\Vector3 $position,
        float $width,
        float $height,
        float $length,
        Types\Color $color
    ): void {
        $this->ffi->DrawCube($position->toCData($this->ffi), $width, $height, $length, $color->toCData($this->ffi));
    }

    public function drawCubeWires(
        Types\Vector3 $position,
        float $width,
        float $height,
        float $length,
        Types\Color $color
    ): void {
        $this->ffi->DrawCubeWires(
            $position->toCData($this->ffi),
            $width,
            $height,
            $length,
            $color->toCData($this->ffi)
        );
    }

    public function drawLine(int $x0, int $y0, int $x1, int $y1, Types\Color $color): void
    {
        $this->ffi->DrawLine($x0, $y0, $x1, $y1, $color->toCData($this->ffi));
    }

    public function drawPlane(Types\Vector3 $center, Types\Vector2 $size, Types\Color $color): void
    {
        $this->ffi->DrawPlane(
            $center->toCData($this->ffi),
            $size->toCData($this->ffi),
            $color->toCData($this->ffi),
        );
    }

    public function drawRectangle(float $x, float $y, float $width, float $height, Types\Color $color): void
    {
        $this->ffi->DrawRectangle($x, $y, $width, $height, $color->toCData($this->ffi));
    }

    public function drawRectangleLines(float $x, float $y, float $width, float $height, Types\Color $color): void
    {
        $this->ffi->DrawRectangleLines($x, $y, $width, $height, $color->toCData($this->ffi));
    }

    public function drawRectangleRec(Types\Rectangle $rec, Types\Color $color): void
    {
        $this->ffi->DrawRectangleRec($rec->toCData($this->ffi), $color->toCData($this->ffi));
    }

    public function drawText(string $text, int $x, int $y, int $fontSize, Types\Color $color): void
    {
        $this->ffi->DrawText($text, $x, $y, $fontSize, $color->toCData($this->ffi));
    }

    public function endDrawing(): void
    {
        $this->ffi->EndDrawing();
    }

    public function endMode2D(): void
    {
        $this->ffi->EndMode2D();
    }

    public function endMode3D(): void
    {
        $this->ffi->EndMode3D();
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function fade(Types\Color $color, float $alpha): Types\Color
    {
        $colorStruct = $this->ffi->Fade($color->toCData($this->ffi), $alpha);

        return new Types\Color($colorStruct->r, $colorStruct->g, $colorStruct->b, $colorStruct->a);
    }

    public function getFrameTime(): float
    {
        return $this->ffi->GetFrameTime();
    }

    public function getMouseWheelMove(): float
    {
        return $this->ffi->GetMouseWheelMove();
    }

    public function getRandomValue(int $min, int $max): int
    {
        return $this->ffi->GetRandomValue($min, $max);
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function getScreenToWorld2D(Types\Vector2 $position, Types\Camera2D $camera): Types\Vector2
    {
        $vec = $this->ffi->GetScreenToWorld2D($position->toCData($this->ffi), $camera->toCData($this->ffi));

        return new Types\Vector2($vec->x, $vec->y);
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function getWorldToScreen2D(Types\Vector2 $position, Types\Camera2D $camera): Types\Vector2
    {
        $vec = $this->ffi->GetWorldToScreen2D($position->toCData($this->ffi), $camera->toCData($this->ffi));

        return new Types\Vector2($vec->x, $vec->y);
    }

    public function initWindow(int $width, int $height, string $title): void
    {
        $this->ffi->InitWindow($width, $height, $title);
    }

    public function isKeyDown(int $key): bool
    {
        return $this->ffi->IsKeyDown($key);
    }

    public function isKeyPressed(int $key): bool
    {
        return $this->ffi->IsKeyPressed($key);
    }

    public function setCameraMode(Types\Camera3D $camera, int $mode): void
    {
        $this->ffi->SetCameraMode($camera->toCData($this->ffi), $mode);
    }

    public function setTargetFPS(int $fps): void
    {
        $this->ffi->SetTargetFPS($fps);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     */
    public function updateCamera(Types\Camera3D $camera): void
    {
        $this->ffi->UpdateCamera(FFI::addr($camera->toCData($this->ffi)));
    }

    public function windowShouldClose(): bool
    {
        return $this->ffi->WindowShouldClose();
    }

    public function vector2Add(Types\Vector2 $v1, Types\Vector2 $v2): Types\Vector2
    {
        return $v1->add($v2);
    }

    public function vector2Length(Types\Vector2 $vec): float
    {
        return $vec->length();
    }

    public function vector2Scale(Types\Vector2 $vec, float $scale): Types\Vector2
    {
        return $vec->scale($scale);
    }

    public function vector2Subtract(Types\Vector2 $v1, Types\Vector2 $v2): Types\Vector2
    {
        return $v1->subtract($v2);
    }
}
