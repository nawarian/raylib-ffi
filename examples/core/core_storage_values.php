<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\{
    Raylib,
    RaylibFactory,
};
use Nawarian\Raylib\Types\Color;

const STORAGE_POSITION_SCORE = 0;
const STORAGE_POSITION_HISCORE = 1;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [core] example - storage save/load values');

$score = 0;
$hiscore = 0;
$framesCounter = 0;

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_R)) {
        $score = \Nawarian\Raylib\GetRandomValue(1000, 2000);
        $hiscore = \Nawarian\Raylib\GetRandomValue(2000, 4000);
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_ENTER)) {
        \Nawarian\Raylib\SaveStorageValue(STORAGE_POSITION_SCORE, $score);
        \Nawarian\Raylib\SaveStorageValue(STORAGE_POSITION_HISCORE, $hiscore);
    } elseif (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        // NOTE: If requested position could not be found, value 0 is returned
        $score = \Nawarian\Raylib\LoadStorageValue(STORAGE_POSITION_SCORE);
        $hiscore = \Nawarian\Raylib\LoadStorageValue(STORAGE_POSITION_HISCORE);
    }

    $framesCounter++;
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextFormat('SCORE: %d', $score), 280, 130, 40, Color::maroon());
        \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextFormat('HI-SCORE: %d', $hiscore), 210, 200, 50, Color::black());

        \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextFormat('frames: %d', $framesCounter), 10, 10, 20, Color::lime());

        \Nawarian\Raylib\DrawText('Press R to generate random numbers', 220, 40, 20, Color::lightGray());
        \Nawarian\Raylib\DrawText('Press ENTER to SAVE values', 250, 310, 20, Color::lightGray());
        \Nawarian\Raylib\DrawText('Press SPACE to LOAD values', 252, 350, 20, Color::lightGray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
