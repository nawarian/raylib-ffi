<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\{
    Raylib,
    RaylibFactory,
};
use Nawarian\Raylib\Types\{
    Color,
    Vector2,
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->InitWindow($screenWidth, $screenHeight, "raylib [core] example - mouse input");

$ballColor = Color::darkBlue();

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//---------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $ballPosition = $raylib->getMousePosition();

    if ($raylib->isMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $ballColor = Color::maroon();
    } elseif ($raylib->isMouseButtonPressed(Raylib::MOUSE_MIDDLE_BUTTON)) {
        $ballColor = Color::lime();
    } elseif ($raylib->isMouseButtonPressed(Raylib::MOUSE_RIGHT_BUTTON)) {
        $ballColor = Color::darkBlue();
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawCircleV($ballPosition, 40, $ballColor);

        $raylib->drawText(
            "move ball with mouse and click mouse button to change color",
            10,
            10,
            20,
            Color::darkGray(),
        );

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
