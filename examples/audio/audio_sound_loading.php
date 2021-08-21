<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseAudioDevice,
    CloseWindow,
    DrawText,
    EndDrawing,
    InitAudioDevice,
    InitWindow,
    IsKeyPressed,
    LoadSound,
    PlaySound,
    SetTargetFPS,
    UnloadSound,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [audio] example - sound loading and playing');

InitAudioDevice();      // Initialize audio device

$fxWav = LoadSound(__DIR__ . '/resources/sound.wav');         // Load WAV audio file
$fxOgg = LoadSound(__DIR__ . '/resources/target.ogg');        // Load OGG audio file

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (IsKeyPressed(Raylib::KEY_SPACE)) {
        PlaySound($fxWav);      // Play WAV sound
    }

    if (IsKeyPressed(Raylib::KEY_ENTER)) {
        PlaySound($fxOgg);      // Play OGG sound
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        DrawText('Press SPACE to PLAY the WAV sound!', 200, 180, 20, Color::lightGray());
        DrawText('Press ENTER to PLAY the OGG sound!', 200, 220, 20, Color::lightGray());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadSound($fxWav);     // Unload sound data
UnloadSound($fxOgg);     // Unload sound data

CloseAudioDevice();     // Close audio device

CloseWindow();          // Close window and OpenGL context
//--------------------------------------------------------------------------------------
