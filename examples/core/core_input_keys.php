<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{
    Color,
    Vector2,
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, "raylib [core] example - keyboard input");
$ballPosition = new Vector2($screenWidth / 2, $screenHeight / 2);

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_RIGHT)) {
        $ballPosition->x += 2.0;
    }

    if (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_LEFT)) {
        $ballPosition->x -= 2.0;
    }

    if (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_UP)) {
        $ballPosition->y -= 2.0;
    }

    if (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_DOWN)) {
        $ballPosition->y += 2.0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawText("move the ball with arrow keys", 10, 10, 20, Color::darkGray());

        \Nawarian\Raylib\DrawCircleV($ballPosition, 50, Color::maroon());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
