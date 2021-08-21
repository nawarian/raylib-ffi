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
    GetSoundsPlaying,
    InitAudioDevice,
    InitWindow,
    IsKeyPressed,
    LoadSound,
    PlaySoundMulti,
    SetSoundVolume,
    SetTargetFPS,
    StopSoundMulti,
    TextFormat,
    UnloadSound,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [audio] example - Multichannel sound playing');

InitAudioDevice();      // Initialize audio device

$fxWav = LoadSound(__DIR__ . '/resources/sound.wav');         // Load WAV audio file
$fxOgg = LoadSound(__DIR__ . '/resources/target.ogg');        // Load OGG audio file

SetSoundVolume($fxWav, 0.2);

SetTargetFPS(60);       // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (IsKeyPressed(Raylib::KEY_ENTER)) {
        // Play a new wav sound instance
        PlaySoundMulti($fxWav);
    }

    if (IsKeyPressed(Raylib::KEY_SPACE)) {
        // Play a new ogg sound instance
        PlaySoundMulti($fxOgg);
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        DrawText('MULTICHANNEL SOUND PLAYING', 20, 20, 20, Color::gray());
        DrawText('Press SPACE to play new ogg instance!', 200, 120, 20, Color::lightGray());
        DrawText('Press ENTER to play new wav instance!', 200, 180, 20, Color::lightGray());

        DrawText(TextFormat('CONCURRENT SOUNDS PLAYING: %02d', GetSoundsPlaying()), 220, 280, 20, Color::red());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
StopSoundMulti();       // We must stop the buffer pool before unloading

UnloadSound($fxWav);     // Unload sound data
UnloadSound($fxOgg);     // Unload sound data

CloseAudioDevice();     // Close audio device

CloseWindow();          // Close window and OpenGL context
//--------------------------------------------------------------------------------------
