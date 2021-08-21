<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/easings.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, "raylib [shapes] example - easings ball anim");

// Ball variable value to be animated with easings
$ballPositionX = -100;
$ballRadius = 20;
$ballAlpha = 0.0;

$state = 0;
$framesCounter = 0;

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {     // Detect window close button or ESC key
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
            if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_ENTER)) {
                // Reset required variables to play again
                $ballPositionX = -100;
                $ballRadius = 20;
                $ballAlpha = 0.0;
                $state = 0;
            }
            break;
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_R)) {
        $framesCounter = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        if ($state >= 2) {
            \Nawarian\Raylib\DrawRectangle(0, 0, $screenWidth, $screenHeight, Color::green());
        }

        \Nawarian\Raylib\DrawCircle((int) $ballPositionX, 200, (int) $ballRadius, \Nawarian\Raylib\Fade(Color::red(), 1.0 - $ballAlpha));

        if ($state === 3) {
            \Nawarian\Raylib\DrawText("PRESS [ENTER] TO PLAY AGAIN!", 240, 200, 20, Color::black());
        }
    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
