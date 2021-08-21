<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - raylib logo animation');

$logoPositionX = $screenWidth / 2 - 128;
$logoPositionY = $screenHeight / 2 - 128;

$framesCounter = 0;
$lettersCount = 0;

$topSideRecWidth = 16;
$leftSideRecHeight = 16;

$bottomSideRecWidth = 16;
$rightSideRecHeight = 16;

$state = 0;                  // Tracking animation states (State Machine)
$alpha = 1.0;             // Useful for fading

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($state == 0) {                // State 0: Small box blinking
        $framesCounter++;

        if ($framesCounter === 120) {
            $state = 1;
            $framesCounter = 0;      // Reset counter... will be used later...
        }
    } elseif ($state === 1) {           // State 1: Top and left bars growing
        $topSideRecWidth += 4;
        $leftSideRecHeight += 4;

        if ($topSideRecWidth === 256) {
            $state = 2;
        }
    } elseif ($state === 2) {           // State 2: Bottom and right bars growing
        $bottomSideRecWidth += 4;
        $rightSideRecHeight += 4;

        if ($bottomSideRecWidth === 256) {
            $state = 3;
        }
    } elseif ($state === 3) {           // State 3: Letters appearing (one by one)
        $framesCounter++;

        if ($framesCounter / 12) {      // Every 12 frames, one more letter!
            $lettersCount++;
            $framesCounter = 0;
        }

        if ($lettersCount >= 10) {    // When all letters have appeared, just fade out everything
            $alpha -= 0.02;

            if ($alpha <= 0.0) {
                $alpha = 0.0;
                $state = 4;
            }
        }
    } else {           // State 4: Reset and Replay
        if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_R)) {
            $framesCounter = 0;
            $lettersCount = 0;

            $topSideRecWidth = 16;
            $leftSideRecHeight = 16;

            $bottomSideRecWidth = 16;
            $rightSideRecHeight = 16;

            $alpha = 1.0;
            $state = 0;          // Return to State 0
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        if ($state === 0) {
            if (($framesCounter / 15) % 2) {
                \Nawarian\Raylib\DrawRectangle($logoPositionX, $logoPositionY, 16, 16, Color::black());
            }
        } elseif ($state === 1) {
            \Nawarian\Raylib\DrawRectangle($logoPositionX, $logoPositionY, $topSideRecWidth, 16, Color::black());
            \Nawarian\Raylib\DrawRectangle($logoPositionX, $logoPositionY, 16, $leftSideRecHeight, Color::black());
        } elseif ($state === 2) {
            \Nawarian\Raylib\DrawRectangle($logoPositionX, $logoPositionY, $topSideRecWidth, 16, Color::black());
            \Nawarian\Raylib\DrawRectangle($logoPositionX, $logoPositionY, 16, $leftSideRecHeight, Color::black());

            \Nawarian\Raylib\DrawRectangle($logoPositionX + 240, $logoPositionY, 16, $rightSideRecHeight, Color::black());
            \Nawarian\Raylib\DrawRectangle($logoPositionX, $logoPositionY + 240, $bottomSideRecWidth, 16, Color::black());
        } elseif ($state === 3) {
            \Nawarian\Raylib\DrawRectangle($logoPositionX, $logoPositionY, $topSideRecWidth, 16, \Nawarian\Raylib\Fade(Color::black(), $alpha));
            \Nawarian\Raylib\DrawRectangle($logoPositionX, $logoPositionY + 16, 16, $leftSideRecHeight - 32, \Nawarian\Raylib\Fade(Color::black(), $alpha));

            \Nawarian\Raylib\DrawRectangle($logoPositionX + 240, $logoPositionY + 16, 16, $rightSideRecHeight - 32, \Nawarian\Raylib\Fade(Color::black(), $alpha));
            \Nawarian\Raylib\DrawRectangle($logoPositionX, $logoPositionY + 240, $bottomSideRecWidth, 16, \Nawarian\Raylib\Fade(Color::black(), $alpha));

            \Nawarian\Raylib\DrawRectangle((int) ($screenWidth / 2 - 112), (int) ($screenHeight / 2 - 112), 224, 224, \Nawarian\Raylib\Fade(Color::rayWhite(), $alpha));

            \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextSubtext('raylib', 0, $lettersCount), (int) ($screenWidth / 2 - 44), (int) ($screenHeight / 2 + 48), 50, \Nawarian\Raylib\Fade(Color::black(), $alpha));
        } else {
            \Nawarian\Raylib\DrawText('[R] REPLAY', 340, 200, 20, Color::gray());
        }

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
