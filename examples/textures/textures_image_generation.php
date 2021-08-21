<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

const NUM_TEXTURES = 7;     // Currently we have 7 generation algorithms

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - procedural images generation');

$verticalGradient = \Nawarian\Raylib\GenImageGradientV($screenWidth, $screenHeight, Color::red(), Color::blue());
$horizontalGradient = \Nawarian\Raylib\GenImageGradientH($screenWidth, $screenHeight, Color::red(), Color::blue());
$radialGradient = \Nawarian\Raylib\GenImageGradientRadial($screenWidth, $screenHeight, 0.0, Color::white(), Color::black());
$checked = \Nawarian\Raylib\GenImageChecked($screenWidth, $screenHeight, 32, 32, Color::red(), Color::blue());
$whiteNoise = \Nawarian\Raylib\GenImageWhiteNoise($screenWidth, $screenHeight, 0.5);
$perlinNoise = \Nawarian\Raylib\GenImagePerlinNoise($screenWidth, $screenHeight, 50, 50, 4.0);
$cellular = \Nawarian\Raylib\GenImageCellular($screenWidth, $screenHeight, 32);

$textures = [
    \Nawarian\Raylib\LoadTextureFromImage($verticalGradient),
    \Nawarian\Raylib\LoadTextureFromImage($horizontalGradient),
    \Nawarian\Raylib\LoadTextureFromImage($radialGradient),
    \Nawarian\Raylib\LoadTextureFromImage($checked),
    \Nawarian\Raylib\LoadTextureFromImage($whiteNoise),
    \Nawarian\Raylib\LoadTextureFromImage($perlinNoise),
    \Nawarian\Raylib\LoadTextureFromImage($cellular),
];

// Unload image data (CPU RAM)
\Nawarian\Raylib\UnloadImage($verticalGradient);
\Nawarian\Raylib\UnloadImage($horizontalGradient);
\Nawarian\Raylib\UnloadImage($radialGradient);
\Nawarian\Raylib\UnloadImage($checked);
\Nawarian\Raylib\UnloadImage($whiteNoise);
\Nawarian\Raylib\UnloadImage($perlinNoise);
\Nawarian\Raylib\UnloadImage($cellular);

$currentTexture = 0;

\Nawarian\Raylib\SetTargetFPS(60);
//---------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {
    // Update
    //----------------------------------------------------------------------------------
    if (\Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON) || \Nawarian\Raylib\IsKeyPressed(Raylib::KEY_RIGHT)) {
        $currentTexture = ($currentTexture + 1) % NUM_TEXTURES;     // Cycle between the textures
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawTexture($textures[$currentTexture], 0, 0, Color::white());

        \Nawarian\Raylib\DrawRectangle(30, 400, 325, 30, \Nawarian\Raylib\Fade(Color::skyBlue(), 0.5));
        \Nawarian\Raylib\DrawRectangleLines(30, 400, 325, 30, \Nawarian\Raylib\Fade(Color::white(), 0.5));
        \Nawarian\Raylib\DrawText('MOUSE LEFT BUTTON to CYCLE PROCEDURAL TEXTURES', 40, 410, 10, Color::white());

        switch ($currentTexture) {
            case 0:
                \Nawarian\Raylib\DrawText('VERTICAL GRADIENT', 560, 10, 20, Color::rayWhite());
                break;
            case 1:
                \Nawarian\Raylib\DrawText('HORIZONTAL GRADIENT', 540, 10, 20, Color::rayWhite());
                break;
            case 2:
                \Nawarian\Raylib\DrawText('RADIAL GRADIENT', 580, 10, 20, Color::lightGray());
                break;
            case 3:
                \Nawarian\Raylib\DrawText('CHECKED', 680, 10, 20, Color::rayWhite());
                break;
            case 4:
                \Nawarian\Raylib\DrawText('WHITE NOISE', 640, 10, 20, Color::red());
                break;
            case 5:
                \Nawarian\Raylib\DrawText('PERLIN NOISE', 630, 10, 20, Color::rayWhite());
                break;
            case 6:
                \Nawarian\Raylib\DrawText('CELLULAR', 670, 10, 20, Color::rayWhite());
                break;
            default:
                break;
        }
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------

// Unload textures data (GPU VRAM)
foreach ($textures as $texture) {
    \Nawarian\Raylib\UnloadTexture($texture);
}

\Nawarian\Raylib\CloseWindow();
