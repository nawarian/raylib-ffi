<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{BoundingBox, Camera3D, Color, Ray, Vector3};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - 3d picking");

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10.0, 10.0, 10.0),
    new Vector3(0.0, 0.0, 0.0),
    new Vector3(0.0, 1.0, 0.0),
    45.0,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 1.0, 0);
$cubeSize = new Vector3(2.0, 2.0, 2.0);

$ray = new Ray(
    new Vector3(0, 0, 0),
    new Vector3(0, 0, 0),
);                   // Picking line ray

$collision = false;

$raylib->setCameraMode($camera, Camera3D::MODE_FREE); // Set a free camera mode

$raylib->setTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {       // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $raylib->UpdateCamera($camera);          // Update camera

    if ($raylib->isMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        if (!$collision) {
            $ray = $raylib->getMouseRay($raylib->getMousePosition(), $camera);

            // Check collision between ray and box
            $collision = $raylib->checkCollisionRayBox(
                $ray,
                new BoundingBox(
                    new Vector3(
                        $cubePosition->x - $cubeSize->x / 2,
                        $cubePosition->y - $cubeSize->y / 2,
                        $cubePosition->z - $cubeSize->z / 2,
                    ),
                    new Vector3(
                        $cubePosition->x + $cubeSize->x / 2,
                        $cubePosition->y + $cubeSize->y / 2,
                        $cubePosition->z + $cubeSize->z / 2,
                    ),
                ),
            );
        } else {
            $collision = false;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        $raylib->beginMode3D($camera);
            if ($collision) {
                $raylib->drawCube($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::red());
                $raylib->drawCubeWires($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::maroon());

                $raylib->drawCubeWires(
                    $cubePosition,
                    $cubeSize->x + 0.2,
                    $cubeSize->y + 0.2,
                    $cubeSize->z + 0.2,
                    Color::green(),
                );
            } else {
                $raylib->drawCube($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::gray());
                $raylib->drawCubeWires($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::darkGray());
            }

            $raylib->drawRay($ray, Color::maroon());
            $raylib->drawGrid(10, 1.0);
        $raylib->endMode3D();

        $raylib->drawText("Try selecting the box with mouse!", 240, 10, 20, Color::darkGray());

        if ($collision) {
            $raylib->drawText(
                "BOX SELECTED",
                (int) (($screenWidth - $raylib->measureText("BOX SELECTED", 30)) / 2),
                (int) ($screenHeight * 0.1),
                30,
                Color::green(),
            );
        }

        $raylib->drawFPS(10, 10);

    $raylib->endDrawing();
    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
