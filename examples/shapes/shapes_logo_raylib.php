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

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [shapes] example - raylib logo using shapes');

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // TODO: Update your variables here
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawRectangle($screenWidth / 2 - 128, $screenHeight / 2 - 128, 256, 256, Color::black());
        $raylib->drawRectangle($screenWidth / 2 - 112, $screenHeight / 2 - 112, 224, 224, Color::rayWhite());
        $raylib->drawText(
            'raylib',
            (int) ($screenWidth / 2 - 44),
            (int) ($screenHeight / 2 + 48),
            50,
            Color::black()
        );

        $raylib->drawText('this is NOT a texture!', 350, 370, 10, Color::gray());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
