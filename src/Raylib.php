<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;

final class Raylib implements
    HasRaylibBlendModeConstants,
    HasRaylibFilterModeConstants,
    HasRaylibGestureConstants,
    HasRaylibKeysConstants,
    HasRaylibMouseConstants,
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

    public function checkCollisionPointRec(Types\Vector2 $point, Types\Rectangle $rec): bool
    {
        return $this->ffi->CheckCollisionPointRec($point->toCData($this->ffi), $rec->toCData($this->ffi));
    }

    public function checkCollisionRayBox(Types\Ray $ray, Types\BoundingBox $box): bool
    {
        return $this->ffi->CheckCollisionRayBox($ray->toCData($this->ffi), $box->toCData($this->ffi));
    }

    public function clearBackground(Types\Color $color): void
    {
        $this->ffi->ClearBackground($color->toCData($this->ffi));
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

    public function drawPlane(Types\Vector3 $center, Types\Vector2 $size, Types\Color $color): void
    {
        $this->ffi->DrawPlane(
            $center->toCData($this->ffi),
            $size->toCData($this->ffi),
            $color->toCData($this->ffi),
        );
    }

    public function drawRay(Types\Ray $ray, Types\Color $color): void
    {
        $this->ffi->DrawRay($ray->toCData($this->ffi), $color->toCData($this->ffi));
    }

    public function drawRectangle(float $x, float $y, float $width, float $height, Types\Color $color): void
    {
        $this->ffi->DrawRectangle($x, $y, $width, $height, $color->toCData($this->ffi));
    }

    public function drawRectangleLines(float $x, float $y, float $width, float $height, Types\Color $color): void
    {
        $this->ffi->DrawRectangleLines($x, $y, $width, $height, $color->toCData($this->ffi));
    }

    public function drawRectangleLinesEx(Types\Rectangle $rectangle, int $lineThick, Types\Color $color): void
    {
        $this->ffi->DrawRectangleLinesEx($rectangle->toCData($this->ffi), $lineThick, $color->toCData($this->ffi));
    }

    public function drawRectangleRec(Types\Rectangle $rec, Types\Color $color): void
    {
        $this->ffi->DrawRectangleRec($rec->toCData($this->ffi), $color->toCData($this->ffi));
    }

    public function drawText(string $text, int $x, int $y, int $fontSize, Types\Color $color): void
    {
        $this->ffi->DrawText($text, $x, $y, $fontSize, $color->toCData($this->ffi));
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
    public function getColor(int $hex): Types\Color
    {
        $color = $this->ffi->GetColor($hex);

        return new Types\Color($color->r, $color->g, $color->b, $color->a);
    }

    public function getFPS(): int
    {
        return $this->ffi->GetFPS();
    }

    public function getFrameTime(): float
    {
        return $this->ffi->GetFrameTime();
    }

    public function getGestureDetected(): int
    {
        return $this->ffi->GetGestureDetected();
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

    public function isMouseButtonDown(int $button): bool
    {
        return $this->ffi->IsMouseButtonDown($button);
    }

    public function isMouseButtonPressed(int $button): bool
    {
        return $this->ffi->IsMouseButtonPressed($button);
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

    public function measureText(string $text, int $fontSize): int
    {
        return $this->ffi->MeasureText($text, $fontSize);
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

    public function saveStorageValue(int $position, int $value): bool
    {
        return $this->ffi->SaveStorageValue($position, $value);
    }

    public function setCameraMode(Types\Camera3D $camera, int $mode): void
    {
        $this->ffi->SetCameraMode($camera->toCData($this->ffi), $mode);
    }

    public function setConfigFlags(int $flags): void
    {
        $this->ffi->SetConfigFlags($flags);
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


    public function unloadImage(Types\Image $image): void
    {
        $this->ffi->UnloadImage($image->toCData($this->ffi));
    }

    public function unloadMusicStream(Types\Music $music): void
    {
        $this->ffi->UnloadMusicStream($music->toCData($this->ffi));
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
        $camera->projection = $cdata->type;
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
