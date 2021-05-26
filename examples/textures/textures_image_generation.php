<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const NUM_TEXTURES = 7;     // Currently we have 7 generation algorithms

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [textures] example - procedural images generation');

$verticalGradient = $raylib->genImageGradientV($screenWidth, $screenHeight, Color::red(), Color::blue());
$horizontalGradient = $raylib->genImageGradientH($screenWidth, $screenHeight, Color::red(), Color::blue());
$radialGradient = $raylib->genImageGradientRadial($screenWidth, $screenHeight, 0.0, Color::white(), Color::black());
$checked = $raylib->genImageChecked($screenWidth, $screenHeight, 32, 32, Color::red(), Color::blue());
$whiteNoise = $raylib->genImageWhiteNoise($screenWidth, $screenHeight, 0.5);
$perlinNoise = $raylib->genImagePerlinNoise($screenWidth, $screenHeight, 50, 50, 4.0);
$cellular = $raylib->genImageCellular($screenWidth, $screenHeight, 32);

$textures = [
    $raylib->loadTextureFromImage($verticalGradient),
    $raylib->loadTextureFromImage($horizontalGradient),
    $raylib->loadTextureFromImage($radialGradient),
    $raylib->loadTextureFromImage($checked),
    $raylib->loadTextureFromImage($whiteNoise),
    $raylib->loadTextureFromImage($perlinNoise),
    $raylib->loadTextureFromImage($cellular),
];

// Unload image data (CPU RAM)
$raylib->unloadImage($verticalGradient);
$raylib->unloadImage($horizontalGradient);
$raylib->unloadImage($radialGradient);
$raylib->unloadImage($checked);
$raylib->unloadImage($whiteNoise);
$raylib->unloadImage($perlinNoise);
$raylib->unloadImage($cellular);

$currentTexture = 0;

$raylib->setTargetFPS(60);
//---------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON) || $raylib->isKeyPressed(Raylib::KEY_RIGHT)) {
        $currentTexture = ($currentTexture + 1) % NUM_TEXTURES;     // Cycle between the textures
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawTexture($textures[$currentTexture], 0, 0, Color::white());

        $raylib->drawRectangle(30, 400, 325, 30, $raylib->fade(Color::skyBlue(), 0.5));
        $raylib->drawRectangleLines(30, 400, 325, 30, $raylib->fade(Color::white(), 0.5));
        $raylib->drawText('MOUSE LEFT BUTTON to CYCLE PROCEDURAL TEXTURES', 40, 410, 10, Color::white());

        switch ($currentTexture) {
            case 0:
                $raylib->drawText('VERTICAL GRADIENT', 560, 10, 20, Color::rayWhite());
                break;
            case 1:
                $raylib->drawText('HORIZONTAL GRADIENT', 540, 10, 20, Color::rayWhite());
                break;
            case 2:
                $raylib->drawText('RADIAL GRADIENT', 580, 10, 20, Color::lightGray());
                break;
            case 3:
                $raylib->drawText('CHECKED', 680, 10, 20, Color::rayWhite());
                break;
            case 4:
                $raylib->drawText('WHITE NOISE', 640, 10, 20, Color::red());
                break;
            case 5:
                $raylib->drawText('PERLIN NOISE', 630, 10, 20, Color::rayWhite());
                break;
            case 6:
                $raylib->drawText('CELLULAR', 670, 10, 20, Color::rayWhite());
                break;
            default:
                break;
        }
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------

// Unload textures data (GPU VRAM)
foreach ($textures as $texture) {
    $raylib->unloadTexture($texture);
}

$raylib->closeWindow();
