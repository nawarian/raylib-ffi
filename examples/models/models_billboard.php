<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Camera3D, Color, Vector3};

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [models] example - drawing billboards');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(5, 4, 5),
    new Vector3(0, 2, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$bill = $raylib->loadTexture(__DIR__ . '/resources/billboard.png');     // Our texture billboard
$billPosition = new Vector3(0, 2, 0); // Position where draw billboard
$raylib->setCameraMode($camera, Camera3D::MODE_ORBITAL);  // Set an orbital camera mode

$raylib->setTargetFPS(60);                       // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {           // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $raylib->updateCamera($camera);              // Update camera
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        $raylib->beginMode3D($camera);

            $raylib->drawGrid(10, 1);        // Draw a grid

            $raylib->drawBillboard($camera, $bill, $billPosition, 2.0, Color::white());

        $raylib->endMode3D();

        $raylib->drawFPS(10, 10);

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($bill);        // Unload texture

$raylib->closeWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
