<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/easings.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [shapes] example - easings box anim');

// Box variables to be animated with easings
$rec = new Rectangle($raylib->getScreenWidth() / 2, -100, 100, 100);
$rotation = 0.0;
$alpha = 1.0;

$state = 0;
$framesCounter = 0;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    switch ($state) {
        case 0:     // Move box down to center of screen
            $framesCounter++;

            // NOTE: Remember that 3rd parameter of easing function refers to
            // desired value variation, do not confuse it with expected final value!
            $rec->y = easeElasticOut($framesCounter, -100, $raylib->getScreenHeight() / 2 + 100, 120);

            if ($framesCounter >= 120) {
                $framesCounter = 0;
                $state = 1;
            }
            break;
        case 1:     // Scale box to an horizontal bar
            $framesCounter++;
            $rec->height = easeBounceOut($framesCounter, 100, -90, 120);
            $rec->width = easeBounceOut($framesCounter, 100, $raylib->getScreenWidth(), 120);

            if ($framesCounter >= 120) {
                $framesCounter = 0;
                $state = 2;
            }
            break;
        case 2:     // Rotate horizontal bar rectangle
            $framesCounter++;
            $rotation = easeQuadOut($framesCounter, 0.0, 270.0, 240);

            if ($framesCounter >= 240) {
                $framesCounter = 0;
                $state = 3;
            }
            break;
        case 3:     // Increase bar size to fill all screen
            $framesCounter++;
            $rec->height = easeCircOut($framesCounter, 10, $raylib->getScreenWidth(), 120);

            if ($framesCounter >= 120) {
                $framesCounter = 0;
                $state = 4;
            }
            break;
        case 4:     // Fade out animation
            $framesCounter++;
            $alpha = easeSineOut($framesCounter, 1.0, -1.0, 160);

            if ($framesCounter >= 160) {
                $framesCounter = 0;
                $state = 5;
            }
            break;
    }

    // Reset animation at any moment
    if ($raylib->isKeyPressed(Raylib::KEY_SPACE)) {
        $rec = new Rectangle($raylib->getScreenWidth() / 2, -100, 100, 100);
        $rotation = 0.0;
        $alpha = 1.0;
        $state = 0;
        $framesCounter = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawRectanglePro(
            $rec,
            new Vector2($rec->width / 2, $rec->height / 2),
            $rotation,
            $raylib->fade(Color::black(), $alpha),
        );

        $raylib->drawText(
            'PRESS [SPACE] TO RESET BOX ANIMATION!',
            10,
            $raylib->getScreenHeight() - 25,
            20,
            Color::lightGray(),
        );

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
