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

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [audio] example - Multichannel sound playing');

$raylib->initAudioDevice();      // Initialize audio device

$fxWav = $raylib->loadSound(__DIR__ . 'resources/sound.wav');         // Load WAV audio file
$fxOgg = $raylib->loadSound(__DIR__ . 'resources/target.ogg');        // Load OGG audio file

$raylib->setSoundVolume($fxWav, 0.2);

$raylib->setTargetFPS(60);       // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isKeyPressed(Raylib::KEY_ENTER)) {
        // Play a new wav sound instance
        $raylib->playSoundMulti($fxWav);
    }

    if ($raylib->isKeyPressed(Raylib::KEY_SPACE)) {
        // Play a new ogg sound instance
        $raylib->playSoundMulti($fxOgg);
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawText('MULTICHANNEL SOUND PLAYING', 20, 20, 20, Color::gray());
        $raylib->drawText('Press SPACE to play new ogg instance!', 200, 120, 20, Color::lightGray());
        $raylib->drawText('Press ENTER to play new wav instance!', 200, 180, 20, Color::lightGray());

        $raylib->drawText(
            $raylib->textFormat('CONCURRENT SOUNDS PLAYING: %02d', $raylib->getSoundsPlaying()),
            220,
            280,
            20,
            Color::red(),
        );

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->stopSoundMulti();       // We must stop the buffer pool before unloading

$raylib->unloadSound($fxWav);     // Unload sound data
$raylib->unloadSound($fxOgg);     // Unload sound data

$raylib->closeAudioDevice();     // Close audio device

$raylib->closeWindow();          // Close window and OpenGL context
//--------------------------------------------------------------------------------------
