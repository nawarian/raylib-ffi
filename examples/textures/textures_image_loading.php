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

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [textures] example - image loading');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)

$image = $raylib->loadImage(__DIR__ . '/resources/raylib_logo.png');        // Loaded in CPU memory (RAM)
$texture = $raylib->loadTextureFromImage($image);       // Image converted to texture, GPU memory (VRAM)

//phpcs:ignore Generic.Files.LineLength.TooLong
$raylib->unloadImage($image);   // Once image has been converted to texture and uploaded to VRAM, it can be unloaded from RAM
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

        $raylib->drawText('this IS a texture loaded from an image!', 300, 370, 10, Color::gray());
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($texture);       // Texture unloading

$raylib->closeWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
