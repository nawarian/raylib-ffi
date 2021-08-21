<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawCircleV,
    DrawText,
    EndDrawing,
    GetMousePosition,
    InitWindow,
    IsMouseButtonPressed,
    SetTargetFPS,
    WindowShouldClose
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, "raylib [core] example - mouse input");

$ballColor = Color::darkBlue();

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//---------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $ballPosition = GetMousePosition();

    if (IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $ballColor = Color::maroon();
    } elseif (IsMouseButtonPressed(Raylib::MOUSE_MIDDLE_BUTTON)) {
        $ballColor = Color::lime();
    } elseif (IsMouseButtonPressed(Raylib::MOUSE_RIGHT_BUTTON)) {
        $ballColor = Color::darkBlue();
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        DrawCircleV($ballPosition, 40, $ballColor);

        DrawText("move ball with mouse and click mouse button to change color", 10, 10, 20, Color::darkGray());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
