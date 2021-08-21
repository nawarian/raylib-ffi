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

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [audio] example - music playing (streaming)');

\Nawarian\Raylib\InitAudioDevice();              // Initialize audio device

$music = \Nawarian\Raylib\LoadMusicStream(__DIR__ . '/resources/country.mp3');

\Nawarian\Raylib\PlayMusicStream($music);

$pause = false;

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\UpdateMusicStream($music);   // Update music buffer with new stream data

    // Restart music playing (stop and play)
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        \Nawarian\Raylib\StopMusicStream($music);
        \Nawarian\Raylib\PlayMusicStream($music);
    }

    // Pause/Resume music playing
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_P)) {
        $pause = !$pause;

        if ($pause) {
            \Nawarian\Raylib\PauseMusicStream($music);
        } else {
            \Nawarian\Raylib\ResumeMusicStream($music);
        }
    }

    // Get timePlayed scaled to bar dimensions (400 pixels)
    $timePlayed = \Nawarian\Raylib\GetMusicTimePlayed($music) / \Nawarian\Raylib\GetMusicTimeLength($music) * 400;

    if ($timePlayed > 400) {
        \Nawarian\Raylib\StopMusicStream($music);
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

    \Nawarian\Raylib\ClearBackground(Color::rayWhite());

    \Nawarian\Raylib\DrawText('MUSIC SHOULD BE PLAYING!', 255, 150, 20, Color::lightGray());

    \Nawarian\Raylib\DrawRectangle(200, 200, 400, 12, Color::lightGray());
    \Nawarian\Raylib\DrawRectangle(200, 200, (int) $timePlayed, 12, Color::maroon());
    \Nawarian\Raylib\DrawRectangleLines(200, 200, 400, 12, Color::gray());

    \Nawarian\Raylib\DrawText('PRESS SPACE TO RESTART MUSIC', 215, 250, 20, Color::lightGray());
    \Nawarian\Raylib\DrawText('PRESS P TO PAUSE/RESUME MUSIC', 208, 280, 20, Color::lightGray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadMusicStream($music);   // Unload music stream buffers from RAM

\Nawarian\Raylib\CloseAudioDevice();         // Close audio device (music streaming is automatically stopped)

\Nawarian\Raylib\CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
