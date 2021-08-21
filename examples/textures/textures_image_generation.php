<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawRectangle,
    DrawRectangleLines,
    DrawText,
    DrawTexture,
    EndDrawing,
    Fade,
    GenImageCellular,
    GenImageChecked,
    GenImageGradientH,
    GenImageGradientRadial,
    GenImageGradientV,
    GenImagePerlinNoise,
    GenImageWhiteNoise,
    InitWindow,
    IsKeyPressed,
    IsMouseButtonPressed,
    LoadTextureFromImage,
    SetTargetFPS,
    UnloadImage,
    UnloadTexture,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

const NUM_TEXTURES = 7;     // Currently we have 7 generation algorithms

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - procedural images generation');

$verticalGradient = GenImageGradientV($screenWidth, $screenHeight, Color::red(), Color::blue());
$horizontalGradient = GenImageGradientH($screenWidth, $screenHeight, Color::red(), Color::blue());
$radialGradient = GenImageGradientRadial($screenWidth, $screenHeight, 0.0, Color::white(), Color::black());
$checked = GenImageChecked($screenWidth, $screenHeight, 32, 32, Color::red(), Color::blue());
$whiteNoise = GenImageWhiteNoise($screenWidth, $screenHeight, 0.5);
$perlinNoise = GenImagePerlinNoise($screenWidth, $screenHeight, 50, 50, 4.0);
$cellular = GenImageCellular($screenWidth, $screenHeight, 32);

$textures = [
    LoadTextureFromImage($verticalGradient),
    LoadTextureFromImage($horizontalGradient),
    LoadTextureFromImage($radialGradient),
    LoadTextureFromImage($checked),
    LoadTextureFromImage($whiteNoise),
    LoadTextureFromImage($perlinNoise),
    LoadTextureFromImage($cellular),
];

// Unload image data (CPU RAM)
UnloadImage($verticalGradient);
UnloadImage($horizontalGradient);
UnloadImage($radialGradient);
UnloadImage($checked);
UnloadImage($whiteNoise);
UnloadImage($perlinNoise);
UnloadImage($cellular);

$currentTexture = 0;

SetTargetFPS(60);
//---------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {
    // Update
    //----------------------------------------------------------------------------------
    if (IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON) || IsKeyPressed(Raylib::KEY_RIGHT)) {
        $currentTexture = ($currentTexture + 1) % NUM_TEXTURES;     // Cycle between the textures
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        DrawTexture($textures[$currentTexture], 0, 0, Color::white());

        DrawRectangle(30, 400, 325, 30, Fade(Color::skyBlue(), 0.5));
        DrawRectangleLines(30, 400, 325, 30, Fade(Color::white(), 0.5));
        DrawText('MOUSE LEFT BUTTON to CYCLE PROCEDURAL TEXTURES', 40, 410, 10, Color::white());

        switch ($currentTexture) {
            case 0:
                DrawText('VERTICAL GRADIENT', 560, 10, 20, Color::rayWhite());
                break;
            case 1:
                DrawText('HORIZONTAL GRADIENT', 540, 10, 20, Color::rayWhite());
                break;
            case 2:
                DrawText('RADIAL GRADIENT', 580, 10, 20, Color::lightGray());
                break;
            case 3:
                DrawText('CHECKED', 680, 10, 20, Color::rayWhite());
                break;
            case 4:
                DrawText('WHITE NOISE', 640, 10, 20, Color::red());
                break;
            case 5:
                DrawText('PERLIN NOISE', 630, 10, 20, Color::rayWhite());
                break;
            case 6:
                DrawText('CELLULAR', 670, 10, 20, Color::rayWhite());
                break;
            default:
                break;
        }
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------

// Unload textures data (GPU VRAM)
foreach ($textures as $texture) {
    UnloadTexture($texture);
}

CloseWindow();
