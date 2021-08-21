<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawCircle,
    DrawRectangle,
    DrawText,
    EndDrawing,
    Fade,
    InitWindow,
    IsKeyPressed,
    SetTargetFPS,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/easings.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, "raylib [shapes] example - easings ball anim");

// Ball variable value to be animated with easings
$ballPositionX = -100;
$ballRadius = 20;
$ballAlpha = 0.0;

$state = 0;
$framesCounter = 0;

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    switch ($state) {
        case 0:     // Move ball position X with easing
            $framesCounter++;
            $ballPositionX = easeElasticOut($framesCounter, -100, $screenWidth / 2 + 100, 120);

            if ($framesCounter >= 120) {
                $framesCounter = 0;
                $state = 1;
            }
            break;
        case 1:     // Increase ball radius with easing
            $framesCounter++;
            $ballRadius = easeElasticIn($framesCounter, 20, 500, 200);

            if ($framesCounter >= 200) {
                $framesCounter = 0;
                $state = 2;
            }
            break;
        case 2:     // Change ball alpha with easing (background color blending)
            $framesCounter++;
            $ballAlpha = easeCubicOut($framesCounter, 0.0, 1.0, 200);

            if ($framesCounter >= 200) {
                $framesCounter = 0;
                $state = 3;
            }
            break;
        case 3:     // Reset state to play again
            if (IsKeyPressed(Raylib::KEY_ENTER)) {
                // Reset required variables to play again
                $ballPositionX = -100;
                $ballRadius = 20;
                $ballAlpha = 0.0;
                $state = 0;
            }
            break;
    }

    if (IsKeyPressed(Raylib::KEY_R)) {
        $framesCounter = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        if ($state >= 2) {
            DrawRectangle(0, 0, $screenWidth, $screenHeight, Color::green());
        }

        DrawCircle((int) $ballPositionX, 200, (int) $ballRadius, Fade(Color::red(), 1.0 - $ballAlpha));

        if ($state === 3) {
            DrawText("PRESS [ENTER] TO PLAY AGAIN!", 240, 200, 20, Color::black());
        }
    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
