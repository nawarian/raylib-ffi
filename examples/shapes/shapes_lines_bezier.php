<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->setConfigFlags(Raylib::FLAG_MSAA_4X_HINT);
$raylib->initWindow($screenWidth, $screenHeight, 'raylib [shapes] example - cubic-bezier lines');

$start = new Vector2(0, 0);
$end = new Vector2($screenWidth, $screenHeight);

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON)) {
        $start = $raylib->getMousePosition();
    } elseif ($raylib->isMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
        $end = $raylib->getMousePosition();
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawText(
            'USE MOUSE LEFT-RIGHT CLICK to DEFINE LINE START and END POINTS',
            15,
            20,
            20,
            Color::gray(),
        );

        $raylib->drawLineBezier($start, $end, 2.0, Color::red());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
