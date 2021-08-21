<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{
    Color,
    Vector2,
};

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawCircleV,
    DrawText,
    EndDrawing,
    InitWindow,
    IsKeyDown,
    SetTargetFPS,
    WindowShouldClose
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, "raylib [core] example - keyboard input");
$ballPosition = new Vector2($screenWidth / 2, $screenHeight / 2);

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (IsKeyDown(Raylib::KEY_RIGHT)) {
        $ballPosition->x += 2.0;
    }

    if (IsKeyDown(Raylib::KEY_LEFT)) {
        $ballPosition->x -= 2.0;
    }

    if (IsKeyDown(Raylib::KEY_UP)) {
        $ballPosition->y -= 2.0;
    }

    if (IsKeyDown(Raylib::KEY_DOWN)) {
        $ballPosition->y += 2.0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        DrawText("move the ball with arrow keys", 10, 10, 20, Color::darkGray());

        DrawCircleV($ballPosition, 50, Color::maroon());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
