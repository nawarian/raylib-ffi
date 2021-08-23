<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use Nawarian\Raylib\Types\Camera2D;
use Nawarian\Raylib\Types\Camera3D;
use Nawarian\Raylib\Types\RenderTexture2D;
use Nawarian\Raylib\Types\BoundingBox;
use Nawarian\Raylib\Types\Vector3;
use Nawarian\Raylib\Types\Vector2;
use Nawarian\Raylib\Types\Rectangle;
use Nawarian\Raylib\Types\Ray;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Texture2D;
use Nawarian\Raylib\Types\Model;
use Nawarian\Raylib\Types\Font;
use Nawarian\Raylib\Types\Image;
use Nawarian\Raylib\Types\Vector4;
use Nawarian\Raylib\Types\Matrix;
use Nawarian\Raylib\Types\Music;
use FFI\CData;
use Nawarian\Raylib\Types\Sound;

// phpcs:disable
$factory = new RaylibFactory();
/**
* @psalm-suppress InvalidGlobal 
*/
global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
$raylib_4878fcd84df4c3690086cd1cbfbbfea2 = $factory->newInstance();
unset($factory);

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function BeginBlendMode(int $mode): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->beginBlendMode($mode);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function BeginDrawing(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->beginDrawing();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function BeginMode2D(Camera2D $camera): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->beginMode2D($camera);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function BeginMode3D(Camera3D $camera): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->beginMode3D($camera);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function BeginScissorMode(int $x, int $y, int $width, int $height): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->beginScissorMode($x, $y, $width, $height);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function BeginTextureMode(RenderTexture2D $target): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->beginTextureMode($target);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionBoxes(BoundingBox $box1, BoundingBox $box2): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionBoxes($box1, $box2);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionBoxSphere(BoundingBox $box, Vector3 $center, float $radius): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionBoxSphere($box, $center, $radius);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionPointCircle(Vector2 $point, Vector2 $center, float $radius): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionPointCircle($point, $center, $radius);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionPointRec(Vector2 $point, Rectangle $rec): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionPointRec($point, $rec);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionRayBox(Ray $ray, BoundingBox $box): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionRayBox($ray, $box);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionRecs(Rectangle $rec1, Rectangle $rec2): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionRecs($rec1, $rec2);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionCircles(Vector2 $center1, float $radius1, Vector2 $center2, float $radius2): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionCircles($center1, $radius1, $center2, $radius2);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionCircleRec(Vector2 $center, float $radius, Rectangle $rec): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionCircleRec($center, $radius, $rec);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionPointTriangle(Vector2 $point, Vector2 $p1, Vector2 $p2, Vector2 $p3): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionPointTriangle($point, $p1, $p2, $p3);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CheckCollisionLines(Vector2 $startPos1, Vector2 $endPos1, Vector2 $startPos2, Vector2 $endPos2, Vector2 $mutCollisionPoint): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->checkCollisionLines($startPos1, $endPos1, $startPos2, $endPos2, $mutCollisionPoint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ClearBackground(Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->clearBackground($color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ClearWindowState(int $flags): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->clearWindowState($flags);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CloseAudioDevice(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->closeAudioDevice();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function CloseWindow(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->closeWindow();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ColorAlpha(Color $color, float $alpha): Color
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->colorAlpha($color, $alpha);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ColorAlphaBlend(Color $dst, Color $src, Color $tint): Color
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->colorAlphaBlend($dst, $src, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawBillboard(Camera3D $camera, Texture2D $texture, Vector3 $center, float $size, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawBillboard($camera, $texture, $center, $size, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawCircle(int $centerX, int $centerY, float $radius, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawCircle($centerX, $centerY, $radius, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawCircleGradient(int $centerX, int $centerY, float $radius, Color $color1, Color $color2): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawCircleGradient($centerX, $centerY, $radius, $color1, $color2);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawCircleLines(int $centerX, int $centerY, float $radius, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawCircleLines($centerX, $centerY, $radius, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawCircleSector(Vector2 $center, float $radius, int $startAngle, int $endAngle, int $segments, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawCircleSector($center, $radius, $startAngle, $endAngle, $segments, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawCircleSectorLines(Vector2 $center, float $radius, int $startAngle, int $endAngle, int $segments, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawCircleSectorLines($center, $radius, $startAngle, $endAngle, $segments, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawCircleV(Vector2 $center, float $radius, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawCircleV($center, $radius, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawCube(Vector3 $position, float $width, float $height, float $length, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawCube($position, $width, $height, $length, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawCubeV(Vector3 $position, Vector3 $size, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawCubeV($position, $size, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawCubeWires(Vector3 $position, float $width, float $height, float $length, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawCubeWires($position, $width, $height, $length, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawEllipse(int $centerX, int $centerY, float $radiusH, float $radiusV, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawEllipse($centerX, $centerY, $radiusH, $radiusV, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawEllipseLines(int $centerX, int $centerY, float $radiusH, float $radiusV, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawEllipseLines($centerX, $centerY, $radiusH, $radiusV, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawFPS(int $posX, int $posY): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawFPS($posX, $posY);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawGrid(int $slices, float $spacing): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawGrid($slices, $spacing);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawLine(int $x0, int $y0, int $x1, int $y1, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawLine($x0, $y0, $x1, $y1, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawLineStrip(array $points, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawLineStrip($points, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawLineV(Vector2 $startPos, Vector2 $endPos, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawLineV($startPos, $endPos, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawLineEx(Vector2 $startPos, Vector2 $endPos, float $thick, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawLineEx($startPos, $endPos, $thick, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawLineBezier(Vector2 $startPos, Vector2 $endPos, float $thick, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawLineBezier($startPos, $endPos, $thick, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawModelEx(Model $model, Vector3 $position, Vector3 $rotationAxis, float $rotationAngle, Vector3 $scale, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawModelEx($model, $position, $rotationAxis, $rotationAngle, $scale, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawPixel(int $posX, int $posY, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawPixel($posX, $posY, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawPixelV(Vector2 $position, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawPixelV($position, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawPlane(Vector3 $center, Vector2 $size, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawPlane($center, $size, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawPoly(Vector2 $center, int $sides, float $radius, float $rotation, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawPoly($center, $sides, $radius, $rotation, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawPolyLines(Vector2 $center, int $sides, float $radius, float $rotation, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawPolyLines($center, $sides, $radius, $rotation, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRay(Ray $ray, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRay($ray, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangle(float $x, float $y, float $width, float $height, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangle($x, $y, $width, $height, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangleV(Vector2 $position, Vector2 $size, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangleV($position, $size, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangleGradientV(int $posX, int $posY, int $width, int $height, Color $color1, Color $color2): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangleGradientV($posX, $posY, $width, $height, $color1, $color2);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangleGradientH(float $x, float $y, float $width, float $height, Color $color1, Color $color2): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangleGradientH($x, $y, $width, $height, $color1, $color2);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangleGradientEx(Rectangle $rec, Color $col1, Color $col2, Color $col3, Color $col4): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangleGradientEx($rec, $col1, $col2, $col3, $col4);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangleLines(float $x, float $y, float $width, float $height, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangleLines($x, $y, $width, $height, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangleLinesEx(Rectangle $rectangle, int $lineThick, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangleLinesEx($rectangle, $lineThick, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangleRounded(Rectangle $rec, float $roundness, int $segments, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangleRounded($rec, $roundness, $segments, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangleRoundedLines(Rectangle $rec, float $roundness, int $segments, int $lineThick, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangleRoundedLines($rec, $roundness, $segments, $lineThick, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectanglePro(Rectangle $rectangle, Vector2 $origin, float $rotation, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectanglePro($rectangle, $origin, $rotation, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRectangleRec(Rectangle $rec, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRectangleRec($rec, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRing(Vector2 $center, float $innerRadius, float $outerRadius, int $startAngle, int $endAngle, int $segments, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRing($center, $innerRadius, $outerRadius, $startAngle, $endAngle, $segments, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawRingLines(Vector2 $center, float $innerRadius, float $outerRadius, int $startAngle, int $endAngle, int $segments, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawRingLines($center, $innerRadius, $outerRadius, $startAngle, $endAngle, $segments, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawSphere(Vector3 $centerPos, float $radius, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawSphere($centerPos, $radius, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawSphereWires(Vector3 $centerPos, float $radius, int $rings, int $slices, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawSphereWires($centerPos, $radius, $rings, $slices, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawText(string $text, int $x, int $y, int $fontSize, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawText($text, $x, $y, $fontSize, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTextEx(Font $font, string $text, Vector2 $position, float $fontSize, float $spacing, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTextEx($font, $text, $position, $fontSize, $spacing, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTextRec(Font $font, string $text, Rectangle $rec, float $fontSize, float $spacing, bool $wordWrap, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTextRec($font, $text, $rec, $fontSize, $spacing, $wordWrap, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTextRecEx(Font $font, string $text, Rectangle $rec, float $fontSize, float $spacing, bool $wordWrap, Color $tint, int $selectStart, int $selectLength, Color $selectTint, Color $selectBackTint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTextRecEx($font, $text, $rec, $fontSize, $spacing, $wordWrap, $tint, $selectStart, $selectLength, $selectTint, $selectBackTint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTextCodepoint(Font $font, int $codepoint, Vector2 $position, float $fontSize, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTextCodepoint($font, $codepoint, $position, $fontSize, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTexture(Texture2D $texture, int $posX, int $posY, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTexture($texture, $posX, $posY, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTextureEx(Texture2D $texture, Vector2 $position, float $rotation, float $scale, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTextureEx($texture, $position, $rotation, $scale, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTextureRec(Texture2D $texture, Rectangle $source, Vector2 $position, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTextureRec($texture, $source, $position, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTexturePro(Texture2D $texture, Rectangle $source, Rectangle $dest, Vector2 $origin, float $rotation, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTexturePro($texture, $source, $dest, $origin, $rotation, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTextureTiled(Texture2D $texture, Rectangle $source, Rectangle $dest, Vector2 $origin, float $rotation, float $scale, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTextureTiled($texture, $source, $dest, $origin, $rotation, $scale, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTextureV(Texture2D $texture, Vector2 $position, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTextureV($texture, $position, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTriangle(Vector2 $v1, Vector2 $v2, Vector2 $v3, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTriangle($v1, $v2, $v3, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTriangleLines(Vector2 $v1, Vector2 $v2, Vector2 $v3, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTriangleLines($v1, $v2, $v3, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTriangleFan(array $points, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTriangleFan($points, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DrawTriangleStrip(array $points, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->drawTriangleStrip($points, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function EndBlendMode(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->endBlendMode();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function EndDrawing(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->endDrawing();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function EndMode2D(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->endMode2D();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function EndMode3D(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->endMode3D();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function EndScissorMode(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->endScissorMode();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function EndTextureMode(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->endTextureMode();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ExportImage(Image $image, string $fileName): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->exportImage($image, $fileName);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function Fade(Color $color, float $alpha): Color
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->fade($color, $alpha);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ColorToInt(Color $color): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->colorToInt($color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ColorNormalize(Color $color): Vector4
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->colorNormalize($color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ColorFromNormalized(Vector4 $normalized): Color
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->colorFromNormalized($normalized);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ColorToHSV(Color $color): Vector3
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->colorToHSV($color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ColorFromHSV(float $hue, float $saturation, float $value): Color
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->colorFromHSV($hue, $saturation, $value);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GenImageCellular(int $width, int $height, int $tileSize): Image
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->genImageCellular($width, $height, $tileSize);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GenImageChecked(int $width, int $height, int $checksX, int $checksY, Color $col1, Color $col2): Image
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->genImageChecked($width, $height, $checksX, $checksY, $col1, $col2);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GenImageGradientH(int $width, int $height, Color $left, Color $right): Image
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->genImageGradientH($width, $height, $left, $right);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GenImageGradientRadial(int $width, int $height, float $density, Color $inner, Color $outer): Image
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->genImageGradientRadial($width, $height, $density, $inner, $outer);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GenImageGradientV(int $width, int $height, Color $top, Color $bottom): Image
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->genImageGradientV($width, $height, $top, $bottom);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GenImagePerlinNoise(int $width, int $height, int $offsetX, int $offsetY, float $scale): Image
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->genImagePerlinNoise($width, $height, $offsetX, $offsetY, $scale);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GenImageWhiteNoise(int $width, int $height, float $factor): Image
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->genImageWhiteNoise($width, $height, $factor);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetClipboardText(): string
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getClipboardText();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetColor(int $hex): Color
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getColor($hex);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetCollisionRec(Rectangle $rec1, Rectangle $rec2): Rectangle
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getCollisionRec($rec1, $rec2);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetCameraMatrix(Camera3D $camera): Matrix
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getCameraMatrix($camera);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetCameraMatrix2D(Camera2D $camera): Matrix
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getCameraMatrix2D($camera);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetFPS(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getFPS();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetFrameTime(): float
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getFrameTime();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetGestureDetected(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getGestureDetected();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetKeyPressed(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getKeyPressed();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetCharPressed(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getCharPressed();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMousePosition(): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMousePosition();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMouseRay(Vector2 $mousePosition, Camera3D $camera): Ray
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMouseRay($mousePosition, $camera);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMouseWheelMove(): float
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMouseWheelMove();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMouseX(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMouseX();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMouseY(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMouseY();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMusicTimeLength(Music $music): float
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMusicTimeLength($music);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMusicTimePlayed(Music $music): float
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMusicTimePlayed($music);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetRandomValue(int $min, int $max): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getRandomValue($min, $max);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMonitorCount(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMonitorCount();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMonitorName(int $monitor): string
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMonitorName($monitor);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMonitorPosition(int $monitor): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMonitorPosition($monitor);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMonitorWidth(int $monitor): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMonitorWidth($monitor);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMonitorHeight(int $monitor): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMonitorHeight($monitor);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMonitorPhysicalWidth(int $monitor): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMonitorPhysicalWidth($monitor);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMonitorPhysicalHeight(int $monitor): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMonitorPhysicalHeight($monitor);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetMonitorRefreshRate(int $monitor): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getMonitorRefreshRate($monitor);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetWindowPosition(): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getWindowPosition();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetWindowScaleDPI(): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getWindowScaleDPI();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetScreenToWorld2D(Vector2 $position, Camera2D $camera): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getScreenToWorld2D($position, $camera);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetScreenWidth(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getScreenWidth();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetScreenHeight(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getScreenHeight();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetSoundsPlaying(): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getSoundsPlaying();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetTextureData(Texture2D $texture): Image
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getTextureData($texture);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetTime(): float
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getTime();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetTouchPosition(int $index): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getTouchPosition($index);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetWorldToScreen(Vector3 $position, Camera3D $camera): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getWorldToScreen($position, $camera);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function GetWorldToScreen2D(Vector2 $position, Camera2D $camera): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->getWorldToScreen2D($position, $camera);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageColorBrightness(Image $image, int $brightness): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageColorBrightness($image, $brightness);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageColorContrast(Image $image, float $contrast): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageColorContrast($image, $contrast);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageColorGrayscale(Image $image): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageColorGrayscale($image);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageColorInvert(Image $image): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageColorInvert($image);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageColorTint(Image $image, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageColorTint($image, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageCrop(Image $image, Rectangle $crop): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageCrop($image, $crop);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageDraw(Image $dst, Image $src, Rectangle $srcRec, Rectangle $dstRec, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageDraw($dst, $src, $srcRec, $dstRec, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageDrawCircle(Image $dst, int $centerX, int $centerY, int $radius, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageDrawCircle($dst, $centerX, $centerY, $radius, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageDrawPixel(Image $dst, int $posX, int $posY, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageDrawPixel($dst, $posX, $posY, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageDrawRectangle(Image $dst, int $posX, int $posY, int $width, int $height, Color $color): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageDrawRectangle($dst, $posX, $posY, $width, $height, $color);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageDrawTextEx(Image $dst, Font $font, string $text, Vector2 $position, float $fontSize, float $spacing, Color $tint): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageDrawTextEx($dst, $font, $text, $position, $fontSize, $spacing, $tint);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageFlipHorizontal(Image $image): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageFlipHorizontal($image);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageFlipVertical(Image $image): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageFlipVertical($image);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageFormat(Image $image, int $newFormat): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageFormat($image, $newFormat);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ImageResize(Image $image, int $newWidth, int $newHeight): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->imageResize($image, $newWidth, $newHeight);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function InitAudioDevice(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->initAudioDevice();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function InitWindow(int $width, int $height, string $title): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->initWindow($width, $height, $title);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsKeyDown(int $key): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isKeyDown($key);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsKeyPressed(int $key): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isKeyPressed($key);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsKeyReleased(int $key): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isKeyReleased($key);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsKeyUp(int $key): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isKeyUp($key);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsMouseButtonDown(int $button): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isMouseButtonDown($button);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsMouseButtonPressed(int $button): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isMouseButtonPressed($button);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsMouseButtonUp(int $button): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isMouseButtonUp($button);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsMouseButtonReleased(int $button): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isMouseButtonReleased($button);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsWindowFocused(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isWindowFocused();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsWindowFullscreen(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isWindowFullscreen();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsWindowHidden(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isWindowHidden();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsWindowMaximized(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isWindowMaximized();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsWindowMinimized(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isWindowMinimized();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsWindowReady(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isWindowReady();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsWindowResized(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isWindowResized();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsWindowState(int $flag): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isWindowState($flag);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadFont(string $filename): Font
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadFont($filename);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadFontEx(string $fileName, int $fontSize, int $fontChars, int $charsCount): Font
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadFontEx($fileName, $fontSize, $fontChars, $charsCount);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadImageColors(Image $image): CData
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadImageColors($image);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadImage(string $filename): Image
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadImage($filename);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadModel(string $filename): Model
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadModel($filename);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadModelAnimations(string $filename, int $animationsCount): CData
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadModelAnimations($filename, $animationsCount);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadMusicStream(string $filename): Music
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadMusicStream($filename);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadSound(string $filename): Sound
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadSound($filename);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadStorageValue(int $position): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadStorageValue($position);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadTexture(string $path): Texture2D
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadTexture($path);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadTextureFromImage(Image $image): Texture2D
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadTextureFromImage($image);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function LoadRenderTexture(int $width, int $height): RenderTexture2D
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->loadRenderTexture($width, $height);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function MaximizeWindow(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->maximizeWindow();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function MeasureText(string $text, int $fontSize): int
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->measureText($text, $fontSize);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function MinimizeWindow(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->minimizeWindow();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function PauseMusicStream(Music $music): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->pauseMusicStream($music);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function PlayMusicStream(Music $music): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->playMusicStream($music);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function PlaySound(Sound $sound): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->playSound($sound);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function PlaySoundMulti(Sound $sound): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->playSoundMulti($sound);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ResumeMusicStream(Music $music): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->resumeMusicStream($music);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function RestoreWindow(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->restoreWindow();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SaveStorageValue(int $position, int $value): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->saveStorageValue($position, $value);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetCameraMode(Camera3D $camera, int $mode): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setCameraMode($camera, $mode);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetClipboardText(string $text): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setClipboardText($text);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetConfigFlags(int $flags): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setConfigFlags($flags);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetExitKey(int $key): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setExitKey($key);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetMaterialTexture(CData $material, int $mapType, Texture2D $texture): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setMaterialTexture($material, $mapType, $texture);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetMousePosition(int $x, int $y): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setMousePosition($x, $y);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetMouseOffset(int $offsetX, int $offsetY): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setMouseOffset($offsetX, $offsetY);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetMouseScale(float $scaleX, float $scaleY): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setMouseScale($scaleX, $scaleY);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetMusicPitch(Music $music, float $pitch): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setMusicPitch($music, $pitch);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetSoundVolume(Sound $sound, float $volume): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setSoundVolume($sound, $volume);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetTargetFPS(int $fps): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setTargetFPS($fps);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetTextureFilter(Texture2D $texture, int $filterMode): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setTextureFilter($texture, $filterMode);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetWindowIcon(Image $image): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setWindowIcon($image);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetWindowMinSize(int $width, int $height): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setWindowMinSize($width, $height);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetWindowMonitor(int $monitor): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setWindowMonitor($monitor);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetWindowPosition(int $x, int $y): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setWindowPosition($x, $y);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetWindowSize(int $width, int $height): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setWindowSize($width, $height);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetWindowState(int $flags): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setWindowState($flags);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function SetWindowTitle(string $title): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->setWindowTitle($title);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ShowCursor(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->showCursor();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function HideCursor(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->hideCursor();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsCursorHidden(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isCursorHidden();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function EnableCursor(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->enableCursor();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function DisableCursor(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->disableCursor();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function IsCursorOnScreen(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->isCursorOnScreen();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function StopMusicStream(Music $music): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->stopMusicStream($music);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function StopSoundMulti(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->stopSoundMulti();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function TextFormat(string $format,  ...$args): string
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->textFormat($format, ...$args);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UpdateTexture(Texture2D $texture, CData $pixels): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->updateTexture($texture, $pixels);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function TextSubtext(string $text, int $position, int $length): string
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->textSubtext($text, $position, $length);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UnloadFont(Font $font): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->unloadFont($font);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function ToggleFullscreen(): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->toggleFullscreen();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function TraceLog(int $type, string $format,  ...$args): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->traceLog($type, $format, ...$args);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UnloadImage(Image $image): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->unloadImage($image);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UnloadModel(Model $model): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->unloadModel($model);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UnloadModelAnimation(CData $animation): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->unloadModelAnimation($animation);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UnloadMusicStream(Music $music): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->unloadMusicStream($music);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UnloadRenderTexture(RenderTexture2D $target): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->unloadRenderTexture($target);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UnloadSound(Sound $sound): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->unloadSound($sound);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UnloadTexture(Texture2D $texture): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->unloadTexture($texture);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UpdateCamera(Camera3D $camera): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->updateCamera($camera);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UpdateModelAnimation(Model $model, CData $animation, int $frame): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->updateModelAnimation($model, $animation, $frame);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function UpdateMusicStream(Music $music): void
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    $raylib_4878fcd84df4c3690086cd1cbfbbfea2->updateMusicStream($music);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function WindowShouldClose(): bool
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->windowShouldClose();
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function Vector2Add(Vector2 $v1, Vector2 $v2): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->vector2Add($v1, $v2);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function Vector2Length(Vector2 $vec): float
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->vector2Length($vec);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function Vector2Scale(Vector2 $vec, float $scale): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->vector2Scale($vec, $scale);
}

/**
 * @psalm-suppress MissingParamType
 * @psalm-suppress MixedArgumentTypeCoercion
 */
function Vector2Subtract(Vector2 $v1, Vector2 $v2): Vector2
{
    global $raylib_4878fcd84df4c3690086cd1cbfbbfea2;
    return $raylib_4878fcd84df4c3690086cd1cbfbbfea2->vector2Subtract($v1, $v2);
}


// phpcs:enable