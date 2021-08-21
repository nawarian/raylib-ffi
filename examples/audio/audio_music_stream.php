<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseAudioDevice,
    CloseWindow,
    DrawRectangle,
    DrawRectangleLines,
    DrawText,
    EndDrawing,
    GetMusicTimeLength,
    GetMusicTimePlayed,
    InitAudioDevice,
    InitWindow,
    IsKeyPressed,
    LoadMusicStream,
    PauseMusicStream,
    PlayMusicStream,
    ResumeMusicStream,
    SetTargetFPS,
    StopMusicStream,
    UnloadMusicStream,
    UpdateMusicStream,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [audio] example - music playing (streaming)');

InitAudioDevice();              // Initialize audio device

$music = LoadMusicStream(__DIR__ . '/resources/country.mp3');

PlayMusicStream($music);

$pause = false;

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    UpdateMusicStream($music);   // Update music buffer with new stream data

    // Restart music playing (stop and play)
    if (IsKeyPressed(Raylib::KEY_SPACE)) {
        StopMusicStream($music);
        PlayMusicStream($music);
    }

    // Pause/Resume music playing
    if (IsKeyPressed(Raylib::KEY_P)) {
        $pause = !$pause;

        if ($pause) {
            PauseMusicStream($music);
        } else {
            ResumeMusicStream($music);
        }
    }

    // Get timePlayed scaled to bar dimensions (400 pixels)
    $timePlayed = GetMusicTimePlayed($music) / GetMusicTimeLength($music) * 400;

    if ($timePlayed > 400) {
        StopMusicStream($music);
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        DrawText('MUSIC SHOULD BE PLAYING!', 255, 150, 20, Color::lightGray());

        DrawRectangle(200, 200, 400, 12, Color::lightGray());
        DrawRectangle(200, 200, (int) $timePlayed, 12, Color::maroon());
        DrawRectangleLines(200, 200, 400, 12, Color::gray());

        DrawText('PRESS SPACE TO RESTART MUSIC', 215, 250, 20, Color::lightGray());
        DrawText('PRESS P TO PAUSE/RESUME MUSIC', 208, 280, 20, Color::lightGray());
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadMusicStream($music);   // Unload music stream buffers from RAM

CloseAudioDevice();         // Close audio device (music streaming is automatically stopped)

CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
