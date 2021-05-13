<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\{
    Raylib,
    RaylibFactory,
};
use Nawarian\Raylib\Types\Color;

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const STORAGE_POSITION_SCORE = 0;
const STORAGE_POSITION_HISCORE = 1;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [core] example - storage save/load values');

$score = 0;
$hiscore = 0;
$framesCounter = 0;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isKeyPressed(Raylib::KEY_R)) {
        $score = $raylib->getRandomValue(1000, 2000);
        $hiscore = $raylib->getRandomValue(2000, 4000);
    }

    if ($raylib->isKeyPressed(Raylib::KEY_ENTER)) {
        $raylib->saveStorageValue(STORAGE_POSITION_SCORE, $score);
        $raylib->saveStorageValue(STORAGE_POSITION_HISCORE, $hiscore);
    } elseif ($raylib->isKeyPressed(Raylib::KEY_SPACE)) {
        // NOTE: If requested position could not be found, value 0 is returned
        $score = $raylib->loadStorageValue(STORAGE_POSITION_SCORE);
        $hiscore = $raylib->loadStorageValue(STORAGE_POSITION_HISCORE);
    }

    $framesCounter++;
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawText($raylib->textFormat('SCORE: %d', $score), 280, 130, 40, Color::maroon());
        $raylib->drawText($raylib->textFormat('HI-SCORE: %d', $hiscore), 210, 200, 50, Color::black());

        $raylib->drawText($raylib->textFormat('frames: %d', $framesCounter), 10, 10, 20, Color::lime());

        $raylib->drawText('Press R to generate random numbers', 220, 40, 20, Color::lightGray());
        $raylib->drawText('Press ENTER to SAVE values', 250, 310, 20, Color::lightGray());
        $raylib->drawText('Press SPACE to LOAD values', 252, 350, 20, Color::lightGray());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
