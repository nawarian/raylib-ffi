<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [core] example - generate random values');

// Variable used to count frames
$framesCounter = 0;

// Get a random integer number between -8 and 5 (both included)
$randValue = $raylib->getRandomValue(-8, 5);

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) { // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $framesCounter++;

    // Every two seconds (120 frames) a new random value is generated
    if ((($framesCounter / 120) % 2) == 1) {
        $randValue = $raylib->getRandomValue(-8, 5);
        $framesCounter = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawText('Every 2 seconds a new random value is generated:', 130, 100, 20, Color::maroon());

        $raylib->drawText($raylib->textFormat('%d', $randValue), 360, 180, 80, Color::lightGray());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
