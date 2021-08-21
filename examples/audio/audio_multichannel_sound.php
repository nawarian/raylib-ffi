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

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [audio] example - Multichannel sound playing');

\Nawarian\Raylib\InitAudioDevice();      // Initialize audio device

$fxWav = \Nawarian\Raylib\LoadSound(__DIR__ . '/resources/sound.wav');         // Load WAV audio file
$fxOgg = \Nawarian\Raylib\LoadSound(__DIR__ . '/resources/target.ogg');        // Load OGG audio file

\Nawarian\Raylib\SetSoundVolume($fxWav, 0.2);

\Nawarian\Raylib\SetTargetFPS(60);       // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_ENTER)) {
        // Play a new wav sound instance
        \Nawarian\Raylib\PlaySoundMulti($fxWav);
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        // Play a new ogg sound instance
        \Nawarian\Raylib\PlaySoundMulti($fxOgg);
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawText('MULTICHANNEL SOUND PLAYING', 20, 20, 20, Color::gray());
        \Nawarian\Raylib\DrawText('Press SPACE to play new ogg instance!', 200, 120, 20, Color::lightGray());
        \Nawarian\Raylib\DrawText('Press ENTER to play new wav instance!', 200, 180, 20, Color::lightGray());

        \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextFormat('CONCURRENT SOUNDS PLAYING: %02d', \Nawarian\Raylib\GetSoundsPlaying()), 220, 280, 20, Color::red());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\StopSoundMulti();       // We must stop the buffer pool before unloading

\Nawarian\Raylib\UnloadSound($fxWav);     // Unload sound data
\Nawarian\Raylib\UnloadSound($fxOgg);     // Unload sound data

\Nawarian\Raylib\CloseAudioDevice();     // Close audio device

\Nawarian\Raylib\CloseWindow();          // Close window and OpenGL context
//--------------------------------------------------------------------------------------
