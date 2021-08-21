<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\Color;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, "raylib [core] example - mouse input");

$ballColor = Color::darkBlue();

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//---------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $ballPosition = \Nawarian\Raylib\GetMousePosition();

    if (\Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $ballColor = Color::maroon();
    } elseif (\Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_MIDDLE_BUTTON)) {
        $ballColor = Color::lime();
    } elseif (\Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_RIGHT_BUTTON)) {
        $ballColor = Color::darkBlue();
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawCircleV($ballPosition, 40, $ballColor);

        \Nawarian\Raylib\DrawText("move ball with mouse and click mouse button to change color", 10, 10, 20, Color::darkGray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
