<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [core] example - generate random values');

// Variable used to count frames
$framesCounter = 0;

// Get a random integer number between -8 and 5 (both included)
$randValue = \Nawarian\Raylib\GetRandomValue(-8, 5);

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) { // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $framesCounter++;

    // Every two seconds (120 frames) a new random value is generated
    if ((($framesCounter / 120) % 2) == 1) {
        $randValue = \Nawarian\Raylib\GetRandomValue(-8, 5);
        $framesCounter = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawText('Every 2 seconds a new random value is generated:', 130, 100, 20, Color::maroon());

        \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextFormat('%d', $randValue), 360, 180, 80, Color::lightGray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
