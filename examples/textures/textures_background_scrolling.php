<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{
    Color,
    Vector2,
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [textures] example - background scrolling');

// NOTE: Be careful, background width must be equal or bigger than screen width
// if not, texture should be draw more than two times for scrolling effect
$background = $raylib->loadTexture('resources/cyberpunk_street_background.png');
$midground = $raylib->loadTexture('resources/cyberpunk_street_midground.png');
$foreground = $raylib->loadTexture('resources/cyberpunk_street_foreground.png');

$scrollingBack = 0.0;
$scrollingMid = 0.0;
$scrollingFore = 0.0;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $scrollingBack -= 0.1;
    $scrollingMid -= 0.5;
    $scrollingFore -= 1.0;

    // NOTE: Texture is scaled twice its size, so it should be considered on scrolling
    if ($scrollingBack <= -$background->width * 2) {
        $scrollingBack = 0;
    }

    if ($scrollingMid <= -$midground->width * 2) {
        $scrollingMid = 0;
    }

    if ($scrollingFore <= -$foreground->width * 2) {
        $scrollingFore = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground($raylib->getColor(0x052c46ff));

        // Draw background image twice
        // NOTE: Texture is scaled twice its size
        $raylib->drawTextureEx($background, new Vector2($scrollingBack, 20), 0.0, 2.0, Color::white());
        $raylib->drawTextureEx(
            $background,
            new Vector2($background->width * 2 + $scrollingBack, 20),
            0.0,
            2.0,
            Color::white(),
        );

        // Draw midground image twice
        $raylib->drawTextureEx($midground, new Vector2($scrollingMid, 20), 0.0, 2.0, Color::white());
        $raylib->drawTextureEx(
            $midground,
            new Vector2($midground->width * 2 + $scrollingMid, 20),
            0.0,
            2.0,
            Color::white()
        );

        // Draw foreground image twice
        $raylib->drawTextureEx($foreground, new Vector2($scrollingFore, 70), 0.0, 2.0, Color::white());
        $raylib->drawTextureEx(
            $foreground,
            new Vector2($foreground->width * 2 + $scrollingFore, 70),
            0.0,
            2.0,
            Color::white()
        );

        $raylib->drawText('BACKGROUND SCROLLING & PARALLAX', 10, 10, 20, Color::red());
        $raylib->drawText(
            '(c) Cyberpunk Street Environment by Luis Zuno (@ansimuz)',
            $screenWidth - 330,
            $screenHeight - 20,
            10,
            Color::rayWhite()
        );

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($background);  // Unload background texture
$raylib->unloadTexture($midground);   // Unload midground texture
$raylib->unloadTexture($foreground);  // Unload foreground texture

$raylib->closeWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
