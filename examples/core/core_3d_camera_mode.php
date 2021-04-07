<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{
    Camera3D,
    Color,
    Vector3
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - 3d camera mode");

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10.0, 10.0, 10.0),
    new Vector3(0.0, 0.0, 0.0),
    new Vector3(0.0, 1.0, 0.0),
    45.0,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 0, 0);

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // TODO: Update your variables here
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

    $raylib->drawText("Welcome to the third dimension!", 10, 40, 20, Color::darkGray());
    $raylib->drawFPS(10, 10);

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
