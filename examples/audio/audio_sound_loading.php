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

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [audio] example - sound loading and playing');

$raylib->initAudioDevice();      // Initialize audio device

$fxWav = $raylib->loadSound(__DIR__ . '/resources/sound.wav');         // Load WAV audio file
$fxOgg = $raylib->loadSound(__DIR__ . '/resources/target.ogg');        // Load OGG audio file

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isKeyPressed(Raylib::KEY_SPACE)) {
        $raylib->playSound($fxWav);      // Play WAV sound
    }

    if ($raylib->isKeyPressed(Raylib::KEY_ENTER)) {
        $raylib->playSound($fxOgg);      // Play OGG sound
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawText('Press SPACE to PLAY the WAV sound!', 200, 180, 20, Color::lightGray());
        $raylib->drawText('Press ENTER to PLAY the OGG sound!', 200, 220, 20, Color::lightGray());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadSound($fxWav);     // Unload sound data
$raylib->unloadSound($fxOgg);     // Unload sound data

$raylib->closeAudioDevice();     // Close audio device

$raylib->closeWindow();          // Close window and OpenGL context
//--------------------------------------------------------------------------------------
