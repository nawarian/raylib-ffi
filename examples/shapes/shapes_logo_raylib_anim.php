<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [shapes] example - raylib logo animation');

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

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
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
        if ($raylib->isKeyPressed(Raylib::KEY_R)) {
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
    $raylib->beginDrawing();
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        $raylib->clearBackground(Color::rayWhite());

        if ($state === 0) {
            if (($framesCounter / 15) % 2) {
                $raylib->drawRectangle($logoPositionX, $logoPositionY, 16, 16, Color::black());
            }
        } elseif ($state === 1) {
            $raylib->drawRectangle($logoPositionX, $logoPositionY, $topSideRecWidth, 16, Color::black());
            $raylib->drawRectangle($logoPositionX, $logoPositionY, 16, $leftSideRecHeight, Color::black());
        } elseif ($state === 2) {
            $raylib->drawRectangle($logoPositionX, $logoPositionY, $topSideRecWidth, 16, Color::black());
            $raylib->drawRectangle($logoPositionX, $logoPositionY, 16, $leftSideRecHeight, Color::black());

            $raylib->drawRectangle($logoPositionX + 240, $logoPositionY, 16, $rightSideRecHeight, Color::black());
            $raylib->drawRectangle($logoPositionX, $logoPositionY + 240, $bottomSideRecWidth, 16, Color::black());
        } elseif ($state === 3) {
            $raylib->drawRectangle(
                $logoPositionX,
                $logoPositionY,
                $topSideRecWidth,
                16,
                $raylib->fade(Color::black(), $alpha),
            );
            $raylib->drawRectangle(
                $logoPositionX,
                $logoPositionY + 16,
                16,
                $leftSideRecHeight - 32,
                $raylib->fade(Color::black(), $alpha),
            );

            $raylib->drawRectangle(
                $logoPositionX + 240,
                $logoPositionY + 16,
                16,
                $rightSideRecHeight - 32,
                $raylib->fade(Color::black(), $alpha),
            );
            $raylib->drawRectangle(
                $logoPositionX,
                $logoPositionY + 240,
                $bottomSideRecWidth,
                16,
                $raylib->fade(Color::black(), $alpha),
            );

            $raylib->drawRectangle(
                (int) ($screenWidth / 2 - 112),
                (int) ($screenHeight / 2 - 112),
                224,
                224,
                $raylib->fade(Color::rayWhite(), $alpha),
            );

            $raylib->drawText(
                $raylib->textSubtext('raylib', 0, $lettersCount),
                (int) ($screenWidth / 2 - 44),
                (int) ($screenHeight / 2 + 48),
                50,
                $raylib->fade(Color::black(), $alpha),
            );
        } else {
            $raylib->drawText('[R] REPLAY', 340, 200, 20, Color::gray());
        }

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
