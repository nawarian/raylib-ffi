<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawText,
    EndDrawing,
    GetRandomValue,
    InitWindow,
    IsKeyPressed,
    LoadStorageValue,
    SaveStorageValue,
    SetTargetFPS,
    TextFormat,
    WindowShouldClose
};

const STORAGE_POSITION_SCORE = 0;
const STORAGE_POSITION_HISCORE = 1;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [core] example - storage save/load values');

$score = 0;
$hiscore = 0;
$framesCounter = 0;

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (IsKeyPressed(Raylib::KEY_R)) {
        $score = GetRandomValue(1000, 2000);
        $hiscore = GetRandomValue(2000, 4000);
    }

    if (IsKeyPressed(Raylib::KEY_ENTER)) {
        SaveStorageValue(STORAGE_POSITION_SCORE, $score);
        SaveStorageValue(STORAGE_POSITION_HISCORE, $hiscore);
    } elseif (IsKeyPressed(Raylib::KEY_SPACE)) {
        // NOTE: If requested position could not be found, value 0 is returned
        $score = LoadStorageValue(STORAGE_POSITION_SCORE);
        $hiscore = LoadStorageValue(STORAGE_POSITION_HISCORE);
    }

    $framesCounter++;
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        DrawText(TextFormat('SCORE: %d', $score), 280, 130, 40, Color::maroon());
        DrawText(TextFormat('HI-SCORE: %d', $hiscore), 210, 200, 50, Color::black());

        DrawText(TextFormat('frames: %d', $framesCounter), 10, 10, 20, Color::lime());

        DrawText('Press R to generate random numbers', 220, 40, 20, Color::lightGray());
        DrawText('Press ENTER to SAVE values', 250, 310, 20, Color::lightGray());
        DrawText('Press SPACE to LOAD values', 252, 350, 20, Color::lightGray());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
