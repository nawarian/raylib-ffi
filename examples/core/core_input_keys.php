<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{
    Color,
    Vector2
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - keyboard input");
$ballPosition = new Vector2($screenWidth / 2, $screenHeight / 2);

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isKeyDown(Raylib::KEY_RIGHT)) {
        $ballPosition->x += 2.0;
    }

    if ($raylib->isKeyDown(Raylib::KEY_LEFT)) {
        $ballPosition->x -= 2.0;
    }

    if ($raylib->isKeyDown(Raylib::KEY_UP)) {
        $ballPosition->y -= 2.0;
    }

    if ($raylib->isKeyDown(Raylib::KEY_DOWN)) {
        $ballPosition->y += 2.0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawText("move the ball with arrow keys", 10, 10, 20, Color::darkGray());

        $raylib->drawCircleV($ballPosition, 50, Color::maroon());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
