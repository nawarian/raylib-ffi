<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//---------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - bouncing ball');

$ballPosition = new Vector2(\Nawarian\Raylib\GetScreenWidth() / 2, \Nawarian\Raylib\GetScreenHeight() / 2);
$ballSpeed = new Vector2(5.0, 4.0);
$ballRadius = 20;

$pause = 0;
$framesCounter = 0;

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//----------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //-----------------------------------------------------
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        $pause = !$pause;
    }

    if (!$pause) {
        $ballPosition->x += $ballSpeed->x;
        $ballPosition->y += $ballSpeed->y;

        // Check walls collision for bouncing
        if (($ballPosition->x >= (\Nawarian\Raylib\GetScreenWidth() - $ballRadius)) || ($ballPosition->x <= $ballRadius)) {
            $ballSpeed->x *= -1.0;
        }

        if (($ballPosition->y >= (\Nawarian\Raylib\GetScreenHeight() - $ballRadius)) || ($ballPosition->y <= $ballRadius)) {
            $ballSpeed->y *= -1.0;
        }
    } else {
        $framesCounter++;
    }
    //-----------------------------------------------------

    // Draw
    //-----------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        \Nawarian\Raylib\DrawCircleV($ballPosition, $ballRadius, Color::maroon());
        \Nawarian\Raylib\DrawText('PRESS SPACE to PAUSE BALL MOVEMENT', 10, \Nawarian\Raylib\GetScreenHeight() - 25, 20, Color::lightGray());

        // On pause, we draw a blinking message
        if ($pause && (($framesCounter / 30) % 2)) {
            \Nawarian\Raylib\DrawText('PAUSED', 350, 200, 30, Color::gray());
        }

        \Nawarian\Raylib\DrawFPS(10, 10);
        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

    \Nawarian\Raylib\EndDrawing();
    //-----------------------------------------------------
}

// De-Initialization
//---------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//----------------------------------------------------------
