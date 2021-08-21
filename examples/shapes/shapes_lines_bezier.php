<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\SetConfigFlags(Raylib::FLAG_MSAA_4X_HINT);
\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - cubic-bezier lines');

$start = new Vector2(0, 0);
$end = new Vector2($screenWidth, $screenHeight);

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (\Nawarian\Raylib\IsMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON)) {
        $start = \Nawarian\Raylib\GetMousePosition();
    } elseif (\Nawarian\Raylib\IsMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
        $end = \Nawarian\Raylib\GetMousePosition();
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawText('USE MOUSE LEFT-RIGHT CLICK to DEFINE LINE START and END POINTS', 15, 20, 20, Color::gray());

        \Nawarian\Raylib\DrawLineBezier($start, $end, 2.0, Color::red());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
