<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\{
    Raylib,
    RaylibFactory,
};
use Nawarian\Raylib\Types\{
    Camera3D,
    Color,
    Vector3,
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const MAX_COLUMNS = 20;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - 3d camera free");

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10.0, 10.0, 10.0),
    new Vector3(0.0, 0.0, 0.0),
    new Vector3(0.0, 1.0, 0.0),
    45.0,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 0, 0);

$raylib->setCameraMode($camera, Camera3D::MODE_FREE); // Set a free camera mode

$raylib->setTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {       // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $raylib->updateCamera($camera);          // Update camera

    if ($raylib->isKeyDown(Raylib::KEY_Z)) {
        $camera->target = new Vector3(0, 0, 0);
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->beginMode3D($camera);

            $raylib->drawCube($cubePosition, 2.0, 2.0, 2.0, Color::red());
            $raylib->drawCubeWires($cubePosition, 2.0, 2.0, 2.0, Color::maroon());

            $raylib->drawGrid(10, 1.0);

        $raylib->endMode3D();

        $raylib->drawRectangle(10, 10, 320, 133, $raylib->fade(Color::skyBlue(), 0.5));
        $raylib->drawRectangleLines(10, 10, 320, 133, Color::blue());

        $raylib->drawText("Free camera default controls:", 20, 20, 10, Color::black());
        $raylib->drawText("- Mouse Wheel to Zoom in-out", 40, 40, 10, Color::darkGray());
        $raylib->drawText("- Mouse Wheel Pressed to Pan", 40, 60, 10, Color::darkGray());
        $raylib->drawText("- Alt + Mouse Wheel Pressed to Rotate", 40, 80, 10, Color::darkGray());
        $raylib->drawText("- Alt + Ctrl + Mouse Wheel Pressed for Smooth Zoom", 40, 100, 10, Color::darkGray());
        $raylib->drawText("- Z to zoom to (0, 0, 0)", 40, 120, 10, Color::darkGray());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
