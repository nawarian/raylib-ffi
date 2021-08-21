<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawText,
    EndDrawing,
    GetRandomValue,
    InitWindow,
    SetTargetFPS,
    TextFormat,
    WindowShouldClose
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [core] example - generate random values');

// Variable used to count frames
$framesCounter = 0;

// Get a random integer number between -8 and 5 (both included)
$randValue = GetRandomValue(-8, 5);

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) { // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $framesCounter++;

    // Every two seconds (120 frames) a new random value is generated
    if ((($framesCounter / 120) % 2) == 1) {
        $randValue = GetRandomValue(-8, 5);
        $framesCounter = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        DrawText('Every 2 seconds a new random value is generated:', 130, 100, 20, Color::maroon());

        DrawText(TextFormat('%d', $randValue), 360, 180, 80, Color::lightGray());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
