<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, "raylib [core] example - input mouse wheel");

$boxPositionY = $screenHeight / 2 - 40;
$scrollSpeed = 4;            // Scrolling speed in pixels

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $boxPositionY -= \Nawarian\Raylib\GetMouseWheelMove() * $scrollSpeed;
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawRectangle($screenWidth / 2 - 40, $boxPositionY, 80, 80, Color::maroon());

        \Nawarian\Raylib\DrawText("Use mouse wheel to move the cube up and down!", 10, 10, 20, Color::gray());
        \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextFormat("Box position Y: %03d", $boxPositionY), 10, 40, 20, Color::lightGray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
