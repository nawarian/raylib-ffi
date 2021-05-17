<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [textures] example - blend modes');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)
$bgImage = $raylib->loadImage('resources/cyberpunk_street_background.png');     // Loaded in CPU memory (RAM)
$bgTexture = $raylib->loadTextureFromImage($bgImage);          // Image converted to texture, GPU memory (VRAM)

$fgImage = $raylib->loadImage('resources/cyberpunk_street_foreground.png');     // Loaded in CPU memory (RAM)
$fgTexture = $raylib->loadTextureFromImage($fgImage);          // Image converted to texture, GPU memory (VRAM)

// Once image has been converted to texture and uploaded to VRAM, it can be unloaded from RAM
$raylib->unloadImage($bgImage);
$raylib->unloadImage($fgImage);

$blendCountMax = 4;
$blendMode = 0;

// Main game loop
while (!$raylib->windowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isKeyPressed(Raylib::KEY_SPACE)) {
        if ($blendMode >= ($blendCountMax - 1)) {
            $blendMode = 0;
        } else {
            $blendMode++;
        };
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        $raylib->drawTexture(
            $bgTexture,
            (int) ($screenWidth / 2 - $bgTexture->width / 2),
            (int) ($screenHeight / 2 - $bgTexture->height / 2),
            Color::white()
        );

        // Apply the blend mode and then draw the foreground texture
        $raylib->beginBlendMode($blendMode);
            $raylib->drawTexture(
                $fgTexture,
                (int) ($screenWidth / 2 - $fgTexture->width / 2),
                (int) ($screenHeight / 2 - $fgTexture->height / 2),
                Color::white()
            );
        $raylib->endBlendMode();

        // Draw the texts
        $raylib->drawText('Press SPACE to change blend modes.', 310, 350, 10, Color::gray());

        switch ($blendMode) {
            case Raylib::BLEND_ALPHA:
                $raylib->drawText(
                    'Current: BLEND_ALPHA',
                    (int) (($screenWidth / 2) - 60),
                    370,
                    10,
                    Color::gray()
                );
                break;
            case Raylib::BLEND_ADDITIVE:
                $raylib->drawText(
                    'Current: BLEND_ADDITIVE',
                    (int) (($screenWidth / 2) - 60),
                    370,
                    10,
                    Color::gray()
                );
                break;
            case Raylib::BLEND_MULTIPLIED:
                $raylib->drawText(
                    'Current: BLEND_MULTIPLIED',
                    (int) (($screenWidth / 2) - 60),
                    370,
                    10,
                    Color::gray()
                );
                break;
            case Raylib::BLEND_ADD_COLORS:
                $raylib->drawText(
                    'Current: BLEND_ADD_COLORS',
                    (int) (($screenWidth / 2) - 60),
                    370,
                    10,
                    Color::gray()
                );
                break;
        }

        $raylib->drawText(
            '(c) Cyberpunk Street Environment by Luis Zuno (@ansimuz)',
            $screenWidth - 330,
            $screenHeight - 20,
            10,
            Color::gray()
        );

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($fgTexture); // Unload foreground texture
$raylib->unloadTexture($bgTexture); // Unload background texture

$raylib->closeWindow();            // Close window and OpenGL context
//--------------------------------------------------------------------------------------
