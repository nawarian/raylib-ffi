<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Vector2};

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawLineBezier,
    DrawText,
    EndDrawing,
    GetMousePosition,
    InitWindow,
    IsMouseButtonDown,
    SetConfigFlags,
    SetTargetFPS,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

SetConfigFlags(Raylib::FLAG_MSAA_4X_HINT);
InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - cubic-bezier lines');

$start = new Vector2(0, 0);
$end = new Vector2($screenWidth, $screenHeight);

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (IsMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON)) {
        $start = GetMousePosition();
    } elseif (IsMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
        $end = GetMousePosition();
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        DrawText('USE MOUSE LEFT-RIGHT CLICK to DEFINE LINE START and END POINTS', 15, 20, 20, Color::gray());

        DrawLineBezier($start, $end, 2.0, Color::red());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
