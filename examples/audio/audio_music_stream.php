<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [audio] example - music playing (streaming)');

$raylib->initAudioDevice();              // Initialize audio device

$music = $raylib->loadMusicStream(__DIR__ . '/resources/country.mp3');

$raylib->playMusicStream($music);

$timePlayed = 0.0;
$pause = false;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $raylib->updateMusicStream($music);   // Update music buffer with new stream data

    // Restart music playing (stop and play)
    if ($raylib->isKeyPressed(Raylib::KEY_SPACE)) {
        $raylib->stopMusicStream($music);
        $raylib->playMusicStream($music);
    }

    // Pause/Resume music playing
    if ($raylib->isKeyPressed(Raylib::KEY_P)) {
        $pause = !$pause;

        if ($pause) {
            $raylib->pauseMusicStream($music);
        } else {
            $raylib->resumeMusicStream($music);
        }
    }

    // Get timePlayed scaled to bar dimensions (400 pixels)
    $timePlayed = $raylib->getMusicTimePlayed($music) / $raylib->getMusicTimeLength($music) * 400;

    if ($timePlayed > 400) {
        $raylib->stopMusicStream($music);
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

    $raylib->clearBackground(Color::rayWhite());

    $raylib->drawText('MUSIC SHOULD BE PLAYING!', 255, 150, 20, Color::lightGray());

    $raylib->drawRectangle(200, 200, 400, 12, Color::lightGray());
    $raylib->drawRectangle(200, 200, (int) $timePlayed, 12, Color::maroon());
    $raylib->drawRectangleLines(200, 200, 400, 12, Color::gray());

    $raylib->drawText('PRESS SPACE TO RESTART MUSIC', 215, 250, 20, Color::lightGray());
    $raylib->drawText('PRESS P TO PAUSE/RESUME MUSIC', 208, 280, 20, Color::lightGray());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadMusicStream($music);   // Unload music stream buffers from RAM

$raylib->closeAudioDevice();         // Close audio device (music streaming is automatically stopped)

$raylib->closeWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
