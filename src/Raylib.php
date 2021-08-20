<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;
use FFI\CDATA;
use Psalm\Type;

final class Raylib implements
    HasRaylibBlendModeConstants,
    HasRaylibFilterModeConstants,
    HasRaylibGestureConstants,
    HasRaylibImageProcessConstants,
    HasRaylibKeysConstants,
    HasRaylibMaterialMapTypeConstants,
    HasRaylibMouseConstants,
    HasRaylibPixelFormatConstants,
    HasRaylibTraceLogConstants,
    HasRaylibWindowFlagConstants
{
    private RaylibFFIProxy $ffi;

    public function __construct(RaylibFFIProxy $ffi)
    {
        $this->ffi = $ffi;
    }

    public function beginBlendMode(int $mode): void
    {
        $this->ffi->BeginBlendMode($mode);
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

    public function beginScissorMode(int $x, int $y, int $width, int $height): void
    {
        $this->ffi->BeginScissorMode($x, $y, $width, $height);
    }

    public function beginTextureMode(Types\RenderTexture2D $target): void
    {
        $this->ffi->BeginTextureMode($target->toCData($this->ffi));
    }

    public function checkCollisionBoxes(Types\BoundingBox $box1, Types\BoundingBox $box2): bool
    {
        return $this->ffi->CheckCollisionBoxes(
            $box1->toCData($this->ffi),
            $box2->toCData($this->ffi),
        );
    }

    public function checkCollisionBoxSphere(Types\BoundingBox $box, Types\Vector3 $center, float $radius): bool
    {
        return $this->ffi->CheckCollisionBoxSphere(
            $box->toCData($this->ffi),
            $center->toCData($this->ffi),
            $radius,
        );
    }

    public function checkCollisionPointCircle(Types\Vector2 $point, Types\Vector2 $center, float $radius): bool
    {
        return $this->ffi->CheckCollisionPointCircle(
            $point->toCData($this->ffi),
            $center->toCData($this->ffi),
            $radius,
        );
    }

    public function checkCollisionPointRec(Types\Vector2 $point, Types\Rectangle $rec): bool
    {
        return $this->ffi->CheckCollisionPointRec($point->toCData($this->ffi), $rec->toCData($this->ffi));
    }

    public function checkCollisionRayBox(Types\Ray $ray, Types\BoundingBox $box): bool
    {
        return $this->ffi->CheckCollisionRayBox($ray->toCData($this->ffi), $box->toCData($this->ffi));
    }

    public function checkCollisionRecs(Types\Rectangle $rec1, Types\Rectangle $rec2): bool
    {
        return $this->ffi->CheckCollisionRecs($rec1->toCData($this->ffi), $rec2->toCData($this->ffi));
    }

    public function checkCollisionCircles(
        Types\Vector2 $center1,
        float $radius1,
        Types\Vector2 $center2,
        float $radius2
    ): bool {
        return $this->ffi->CheckCollisionCircles(
            $center1->toCData($this->ffi),
            $radius1,
            $center2->toCData($this->ffi),
            $radius2,
        );
    }

    public function checkCollisionCircleRec(Types\Vector2 $center, float $radius, Types\Rectangle $rec): bool
    {
        return $this->ffi->CheckCollisionCircleRec(
            $center->toCData($this->ffi),
            $radius,
            $rec->toCData($this->ffi),
        );
    }

    public function checkCollisionPointTriangle(
        Types\Vector2 $point,
        Types\Vector2 $p1,
        Types\Vector2 $p2,
        Types\Vector2 $p3,
    ): bool {
        return $this->ffi->CheckCollisionPointTriangle(
            $point->toCData($this->ffi),
            $p1->toCData($this->ffi),
            $p2->toCData($this->ffi),
            $p3->toCData($this->ffi),
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     */
    public function checkCollisionLines(
        Types\Vector2 $startPos1,
        Types\Vector2 $endPos1,
        Types\Vector2 $startPos2,
        Types\Vector2 $endPos2,
        Types\Vector2 $mutCollisionPoint,
    ): bool {
        $vec = $this->ffi->new('Vector2');
        $vecPointer = FFI::addr($vec);

        $collides = $this->ffi->CheckCollisionLines(
            $startPos1->toCData($this->ffi),
            $endPos1->toCData($this->ffi),
            $startPos2->toCData($this->ffi),
            $endPos2->toCData($this->ffi),
            $vecPointer,
        );

        if ($collides) {
            $mutCollisionPoint->x = $vec->x;
            $mutCollisionPoint->y = $vec->y;
        }

        return $collides;
    }

    public function clearBackground(Types\Color $color): void
    {
        $this->ffi->ClearBackground($color->toCData($this->ffi));
    }

    public function clearWindowState(int $flags): void
    {
        $this->ffi->ClearWindowState($flags);
    }

    public function closeAudioDevice(): void
    {
        $this->ffi->CloseAudioDevice();
    }

    public function closeWindow(): void
    {
        $this->ffi->CloseWindow();
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function colorAlpha(Types\Color $color, float $alpha): Types\Color
    {
        $c = $this->ffi->ColorAlpha($color->toCData($this->ffi), $alpha);

        return new Types\Color($c->r, $c->g, $c->b, $c->a);
    }

    public function drawBillboard(
        Types\Camera3D $camera,
        Types\Texture2D $texture,
        Types\Vector3 $center,
        float $size,
        Types\Color $tint
    ): void {
        $this->ffi->DrawBillboard(
            $camera->toCData($this->ffi),
            $texture->toCData($this->ffi),
            $center->toCData($this->ffi),
            $size,
            $tint->toCData($this->ffi),
        );
    }

    public function drawCircle(int $centerX, int $centerY, float $radius, Types\Color $color): void
    {
        $this->ffi->DrawCircle($centerX, $centerY, $radius, $color->toCData($this->ffi));
    }

    public function drawCircleGradient(
        int $centerX,
        int $centerY,
        float $radius,
        Types\Color $color1,
        Types\Color $color2
    ): void {
        $this->ffi->DrawCircleGradient(
            $centerX,
            $centerY,
            $radius,
            $color1->toCData($this->ffi),
            $color2->toCData($this->ffi),
        );
    }

    public function drawCircleLines(int $centerX, int $centerY, float $radius, Types\Color $color): void
    {
        $this->ffi->DrawCircleLines($centerX, $centerY, $radius, $color->toCData($this->ffi));
    }

    public function drawCircleV(Types\Vector2 $center, float $radius, Types\Color $color): void
    {
        $this->ffi->DrawCircleV($center->toCData($this->ffi), $radius, $color->toCData($this->ffi));
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

    public function drawCubeV(Types\Vector3 $position, Types\Vector3 $size, Types\Color $color): void
    {
        $this->ffi->DrawCubeV(
            $position->toCData($this->ffi),
            $size->toCData($this->ffi),
            $color->toCData($this->ffi),
        );
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

    public function drawFPS(int $posX, int $posY): void
    {
        $this->ffi->DrawFPS($posX, $posY);
    }

    public function drawGrid(int $slices, float $spacing): void
    {
        $this->ffi->DrawGrid($slices, $spacing);
    }

    public function drawLine(int $x0, int $y0, int $x1, int $y1, Types\Color $color): void
    {
        $this->ffi->DrawLine($x0, $y0, $x1, $y1, $color->toCData($this->ffi));
    }

    public function drawLineBezier(
        Types\Vector2 $startPos,
        Types\Vector2 $endPos,
        float $thick,
        Types\Color $color
    ): void {
        $this->ffi->DrawLineBezier(
            $startPos->toCData($this->ffi),
            $endPos->toCData($this->ffi),
            $thick,
            $color->toCData($this->ffi),
        );
    }

    public function drawModelEx(
        Types\Model $model,
        Types\Vector3 $position,
        Types\Vector3 $rotationAxis,
        float $rotationAngle,
        Types\Vector3 $scale,
        Types\Color $tint
    ): void {
        $this->ffi->DrawModelEx(
            $model->toCData($this->ffi),
            $position->toCData($this->ffi),
            $rotationAxis->toCData($this->ffi),
            $rotationAngle,
            $scale->toCData($this->ffi),
            $tint->toCData($this->ffi),
        );
    }

    public function drawPixel(int $posX, int $posY, Types\Color $color): void
    {
        $this->ffi->DrawPixel($posX, $posY, $color->toCData($this->ffi));
    }

    public function drawPixelV(Types\Vector2 $position, Types\Color $color): void
    {
        $this->ffi->DrawPixelV($position->toCData($this->ffi), $color->toCData($this->ffi));
    }

    public function drawPlane(Types\Vector3 $center, Types\Vector2 $size, Types\Color $color): void
    {
        $this->ffi->DrawPlane(
            $center->toCData($this->ffi),
            $size->toCData($this->ffi),
            $color->toCData($this->ffi),
        );
    }

    public function drawPoly(
        Types\Vector2 $center,
        int $sides,
        float $radius,
        float $rotation,
        Types\Color $color
    ): void {
        $this->ffi->DrawPoly($center->toCData($this->ffi), $sides, $radius, $rotation, $color->toCData($this->ffi));
    }

    public function drawRay(Types\Ray $ray, Types\Color $color): void
    {
        $this->ffi->DrawRay($ray->toCData($this->ffi), $color->toCData($this->ffi));
    }

    public function drawRectangle(float $x, float $y, float $width, float $height, Types\Color $color): void
    {
        $this->ffi->DrawRectangle($x, $y, $width, $height, $color->toCData($this->ffi));
    }

    public function drawRectangleGradientH(
        float $x,
        float $y,
        float $width,
        float $height,
        Types\Color $color1,
        Types\Color $color2
    ): void {
        $this->ffi->DrawRectangleGradientH(
            $x,
            $y,
            $width,
            $height,
            $color1->toCData($this->ffi),
            $color2->toCData($this->ffi)
        );
    }

    public function drawRectangleLines(float $x, float $y, float $width, float $height, Types\Color $color): void
    {
        $this->ffi->DrawRectangleLines($x, $y, $width, $height, $color->toCData($this->ffi));
    }

    public function drawRectangleLinesEx(Types\Rectangle $rectangle, int $lineThick, Types\Color $color): void
    {
        $this->ffi->DrawRectangleLinesEx($rectangle->toCData($this->ffi), $lineThick, $color->toCData($this->ffi));
    }

    public function drawRectanglePro(
        Types\Rectangle $rectangle,
        Types\Vector2 $origin,
        float $rotation,
        Types\Color $color
    ): void {
        $this->ffi->DrawRectanglePro(
            $rectangle->toCData($this->ffi),
            $origin->toCData($this->ffi),
            $rotation,
            $color->toCData($this->ffi)
        );
    }

    public function drawRectangleRec(Types\Rectangle $rec, Types\Color $color): void
    {
        $this->ffi->DrawRectangleRec($rec->toCData($this->ffi), $color->toCData($this->ffi));
    }

    public function drawSphere(Types\Vector3 $centerPos, float $radius, Types\Color $color): void
    {
        $this->ffi->DrawSphere(
            $centerPos->toCData($this->ffi),
            $radius,
            $color->toCData($this->ffi),
        );
    }

    public function drawSphereWires(
        Types\Vector3 $centerPos,
        float $radius,
        int $rings,
        int $slices,
        Types\Color $color
    ): void {
        $this->ffi->DrawSphereWires(
            $centerPos->toCData($this->ffi),
            $radius,
            $rings,
            $slices,
            $color->toCData($this->ffi),
        );
    }

    public function drawText(string $text, int $x, int $y, int $fontSize, Types\Color $color): void
    {
        $this->ffi->DrawText($text, $x, $y, $fontSize, $color->toCData($this->ffi));
    }

    public function drawTextEx(
        Types\Font $font,
        string $text,
        Types\Vector2 $position,
        float $fontSize,
        float $spacing,
        Types\Color $tint
    ): void {
        $this->ffi->DrawTextEx(
            $font->toCData($this->ffi),
            $text,
            $position->toCData($this->ffi),
            $fontSize,
            $spacing,
            $tint->toCData($this->ffi)
        );
    }

    public function drawTextRec(
        Types\Font $font,
        string $text,
        Types\Rectangle $rec,
        float $fontSize,
        float $spacing,
        bool $wordWrap,
        Types\Color $tint
    ): void {
        $this->ffi->DrawTextRec(
            $font->toCData($this->ffi),
            $text,
            $rec->toCData($this->ffi),
            $fontSize,
            $spacing,
            $wordWrap,
            $tint->toCData($this->ffi),
        );
    }

    public function drawTextRecEx(
        Types\Font $font,
        string $text,
        Types\Rectangle $rec,
        float $fontSize,
        float $spacing,
        bool $wordWrap,
        Types\Color $tint,
        int $selectStart,
        int $selectLength,
        Types\Color $selectTint,
        Types\Color $selectBackTint
    ): void {
        $this->ffi->DrawTextRecEx(
            $font->toCData($this->ffi),
            $text,
            $rec->toCData($this->ffi),
            $fontSize,
            $spacing,
            $wordWrap,
            $tint->toCData($this->ffi),
            $selectStart,
            $selectLength,
            $selectTint->toCData($this->ffi),
            $selectBackTint->toCData($this->ffi),
        );
    }

    public function drawTextCodepoint(
        Types\Font $font,
        int $codepoint,
        Types\Vector2 $position,
        float $fontSize,
        Types\Color $tint
    ): void {
        $this->ffi->DrawTextCodepoint(
            $font->toCData($this->ffi),
            $codepoint,
            $position->toCData($this->ffi),
            $fontSize,
            $tint->toCData($this->ffi),
        );
    }

    public function drawTexture(Types\Texture2D $texture, int $posX, int $posY, Types\Color $tint): void
    {
        $this->ffi->DrawTexture($texture->toCData($this->ffi), $posX, $posY, $tint->toCData($this->ffi));
    }

    public function drawTextureEx(
        Types\Texture2D $texture,
        Types\Vector2 $position,
        float $rotation,
        float $scale,
        Types\Color $tint
    ): void {
        $this->ffi->DrawTextureEx(
            $texture->toCData($this->ffi),
            $position->toCData($this->ffi),
            $rotation,
            $scale,
            $tint->toCData($this->ffi),
        );
    }

    public function drawTextureRec(
        Types\Texture2D $texture,
        Types\Rectangle $source,
        Types\Vector2 $position,
        Types\Color $tint
    ): void {
        $this->ffi->DrawTextureRec(
            $texture->toCData($this->ffi),
            $source->toCData($this->ffi),
            $position->toCData($this->ffi),
            $tint->toCData($this->ffi)
        );
    }

    public function drawTexturePro(
        Types\Texture2D $texture,
        Types\Rectangle $source,
        Types\Rectangle $dest,
        Types\Vector2 $origin,
        float $rotation,
        Types\Color $tint
    ): void {
        $this->ffi->DrawTexturePro(
            $texture->toCData($this->ffi),
            $source->toCData($this->ffi),
            $dest->toCData($this->ffi),
            $origin->toCData($this->ffi),
            $rotation,
            $tint->toCData($this->ffi)
        );
    }

    public function drawTextureTiled(
        Types\Texture2D $texture,
        Types\Rectangle $source,
        Types\Rectangle $dest,
        Types\Vector2 $origin,
        float $rotation,
        float $scale,
        Types\Color $tint
    ): void {
        $this->ffi->DrawTextureTiled(
            $texture->toCData($this->ffi),
            $source->toCData($this->ffi),
            $dest->toCData($this->ffi),
            $origin->toCData($this->ffi),
            $rotation,
            $scale,
            $tint->toCData($this->ffi),
        );
    }

    public function drawTextureV(
        Types\Texture2D $texture,
        Types\Vector2 $position,
        Types\Color $tint
    ): void {
        $this->ffi->DrawTextureV(
            $texture->toCData($this->ffi),
            $position->toCData($this->ffi),
            $tint->toCData($this->ffi)
        );
    }

    public function drawTriangle(Types\Vector2 $v1, Types\Vector2 $v2, Types\Vector2 $v3, Types\Color $color): void
    {
        $this->ffi->DrawTriangle(
            $v1->toCData($this->ffi),
            $v2->toCData($this->ffi),
            $v3->toCData($this->ffi),
            $color->toCData($this->ffi),
        );
    }

    public function drawTriangleLines(Types\Vector2 $v1, Types\Vector2 $v2, Types\Vector2 $v3, Types\Color $color): void
    {
        $this->ffi->DrawTriangleLines(
            $v1->toCData($this->ffi),
            $v2->toCData($this->ffi),
            $v3->toCData($this->ffi),
            $color->toCData($this->ffi),
        );
    }

    public function endBlendMode(): void
    {
        $this->ffi->EndBlendMode();
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

    public function endScissorMode(): void
    {
        $this->ffi->EndScissorMode();
    }

    public function endTextureMode(): void
    {
        $this->ffi->EndTextureMode();
    }

    public function exportImage(Types\Image $image, string $fileName): bool
    {
        return $this->ffi->ExportImage($image->toCData($this->ffi), $fileName);
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

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function genImageCellular(int $width, int $height, int $tileSize): Types\Image
    {
        $image = $this->ffi->GenImageCellular($width, $height, $tileSize);

        return new Types\Image(
            $image->data,
            $image->width,
            $image->height,
            $image->mipmaps,
            $image->format
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function genImageChecked(
        int $width,
        int $height,
        int $checksX,
        int $checksY,
        Types\Color $col1,
        Types\Color $col2
    ): Types\Image {
        $image = $this->ffi->GenImageChecked(
            $width,
            $height,
            $checksX,
            $checksY,
            $col1->toCData($this->ffi),
            $col2->toCData($this->ffi)
        );

        return new Types\Image(
            $image->data,
            $image->width,
            $image->height,
            $image->mipmaps,
            $image->format
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function genImageGradientH(
        int $width,
        int $height,
        Types\Color $left,
        Types\Color $right
    ): Types\Image {
        $image = $this->ffi->GenImageGradientH(
            $width,
            $height,
            $left->toCData($this->ffi),
            $right->toCData($this->ffi)
        );

        return new Types\Image(
            $image->data,
            $image->width,
            $image->height,
            $image->mipmaps,
            $image->format
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function genImageGradientRadial(
        int $width,
        int $height,
        float $density,
        Types\Color $inner,
        Types\Color $outer
    ): Types\Image {
        $image = $this->ffi->GenImageGradientRadial(
            $width,
            $height,
            $density,
            $inner->toCData($this->ffi),
            $outer->toCData($this->ffi)
        );

        return new Types\Image(
            $image->data,
            $image->width,
            $image->height,
            $image->mipmaps,
            $image->format
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function genImageGradientV(
        int $width,
        int $height,
        Types\Color $top,
        Types\Color $bottom
    ): Types\Image {
        $image = $this->ffi->GenImageGradientV(
            $width,
            $height,
            $top->toCData($this->ffi),
            $bottom->toCData($this->ffi)
        );

        return new Types\Image(
            $image->data,
            $image->width,
            $image->height,
            $image->mipmaps,
            $image->format
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function genImagePerlinNoise(
        int $width,
        int $height,
        int $offsetX,
        int $offsetY,
        float $scale
    ): Types\Image {
        $image = $this->ffi->GenImagePerlinNoise(
            $width,
            $height,
            $offsetX,
            $offsetY,
            $scale
        );

        return new Types\Image(
            $image->data,
            $image->width,
            $image->height,
            $image->mipmaps,
            $image->format
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function genImageWhiteNoise(int $width, int $height, float $factor): Types\Image
    {
        $image = $this->ffi->GenImageWhiteNoise(
            $width,
            $height,
            $factor
        );

        return new Types\Image(
            $image->data,
            $image->width,
            $image->height,
            $image->mipmaps,
            $image->format
        );
    }

    public function getClipboardText(): string
    {
        return $this->ffi->GetClipboardText();
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function getColor(int $hex): Types\Color
    {
        $color = $this->ffi->GetColor($hex);

        return new Types\Color($color->r, $color->g, $color->b, $color->a);
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function getCollisionRec(Types\Rectangle $rec1, Types\Rectangle $rec2): Types\Rectangle
    {
        $rec = $this->ffi->GetCollisionRec($rec1->toCData($this->ffi), $rec2->toCData($this->ffi));

        return new Types\Rectangle($rec->x, $rec->y, $rec->width, $rec->height);
    }

    public function getCameraMatrix(Types\Camera3D $camera): Types\Matrix
    {
        $matrixCData = $this->ffi->GetCameraMatrix($camera->toCData($this->ffi));
        $matrix = new Types\Matrix(...array_fill(0, 16, 0.0));

        for ($i = 0; $i < 15; ++$i) {
            $matrix->{"m{$i}"} = $matrixCData->{"m{$i}"};
        }

        return $matrix;
    }

    public function getCameraMatrix2D(Types\Camera2D $camera): Types\Matrix
    {
        $matrixCData = $this->ffi->GetCameraMatrix2D($camera->toCData($this->ffi));
        $matrix = new Types\Matrix(...array_fill(0, 16, 0.0));

        for ($i = 0; $i < 15; ++$i) {
            $matrix->{"m{$i}"} = $matrixCData->{"m{$i}"};
        }

        return $matrix;
    }

    public function getFPS(): int
    {
        return $this->ffi->GetFPS();
    }

    public function getFrameTime(): float
    {
        return $this->ffi->GetFrameTime();
    }

    /**
     * @deprecated Please, use method loadImageColors()
     */
    public function getImageData(Types\Image $image): CData
    {
        return $this->loadImageColors($image);
    }

    public function getGestureDetected(): int
    {
        return $this->ffi->GetGestureDetected();
    }

    public function getKeyPressed(): int
    {
        return $this->ffi->GetKeyPressed();
    }

    public function getCharPressed(): int
    {
        return $this->ffi->GetCharPressed();
    }

    /**
     * @psalm-suppress MixedArgument
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function getMousePosition(): Types\Vector2
    {
        $vec2Struct = $this->ffi->GetMousePosition();

        return new Types\Vector2($vec2Struct->x, $vec2Struct->y);
    }

    /**
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedPropertyFetch
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function getMouseRay(Types\Vector2 $mousePosition, Types\Camera3D $camera): Types\Ray
    {
        $rayStruct = $this->ffi->GetMouseRay($mousePosition->toCData($this->ffi), $camera->toCData($this->ffi));

        return new Types\Ray(
            new Types\Vector3($rayStruct->position->x, $rayStruct->position->y, $rayStruct->position->z),
            new Types\Vector3($rayStruct->direction->x, $rayStruct->direction->y, $rayStruct->direction->z),
        );
    }

    public function getMouseWheelMove(): float
    {
        return $this->ffi->GetMouseWheelMove();
    }

    public function getMouseX(): int
    {
        return $this->ffi->GetMouseX();
    }

    public function getMouseY(): int
    {
        return $this->ffi->GetMouseY();
    }

    public function getMusicTimeLength(Types\Music $music): float
    {
        return $this->ffi->GetMusicTimeLength($music->toCData($this->ffi));
    }

    public function getMusicTimePlayed(Types\Music $music): float
    {
        return $this->ffi->GetMusicTimePlayed($music->toCData($this->ffi));
    }

    public function getRandomValue(int $min, int $max): int
    {
        return $this->ffi->GetRandomValue($min, $max);
    }

    public function getMonitorCount(): int
    {
        return $this->ffi->GetMonitorCount();
    }

    public function getMonitorName(int $monitor): string
    {
        return $this->ffi->GetMonitorName($monitor);
    }

    /**
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedPropertyFetch
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function getMonitorPosition(int $monitor): Types\Vector2
    {
        $vec = $this->ffi->GetMonitorPosition($monitor);

        return new Types\Vector2($vec->x, $vec->y);
    }

    public function getMonitorWidth(int $monitor): int
    {
        return $this->ffi->GetMonitorWidth($monitor);
    }

    public function getMonitorHeight(int $monitor): int
    {
        return $this->ffi->GetMonitorHeight($monitor);
    }

    public function getMonitorPhysicalWidth(int $monitor): int
    {
        return $this->ffi->GetMonitorPhysicalWidth($monitor);
    }

    public function getMonitorPhysicalHeight(int $monitor): int
    {
        return $this->ffi->GetMonitorPhysicalHeight($monitor);
    }

    public function getMonitorRefreshRate(int $monitor): int
    {
        return $this->ffi->GetMonitorRefreshRate($monitor);
    }

    /**
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedPropertyFetch
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function getWindowPosition(): Types\Vector2
    {
        $vec = $this->ffi->GetWindowPosition();

        return new Types\Vector2($vec->x, $vec->y);
    }

    /**
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedPropertyFetch
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function getWindowScaleDPI(): Types\Vector2
    {
        $vec = $this->ffi->GetWindowScaleDPI();

        return new Types\Vector2($vec->x, $vec->y);
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

    public function getScreenWidth(): int
    {
        return $this->ffi->GetScreenWidth();
    }

    public function getScreenHeight(): int
    {
        return $this->ffi->GetScreenHeight();
    }

    public function getSoundsPlaying(): int
    {
        return $this->ffi->GetSoundsPlaying();
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function getTextureData(Types\Texture2D $texture): Types\Image
    {
        $texture = $this->ffi->GetTextureData($texture->toCData($this->ffi));

        return new Types\Image(
            $texture->data,
            $texture->width,
            $texture->height,
            $texture->mipmaps,
            $texture->format,
        );
    }

    public function getTime(): float
    {
        return $this->ffi->GetTime();
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function getTouchPosition(int $index): Types\Vector2
    {
        $vec = $this->ffi->GetTouchPosition($index);

        return new Types\Vector2($vec->x, $vec->y);
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function getWorldToScreen(Types\Vector3 $position, Types\Camera3D $camera): Types\Vector2
    {
        $vec = $this->ffi->GetWorldToScreen($position->toCData($this->ffi), $camera->toCData($this->ffi));

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

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageColorBrightness(Types\Image $image, int $brightness): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageColorBrightness(FFI::addr($imageStruct), $brightness);

        $image->updateImageObject($image, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageColorContrast(Types\Image $image, float $contrast): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageColorContrast(FFI::addr($imageStruct), $contrast);

        $image->updateImageObject($image, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageColorGrayscale(Types\Image $image): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageColorGrayscale(FFI::addr($imageStruct));

        $image->updateImageObject($image, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageColorInvert(Types\Image $image): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageColorInvert(FFI::addr($imageStruct));

        $image->updateImageObject($image, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageColorTint(Types\Image $image, Types\Color $color): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageColorTint(FFI::addr($imageStruct), $color->toCData($this->ffi));

        $image->updateImageObject($image, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageCrop(Types\Image $image, Types\Rectangle $crop): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageCrop(FFI::addr($imageStruct), $crop->toCData($this->ffi));

        $image->updateImageObject($image, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageDraw(
        Types\Image $dst,
        Types\Image $src,
        Types\Rectangle $srcRec,
        Types\Rectangle $dstRec,
        Types\Color $tint
    ): void {
        $imageStruct = $dst->toCData($this->ffi);
        $this->ffi->ImageDraw(
            FFI::addr($imageStruct),
            $src->toCData($this->ffi),
            $srcRec->toCData($this->ffi),
            $dstRec->toCData($this->ffi),
            $tint->toCData($this->ffi)
        );

        $dst->updateImageObject($dst, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageDrawCircle(
        Types\Image $dst,
        int $centerX,
        int $centerY,
        int $radius,
        Types\Color $color
    ): void {
        $imageStruct = $dst->toCData($this->ffi);
        $this->ffi->ImageDrawCircle(
            FFI::addr($imageStruct),
            $centerX,
            $centerY,
            $radius,
            $color->toCData($this->ffi)
        );

        $dst->updateImageObject($dst, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageDrawPixel(
        Types\Image $dst,
        int $posX,
        int $posY,
        Types\Color $tint
    ): void {
        $imageStruct = $dst->toCData($this->ffi);
        $this->ffi->ImageDrawPixel(
            FFI::addr($imageStruct),
            $posX,
            $posY,
            $tint->toCData($this->ffi)
        );

        $dst->updateImageObject($dst, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageDrawRectangle(
        Types\Image $dst,
        int $posX,
        int $posY,
        int $width,
        int $height,
        Types\Color $color
    ): void {
        $imageStruct = $dst->toCData($this->ffi);
        $this->ffi->ImageDrawRectangle(
            FFI::addr($imageStruct),
            $posX,
            $posY,
            $width,
            $height,
            $color->toCData($this->ffi)
        );

        $dst->updateImageObject($dst, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageDrawTextEx(
        Types\Image $dst,
        Types\Font $font,
        string $text,
        Types\Vector2 $position,
        float $fontSize,
        float $spacing,
        Types\Color $tint
    ): void {
        $imageStruct = $dst->toCData($this->ffi);
        $this->ffi->ImageDrawTextEx(
            FFI::addr($imageStruct),
            $font->toCData($this->ffi),
            $text,
            $position->toCData($this->ffi),
            $fontSize,
            $spacing,
            $tint->toCData($this->ffi)
        );
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageFlipHorizontal(Types\Image $image): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageFlipHorizontal(FFI::addr($imageStruct));

        $image->updateImageObject($image, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageFlipVertical(Types\Image $image): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageFlipVertical(FFI::addr($imageStruct));

        $image->updateImageObject($image, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageFormat(Types\Image $image, int $newFormat): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageFormat(FFI::addr($imageStruct), $newFormat);

        $image->updateImageObject($image, $imageStruct);
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function imageResize(Types\Image $image, int $newWidth, int $newHeight): void
    {
        $imageStruct = $image->toCData($this->ffi);
        $this->ffi->ImageResize(FFI::addr($imageStruct), $newWidth, $newHeight);

        $image->updateImageObject($image, $imageStruct);
    }

    public function initAudioDevice(): void
    {
        $this->ffi->InitAudioDevice();
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

    public function isKeyReleased(int $key): bool
    {
        return $this->ffi->IsKeyReleased($key);
    }

    public function isKeyUp(int $key): bool
    {
        return $this->ffi->IsKeyUp($key);
    }

    public function isMouseButtonDown(int $button): bool
    {
        return $this->ffi->IsMouseButtonDown($button);
    }

    public function isMouseButtonPressed(int $button): bool
    {
        return $this->ffi->IsMouseButtonPressed($button);
    }

    public function isMouseButtonUp(int $button): bool
    {
        return $this->ffi->IsMouseButtonUp($button);
    }

    public function isMouseButtonReleased(int $button): bool
    {
        return $this->ffi->IsMouseButtonReleased($button);
    }

    public function isWindowFocused(): bool
    {
        return $this->ffi->IsWindowFocused();
    }

    public function isWindowFullscreen(): bool
    {
        return $this->ffi->IsWindowFullscreen();
    }

    public function isWindowHidden(): bool
    {
        return $this->ffi->IsWindowHidden();
    }

    public function isWindowMaximized(): bool
    {
        return $this->ffi->IsWindowMaximized();
    }

    public function isWindowMinimized(): bool
    {
        return $this->ffi->IsWindowMinimized();
    }

    public function isWindowReady(): bool
    {
        return $this->ffi->IsWindowReady();
    }

    public function isWindowResized(): bool
    {
        return $this->ffi->IsWindowResized();
    }

    public function isWindowState(int $flag): bool
    {
        return $this->ffi->IsWindowState($flag);
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedPropertyFetch
     */
    public function loadFont(string $filename): Types\Font
    {
        $font = $this->ffi->LoadFont($filename);
        $texture = new Types\Texture2D(
            $font->texture->id,
            $font->texture->width,
            $font->texture->height,
            $font->texture->mipmaps,
            $font->texture->format
        );

        return new Types\Font(
            $font->baseSize,
            $font->charsCount,
            $font->charsPadding,
            $texture,
            $font->recs,
            $font->chars
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress InvalidArgument
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArrayAssignment
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedPropertyFetch
     */
    public function loadFontEx(string $fileName, int $fontSize, int $fontChars, int $charsCount): Types\Font
    {
        $fontCharsPointer = $this->ffi->new('int*');

        $font = $this->ffi->LoadFontEx($fileName, $fontSize, $fontCharsPointer, $charsCount);

        $texture = new Types\Texture2D(
            $font->texture->id,
            $font->texture->width,
            $font->texture->height,
            $font->texture->mipmaps,
            $font->texture->format,
        );

        return new Types\Font(
            $font->baseSize,
            $font->charsCount,
            $font->charsPadding,
            $texture,
            $font->recs,
            $font->chars
        );
    }

    public function loadImageColors(Types\Image $image): CData
    {
        return $this->ffi->LoadImageColors($image->toCData($this->ffi));
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function loadImage(string $filename): Types\Image
    {
        $image = $this->ffi->LoadImage($filename);

        return new Types\Image($image->data, $image->width, $image->height, $image->mipmaps, $image->format);
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedPropertyFetch
     */
    public function loadModel(string $filename): Types\Model
    {
        $model = $this->ffi->LoadModel($filename);

        return new Types\Model(
            $model->transform,
            $model->meshCount,
            $model->materialCount,
            $model->meshes,
            $model->materials,
            $model->meshMaterial,
            $model->boneCount,
            $model->bones,
            $model->bindPose,
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedPropertyFetch
     */
    public function loadModelAnimations(string $filename, int &$animationsCount): CData
    {
        $count = $this->ffi->new('int');
        $animations = $this->ffi->LoadModelAnimations($filename, FFI::addr($count));
        $animationsCount = (int) $count->cdata;

        return $animations;
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedPropertyFetch
     */
    public function loadMusicStream(string $filename): Types\Music
    {
        $music = $this->ffi->LoadMusicStream($filename);

        return new Types\Music(
            new Types\AudioStream(
                $music->stream->buffer,
                $music->stream->sampleRate,
                $music->stream->sampleSize,
                $music->stream->channels,
            ),
            $music->sampleCount,
            $music->looping,
            $music->ctxType,
            $music->ctxData
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedPropertyFetch
     */
    public function loadSound(string $filename): Types\Sound
    {
        $audio = $this->ffi->LoadSound($filename);

        return new Types\Sound(
            new Types\AudioStream(
                $audio->stream->buffer,
                $audio->stream->sampleRate,
                $audio->stream->sampleSize,
                $audio->stream->channels,
            ),
            $audio->sampleCount,
        );
    }

    public function loadStorageValue(int $position): int
    {
        return $this->ffi->LoadStorageValue($position);
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function loadTexture(string $path): Types\Texture2D
    {
        $texture = $this->ffi->LoadTexture($path);

        return new Types\Texture2D(
            $texture->id,
            $texture->width,
            $texture->height,
            $texture->mipmaps,
            $texture->format,
        );
    }

    /**
     * @psalm-suppress UndefinedPropertyFetch
     * @psalm-suppress MixedArgument
     */
    public function loadTextureFromImage(Types\Image $image): Types\Texture2D
    {
        $texture = $this->ffi->LoadTextureFromImage($image->toCData($this->ffi));

        return new Types\Texture2D(
            $texture->id,
            $texture->width,
            $texture->height,
            $texture->mipmaps,
            $texture->format,
        );
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedPropertyFetch
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function loadRenderTexture(int $width, int $height): Types\RenderTexture2D
    {
        $renderTexture = $this->ffi->LoadRenderTexture($width, $height);
        $texture = new Types\Texture2D(
            $renderTexture->texture->id,
            $renderTexture->texture->width,
            $renderTexture->texture->height,
            $renderTexture->texture->mipmaps,
            $renderTexture->texture->format,
        );

        $depth = new Types\Texture2D(
            $renderTexture->depth->id,
            $renderTexture->depth->width,
            $renderTexture->depth->height,
            $renderTexture->depth->mipmaps,
            $renderTexture->depth->format,
        );

        return new Types\RenderTexture2D(
            $renderTexture->id,
            $texture,
            $depth
        );
    }

    public function maximizeWindow(): void
    {
        $this->ffi->MaximizeWindow();
    }

    public function measureText(string $text, int $fontSize): int
    {
        return $this->ffi->MeasureText($text, $fontSize);
    }

    public function minimizeWindow(): void
    {
        $this->ffi->MinimizeWindow();
    }

    public function pauseMusicStream(Types\Music $music): void
    {
        $this->ffi->PauseMusicStream($music->toCData($this->ffi));
    }

    public function playMusicStream(Types\Music $music): void
    {
        $this->ffi->PlayMusicStream($music->toCData($this->ffi));
    }

    public function playSound(Types\Sound $sound): void
    {
        $this->ffi->PlaySound($sound->toCData($this->ffi));
    }

    public function playSoundMulti(Types\Sound $sound): void
    {
        $this->ffi->PlaySoundMulti($sound->toCData($this->ffi));
    }

    public function resumeMusicStream(Types\Music $music): void
    {
        $this->ffi->ResumeMusicStream($music->toCData($this->ffi));
    }

    public function restoreWindow(): void
    {
        $this->ffi->RestoreWindow();
    }

    public function saveStorageValue(int $position, int $value): bool
    {
        return $this->ffi->SaveStorageValue($position, $value);
    }

    public function setCameraMode(Types\Camera3D $camera, int $mode): void
    {
        $this->ffi->SetCameraMode($camera->toCData($this->ffi), $mode);
    }

    public function setClipboardText(string $text): void
    {
        $this->ffi->SetClipboardText($text);
    }

    public function setConfigFlags(int $flags): void
    {
        $this->ffi->SetConfigFlags($flags);
    }

    public function setExitKey(int $key): void
    {
        $this->ffi->SetExitKey($key);
    }

    /**
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedArgument
     */
    public function setMaterialTexture(CData $material, int $mapType, Types\Texture2D $texture): void
    {
        $materialAddr = FFI::addr($material);
        $this->ffi->SetMaterialTexture($materialAddr, $mapType, $texture->toCData($this->ffi));
    }

    public function setMusicPitch(Types\Music $music, float $pitch): void
    {
        $this->ffi->SetMusicPitch($music->toCData($this->ffi), $pitch);
    }

    public function setSoundVolume(Types\Sound $sound, float $volume): void
    {
        $this->ffi->SetSoundVolume($sound->toCData($this->ffi), $volume);
    }

    public function setTargetFPS(int $fps): void
    {
        $this->ffi->SetTargetFPS($fps);
    }

    public function setTextureFilter(Types\Texture2D $texture, int $filterMode): void
    {
        $this->ffi->SetTextureFilter($texture->toCData($this->ffi), $filterMode);
    }

    public function setWindowIcon(Types\Image $image): void
    {
        $this->ffi->SetWindowIcon($image->toCData($this->ffi));
    }

    public function setWindowMinSize(int $width, int $height): void
    {
        $this->ffi->SetWindowMinSize($width, $height);
    }

    public function setWindowMonitor(int $monitor): void
    {
        $this->ffi->SetWindowMonitor($monitor);
    }

    public function setWindowPosition(int $x, int $y): void
    {
        $this->ffi->SetWindowPosition($x, $y);
    }

    public function setWindowSize(int $width, int $height): void
    {
        $this->ffi->SetWindowSize($width, $height);
    }

    public function setWindowState(int $flags): void
    {
        $this->ffi->SetWindowState($flags);
    }

    public function setWindowTitle(string $title): void
    {
        $this->ffi->SetWindowTitle($title);
    }

    public function showCursor(): void
    {
        $this->ffi->ShowCursor();
    }

    public function hideCursor(): void
    {
        $this->ffi->HideCursor();
    }

    public function isCursorHidden(): bool
    {
        return $this->ffi->IsCursorHidden();
    }

    public function enableCursor(): void
    {
        $this->ffi->EnableCursor();
    }

    public function disableCursor(): void
    {
        $this->ffi->DisableCursor();
    }

    public function isCursorOnScreen(): bool
    {
        return $this->ffi->IsCursorOnScreen();
    }

    public function stopMusicStream(Types\Music $music): void
    {
        $this->ffi->StopMusicStream($music->toCData($this->ffi));
    }

    public function stopSoundMulti(): void
    {
        $this->ffi->StopSoundMulti();
    }

    /**
     * @psalm-suppress MissingParamType
     * @psalm-suppress MixedArgument
     */
    public function textFormat(string $format, ...$args): string
    {
        return sprintf($format, ...$args);
    }

    /**
     * @psalm-suppress MissingParamType
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedPropertyFetch
     */
    public function updateTexture(Types\Texture2D $texture, CDATA $pixels): void
    {
        $this->ffi->UpdateTexture($texture->toCData($this->ffi), $pixels);
    }

    public function textSubtext(string $text, int $position, int $length): string
    {
        return $this->ffi->TextSubtext($text, $position, $length);
    }

    public function unloadFont(Types\Font $font): void
    {
        $this->ffi->UnloadFont($font->toCData($this->ffi));
    }

    public function toggleFullscreen(): void
    {
        $this->ffi->ToggleFullscreen();
    }

    /**
     * @param mixed[] $args
     */
    public function traceLog(int $type, string $format, ...$args): void
    {
        $this->ffi->TraceLog($type, $format, ...$args);
    }

    public function unloadImage(Types\Image $image): void
    {
        $this->ffi->UnloadImage($image->toCData($this->ffi));
    }

    public function unloadModel(Types\Model $model): void
    {
        $this->ffi->UnloadModel($model->toCData($this->ffi));
    }

    public function unloadModelAnimation(CData $animation): void
    {
        $this->ffi->UnloadModelAnimation($animation);
    }

    public function unloadMusicStream(Types\Music $music): void
    {
        $this->ffi->UnloadMusicStream($music->toCData($this->ffi));
    }

    public function unloadRenderTexture(Types\RenderTexture2D $target): void
    {
        $this->ffi->UnloadRenderTexture($target->toCData($this->ffi));
    }

    public function unloadSound(Types\Sound $sound): void
    {
        $this->ffi->UnloadSound($sound->toCData($this->ffi));
    }

    public function unloadTexture(Types\Texture2D $texture): void
    {
        $this->ffi->UnloadTexture($texture->toCData($this->ffi));
    }

    /**
     * @psalm-suppress InvalidPassByReference
     * @psalm-suppress MixedArgument
     * @psalm-suppress MixedAssignment
     * @psalm-suppress MixedPropertyFetch
     */
    public function updateCamera(Types\Camera3D $camera): void
    {
        // Raylib's UpdateCamera() expects a struct *Camera3D
        // So we pass by ref here. Given it will write to the
        // camera object, we need to update on PHP side as well.
        $cdata = FFI::addr($camera->toCData($this->ffi));
        $this->ffi->UpdateCamera($cdata);

        $camera->position->x = $cdata->position->x;
        $camera->position->y = $cdata->position->y;
        $camera->position->z = $cdata->position->z;

        $camera->target->x = $cdata->target->x;
        $camera->target->y = $cdata->target->y;
        $camera->target->z = $cdata->target->z;

        $camera->up->x = $cdata->up->x;
        $camera->up->y = $cdata->up->y;
        $camera->up->z = $cdata->up->z;

        $camera->fovy = $cdata->fovy;
        $camera->projection = $cdata->projection;
    }

    public function updateModelAnimation(Types\Model $model, CData $animation, int $frame): void
    {
        $this->ffi->UpdateModelAnimation(
            $model->toCData($this->ffi),
            $animation,
            $frame,
        );
    }

    public function updateMusicStream(Types\Music $music): void
    {
        $this->ffi->UpdateMusicStream($music->toCData($this->ffi));
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
