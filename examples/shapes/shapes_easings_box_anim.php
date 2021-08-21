<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/easings.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - easings box anim');

// Box variables to be animated with easings
$rec = new Rectangle(\Nawarian\Raylib\GetScreenWidth() / 2, -100, 100, 100);
$rotation = 0.0;
$alpha = 1.0;

$state = 0;
$framesCounter = 0;

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    switch ($state) {
        case 0:     // Move box down to center of screen
            $framesCounter++;

            // NOTE: Remember that 3rd parameter of easing function refers to
            // desired value variation, do not confuse it with expected final value!
            $rec->y = easeElasticOut($framesCounter, -100, \Nawarian\Raylib\GetScreenHeight() / 2 + 100, 120);

            if ($framesCounter >= 120) {
                $framesCounter = 0;
                $state = 1;
            }
            break;
        case 1:     // Scale box to an horizontal bar
            $framesCounter++;
            $rec->height = easeBounceOut($framesCounter, 100, -90, 120);
            $rec->width = easeBounceOut($framesCounter, 100, \Nawarian\Raylib\GetScreenWidth(), 120);

            if ($framesCounter >= 120) {
                $framesCounter = 0;
                $state = 2;
            }
            break;
        case 2:     // Rotate horizontal bar rectangle
            $framesCounter++;
            $rotation = easeQuadOut($framesCounter, 0.0, 270.0, 240);

            if ($framesCounter >= 240) {
                $framesCounter = 0;
                $state = 3;
            }
            break;
        case 3:     // Increase bar size to fill all screen
            $framesCounter++;
            $rec->height = easeCircOut($framesCounter, 10, \Nawarian\Raylib\GetScreenWidth(), 120);

            if ($framesCounter >= 120) {
                $framesCounter = 0;
                $state = 4;
            }
            break;
        case 4:     // Fade out animation
            $framesCounter++;
            $alpha = easeSineOut($framesCounter, 1.0, -1.0, 160);

            if ($framesCounter >= 160) {
                $framesCounter = 0;
                $state = 5;
            }
            break;
    }

    // Reset animation at any moment
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        $rec = new Rectangle(\Nawarian\Raylib\GetScreenWidth() / 2, -100, 100, 100);
        $rotation = 0.0;
        $alpha = 1.0;
        $state = 0;
        $framesCounter = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawRectanglePro($rec, new Vector2($rec->width / 2, $rec->height / 2), $rotation, \Nawarian\Raylib\Fade(Color::black(), $alpha));

        \Nawarian\Raylib\DrawText('PRESS [SPACE] TO RESET BOX ANIMATION!', 10, \Nawarian\Raylib\GetScreenHeight() - 25, 20, Color::lightGray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
