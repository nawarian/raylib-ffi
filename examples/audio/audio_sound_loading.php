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

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [audio] example - sound loading and playing');

\Nawarian\Raylib\InitAudioDevice();      // Initialize audio device

$fxWav = \Nawarian\Raylib\LoadSound(__DIR__ . '/resources/sound.wav');         // Load WAV audio file
$fxOgg = \Nawarian\Raylib\LoadSound(__DIR__ . '/resources/target.ogg');        // Load OGG audio file

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        \Nawarian\Raylib\PlaySound($fxWav);      // Play WAV sound
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_ENTER)) {
        \Nawarian\Raylib\PlaySound($fxOgg);      // Play OGG sound
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawText('Press SPACE to PLAY the WAV sound!', 200, 180, 20, Color::lightGray());
        \Nawarian\Raylib\DrawText('Press ENTER to PLAY the OGG sound!', 200, 220, 20, Color::lightGray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadSound($fxWav);     // Unload sound data
\Nawarian\Raylib\UnloadSound($fxOgg);     // Unload sound data

\Nawarian\Raylib\CloseAudioDevice();     // Close audio device

\Nawarian\Raylib\CloseWindow();          // Close window and OpenGL context
//--------------------------------------------------------------------------------------
