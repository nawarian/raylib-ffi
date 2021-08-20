<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/easings.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [shapes] example - easings ball anim");

// Ball variable value to be animated with easings
$ballPositionX = -100;
$ballRadius = 20;
$ballAlpha = 0.0;

$state = 0;
$framesCounter = 0;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {     // Detect window close button or ESC key
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
            if ($raylib->isKeyPressed(Raylib::KEY_ENTER)) {
                // Reset required variables to play again
                $ballPositionX = -100;
                $ballRadius = 20;
                $ballAlpha = 0.0;
                $state = 0;
            }
            break;
    }

    if ($raylib->isKeyPressed(Raylib::KEY_R)) {
        $framesCounter = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        if ($state >= 2) {
            $raylib->drawRectangle(0, 0, $screenWidth, $screenHeight, Color::green());
        }

        $raylib->drawCircle(
            (int) $ballPositionX,
            200,
            (int) $ballRadius,
            $raylib->fade(Color::red(), 1.0 - $ballAlpha)
        );

        if ($state === 3) {
            $raylib->drawText("PRESS [ENTER] TO PLAY AGAIN!", 240, 200, 20, Color::black());
        }
    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
