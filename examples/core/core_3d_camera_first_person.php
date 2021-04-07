<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{
    Camera3D,
    Color,
    Vector2,
    Vector3
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const MAX_COLUMNS = 20;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - 3d camera first person");

// Define the camera to look into our 3d world (position, target, up vector)
$camera = new Camera3D(
    new Vector3(4.0, 2.0, 4.0),
    new Vector3(0.0, 1.8, 0.0),
    new Vector3(0.0, 1.0, 0.0),
    60.0,
    Camera3D::PROJECTION_PERSPECTIVE,
);

// Generates some random columns
$heights = [];
$positions = [];
$colors = [];

for ($i = 0; $i < MAX_COLUMNS; $i++) {
    $heights[$i] = (float) $raylib->getRandomValue(1, 12);
    $positions[$i] = new Vector3(
        $raylib->getRandomValue(-15, 15),
        $heights[$i] / 2.0,
        $raylib->getRandomValue(-15, 15),
    );

    $colors[$i] = new Color($raylib->getRandomValue(20, 255), $raylib->getRandomValue(10, 55), 30, 255);
}

$raylib->setCameraMode($camera, Camera3D::MODE_FIRST_PERSON); // Set a first person camera mode

$raylib->setTargetFPS(60);                           // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {               // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $raylib->updateCamera($camera);                  // Update camera
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        $raylib->beginMode3D($camera);

            $raylib->drawPlane(
                new Vector3(0.0, 0.0, 0.0),
                new Vector2(32.0, 32.0),
                Color::lightGray()
            ); // Draw ground
            $raylib->drawCube(new Vector3(-16.0, 2.5, 0.0), 1.0, 5.0, 32.0, Color::blue());     // Draw a blue wall
            $raylib->drawCube(new Vector3(16.0, 2.5, 0.0), 1.0, 5.0, 32.0, Color::lime());      // Draw a green wall
            $raylib->drawCube(new Vector3(0.0, 2.5, 16.0), 32.0, 5.0, 1.0, Color::gold());      // Draw a yellow wall

            // Draw some cubes around
            for ($i = 0; $i < MAX_COLUMNS; $i++) {
                $raylib->drawCube($positions[$i], 2.0, $heights[$i], 2.0, $colors[$i]);
                $raylib->drawCubeWires($positions[$i], 2.0, $heights[$i], 2.0, Color::maroon());
            }

        $raylib->endMode3D();
        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        $raylib->drawRectangle(10, 10, 220, 70, $raylib->fade(Color::skyBlue(), 0.5));
        $raylib->drawRectangleLines(10, 10, 220, 70, Color::blue());

        $raylib->drawText("First person camera default controls:", 20, 20, 10, Color::black());
        $raylib->drawText("- Move with keys: W, A, S, D", 40, 40, 10, Color::darkGray());
        $raylib->drawText("- Mouse move to look around", 40, 60, 10, Color::darkGray());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
