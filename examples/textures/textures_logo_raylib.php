<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [textures] example - texture loading and drawing');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)
$texture = $raylib->loadTexture(__DIR__ . '/resources/raylib_logo.png');     // Texture loading
//---------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // TODO: Update your variables here
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawTexture(
            $texture,
            (int) ($screenWidth / 2 - $texture->width / 2),
            (int) ($screenHeight / 2 - $texture->height / 2),
            Color::white()
        );

        $raylib->drawText('this IS a texture!', 360, 370, 10, Color::gray());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($texture);   // Texture unloading
$raylib->closeWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
