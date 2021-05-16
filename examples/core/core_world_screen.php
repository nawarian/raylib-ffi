<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{
    Camera3D,
    Color,
    Vector2,
    Vector3,
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [core] example - 3d camera free');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10, 10, 10),
    new Vector3(0, 0, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 0, 0);

$raylib->setCameraMode($camera, Camera3D::MODE_FREE); // Set a free camera mode

$raylib->setTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {      // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $raylib->UpdateCamera($camera);          // Update camera

    // Calculate cube screen space position (with a little offset to be in top)
    $cubeScreenPosition = $raylib->getWorldToScreen(
        new Vector3($cubePosition->x, $cubePosition->y + 2.5, $cubePosition->z),
        $camera,
    );
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

        $raylib->drawText(
            'Enemy: 100 / 100',
            (int) ($cubeScreenPosition->x - $raylib->measureText('Enemy: 100/100', 20) / 2),
            (int) $cubeScreenPosition->y,
            20,
            Color::black(),
        );
        $raylib->drawText(
            'Text is always on top of the cube',
            (int) (($screenWidth - $raylib->measureText('Text is always on top of the cube', 20)) / 2),
            25,
            20,
            Color::gray(),
        );

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
