<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

final class Raylib implements HasRaylibKeysConstants
{
    private RaylibFFIProxy $ffi;

    public function __construct(RaylibFFIProxy $ffi)
    {
        $this->ffi = $ffi;
    }

    public function __call(string $method, array $args)
    {
        $callable = [$this->ffi, $method];
        return $callable(...$args);
    }

    public function beginDrawing(): void
    {
        $this->ffi->BeginDrawing();
    }

    public function beginMode2D(Types\Camera2D $camera): void
    {
        $this->ffi->BeginMode2D($camera->toCData($this->ffi));
    }

    public function clearBackground(Types\Color $color): void
    {
        $this->ffi->ClearBackground($color->toCData($this->ffi));
    }

    public function closeWindow(): void
    {
        $this->ffi->CloseWindow();
    }

    public function drawLine(int $x0, int $y0, int $x1, int $y1, Types\Color $color): void
    {
        $this->ffi->DrawLine($x0, $y0, $x1, $y1, $color->toCData($this->ffi));
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

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function fade(Types\Color $color, float $alpha): Types\Color
    {
        $colorStruct = $this->ffi->Fade($color->toCData($this->ffi), $alpha);

        return new Types\Color($colorStruct->r, $colorStruct->g, $colorStruct->b, $colorStruct->a);
    }

    public function getMouseWheelMove(): float
    {
        return $this->ffi->GetMouseWheelMove();
    }

    public function getRandomValue(int $min, int $max): int
    {
        return $this->ffi->GetRandomValue($min, $max);
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

    public function setTargetFPS(int $fps): void
    {
        $this->ffi->SetTargetFPS($fps);
    }

    public function windowShouldClose(): bool
    {
        return $this->ffi->WindowShouldClose();
    }
}
