<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//---------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [shapes] example - bouncing ball');

$ballPosition = new Vector2($raylib->getScreenWidth() / 2, $raylib->getScreenHeight() / 2);
$ballSpeed = new Vector2(5.0, 4.0);
$ballRadius = 20;

$pause = 0;
$framesCounter = 0;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//----------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //-----------------------------------------------------
    if ($raylib->isKeyPressed(Raylib::KEY_SPACE)) {
        $pause = !$pause;
    }

    if (!$pause) {
        $ballPosition->x += $ballSpeed->x;
        $ballPosition->y += $ballSpeed->y;

        // Check walls collision for bouncing
        if (($ballPosition->x >= ($raylib->getScreenWidth() - $ballRadius)) || ($ballPosition->x <= $ballRadius)) {
            $ballSpeed->x *= -1.0;
        }

        if (($ballPosition->y >= ($raylib->getScreenHeight() - $ballRadius)) || ($ballPosition->y <= $ballRadius)) {
            $ballSpeed->y *= -1.0;
        }
    } else {
        $framesCounter++;
    }
    //-----------------------------------------------------

    // Draw
    //-----------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        $raylib->drawCircleV($ballPosition, $ballRadius, Color::maroon());
        $raylib->drawText(
            'PRESS SPACE to PAUSE BALL MOVEMENT',
            10,
            $raylib->getScreenHeight() - 25,
            20,
            Color::lightGray(),
        );

        // On pause, we draw a blinking message
        if ($pause && (($framesCounter / 30) % 2)) {
            $raylib->drawText('PAUSED', 350, 200, 30, Color::gray());
        }

        $raylib->drawFPS(10, 10);
        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

    $raylib->endDrawing();
    //-----------------------------------------------------
}

// De-Initialization
//---------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//----------------------------------------------------------
