<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Vector2};

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawCircleV,
    DrawFPS,
    DrawText,
    EndDrawing,
    GetScreenHeight,
    GetScreenWidth,
    InitWindow,
    IsKeyPressed,
    SetTargetFPS,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//---------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - bouncing ball');

$ballPosition = new Vector2(GetScreenWidth() / 2, GetScreenHeight() / 2);
$ballSpeed = new Vector2(5.0, 4.0);
$ballRadius = 20;

$pause = 0;
$framesCounter = 0;

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//----------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //-----------------------------------------------------
    if (IsKeyPressed(Raylib::KEY_SPACE)) {
        $pause = !$pause;
    }

    if (!$pause) {
        $ballPosition->x += $ballSpeed->x;
        $ballPosition->y += $ballSpeed->y;

        // Check walls collision for bouncing
        if (($ballPosition->x >= (GetScreenWidth() - $ballRadius)) || ($ballPosition->x <= $ballRadius)) {
            $ballSpeed->x *= -1.0;
        }

        if (($ballPosition->y >= (GetScreenHeight() - $ballRadius)) || ($ballPosition->y <= $ballRadius)) {
            $ballSpeed->y *= -1.0;
        }
    } else {
        $framesCounter++;
    }
    //-----------------------------------------------------

    // Draw
    //-----------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        DrawCircleV($ballPosition, $ballRadius, Color::maroon());
        DrawText('PRESS SPACE to PAUSE BALL MOVEMENT', 10, GetScreenHeight() - 25, 20, Color::lightGray());

        // On pause, we draw a blinking message
        if ($pause && (($framesCounter / 30) % 2)) {
            DrawText('PAUSED', 350, 200, 30, Color::gray());
        }

        DrawFPS(10, 10);
        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

    EndDrawing();
    //-----------------------------------------------------
}

// De-Initialization
//---------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//----------------------------------------------------------
