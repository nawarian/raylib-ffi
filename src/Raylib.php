<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;
use RuntimeException;

final class Raylib implements HasRaylibKeysConstants
{
    private FFI $ffi;

    public function __construct()
    {
        // TODO: make it multi platform
        $raylibHeader = __DIR__ . '/raylib.h';

        /** @var FFI|null $ffi */
        $ffi = FFI::load($raylibHeader);

        if ($ffi === null) {
            throw new RuntimeException("Could not load header file '{$raylibHeader}'.");
        }

        $this->ffi = $ffi;
    }

    public function __call(string $method, array $args)
    {
        $callable = [$this->ffi, $method];
        return $callable(...$args);
    }

    /**
     * @psalm-suppress UndefinedMethod
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function GetRandomValue(int $min, int $max): int
    {
        return (int) $this->ffi->GetRandomValue($min, $max);
    }

    /**
     * @psalm-suppress UndefinedMethod
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function BeginMode2D(Types\Camera2D $camera): void
    {
        $this->ffi->BeginMode2D($camera->toCData($this->ffi));
    }

    /**
     * @psalm-suppress UndefinedMethod
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function ClearBackground(Types\Color $color): void
    {
        $this->ffi->ClearBackground($color->toCData($this->ffi));
    }

    /**
     * @psalm-suppress UndefinedMethod
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function DrawLine(
        int $x0,
        int $y0,
        int $x1,
        int $y1,
        Types\Color $color
    ): void {
        $this->ffi->DrawLine($x0, $y0, $x1, $y1, $color->toCData($this->ffi));
    }

    /**
     * @psalm-suppress UndefinedMethod
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function DrawRectangle(
        float $x,
        float $y,
        float $width,
        float $height,
        Types\Color $color
    ): void {
        $this->ffi->DrawRectangle(
            $x,
            $y,
            $width,
            $height,
            $color->toCData($this->ffi),
        );
    }

    /**
     * @psalm-suppress UndefinedMethod
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function DrawRectangleLines(
        float $x,
        float $y,
        float $width,
        float $height,
        Types\Color $color
    ): void {
        $this->ffi->DrawRectangleLines(
            $x,
            $y,
            $width,
            $height,
            $color->toCData($this->ffi),
        );
    }

    /**
     * @psalm-suppress UndefinedMethod
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function DrawRectangleRec(
        Types\Rectangle $rec,
        Types\Color $color
    ): void {
        $this->ffi->DrawRectangleRec(
            $rec->toCData($this->ffi),
            $color->toCData($this->ffi),
        );
    }

    /**
     * @psalm-suppress UndefinedMethod
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function DrawText(
        string $text,
        int $x,
        int $y,
        int $fontSize,
        Types\Color $color
    ): void {
        $this->ffi->DrawText($text, $x, $y, $fontSize, $color->toCData($this->ffi));
    }

    /**
     * @psalm-suppress MixedPropertyFetch
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedMethod
     */
    // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
    public function Fade(Types\Color $color, float $alpha): Types\Color
    {
        $colorStruct = $this->ffi->Fade($color->toCData($this->ffi), $alpha);

        return new Types\Color(
            $colorStruct->r,
            $colorStruct->g,
            $colorStruct->b,
            $colorStruct->a,
        );
    }
}
