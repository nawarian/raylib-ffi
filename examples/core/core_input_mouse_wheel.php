<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - input mouse wheel");

$boxPositionY = $screenHeight / 2 - 40;
$scrollSpeed = 4;            // Scrolling speed in pixels

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $boxPositionY -= $raylib->getMouseWheelMove() * $scrollSpeed;
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawRectangle($screenWidth / 2 - 40, $boxPositionY, 80, 80, Color::maroon());

        $raylib->drawText("Use mouse wheel to move the cube up and down!", 10, 10, 20, Color::gray());
        $raylib->drawText(
            $raylib->textFormat("Box position Y: %03d", $boxPositionY),
            10,
            40,
            20,
            Color::lightGray(),
        );

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
