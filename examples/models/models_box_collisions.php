<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{BoundingBox, Camera3D, Color, Vector3};

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [models] example - box collisions');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(0, 10, 10),
    new Vector3(0, 0, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);
$playerPosition = new Vector3(0, 1, 2);
$playerSize = new Vector3(1, 2, 1);

$enemyBoxPos = new Vector3(-4, 1, 0);
$enemyBoxSize = new Vector3(2, 2, 2);

$enemySpherePos = new Vector3(4, 0, 0);
$enemySphereSize = 1.5;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------

    // Move player
    if ($raylib->isKeyDown(Raylib::KEY_RIGHT)) {
        $playerPosition->x += 0.2;
    } elseif ($raylib->isKeyDown(Raylib::KEY_LEFT)) {
        $playerPosition->x -= 0.2;
    } elseif ($raylib->isKeyDown(Raylib::KEY_DOWN)) {
        $playerPosition->z += 0.2;
    } elseif ($raylib->isKeyDown(Raylib::KEY_UP)) {
        $playerPosition->z -= 0.2;
    }

    $collision = false;

    // Check collisions player vs enemy-box
    if (
        $raylib->checkCollisionBoxes(
            new BoundingBox(
                new Vector3(
                    $playerPosition->x - $playerSize->x / 2,
                    $playerPosition->y - $playerSize->y / 2,
                    $playerPosition->z - $playerSize->z / 2,
                ),
                new Vector3(
                    $playerPosition->x + $playerSize->x / 2,
                    $playerPosition->y + $playerSize->y / 2,
                    $playerPosition->z + $playerSize->z / 2,
                ),
            ),
            new BoundingBox(
                new Vector3(
                    $enemyBoxPos->x - $enemyBoxSize->x / 2,
                    $enemyBoxPos->y - $enemyBoxSize->y / 2,
                    $enemyBoxPos->z - $enemyBoxSize->z / 2,
                ),
                new Vector3(
                    $enemyBoxPos->x + $enemyBoxSize->x / 2,
                    $enemyBoxPos->y + $enemyBoxSize->y / 2,
                    $enemyBoxPos->z + $enemyBoxSize->z / 2,
                ),
            ),
        )
    ) {
        $collision = true;
    }

    // Check collisions player vs enemy-sphere
    if (
        $raylib->checkCollisionBoxSphere(
            new BoundingBox(
                new Vector3(
                    $playerPosition->x - $playerSize->x / 2,
                    $playerPosition->y - $playerSize->y / 2,
                    $playerPosition->z - $playerSize->z / 2,
                ),
                new Vector3(
                    $playerPosition->x + $playerSize->x / 2,
                    $playerPosition->y + $playerSize->y / 2,
                    $playerPosition->z + $playerSize->z / 2
                ),
            ),
            $enemySpherePos,
            $enemySphereSize
        )
    ) {
        $collision = true;
    }

    if ($collision) {
        $playerColor = Color::red();
    } else {
        $playerColor = Color::green();
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        $raylib->beginMode3D($camera);
            // Draw enemy-box
            $raylib->drawCube($enemyBoxPos, $enemyBoxSize->x, $enemyBoxSize->y, $enemyBoxSize->z, Color::gray());
            $raylib->drawCubeWires(
                $enemyBoxPos,
                $enemyBoxSize->x,
                $enemyBoxSize->y,
                $enemyBoxSize->z,
                Color::darkGray()
            );

            // Draw enemy-sphere
            $raylib->drawSphere($enemySpherePos, $enemySphereSize, Color::gray());
            $raylib->drawSphereWires($enemySpherePos, $enemySphereSize, 16, 16, Color::darkGray());

            // Draw player
            $raylib->drawCubeV($playerPosition, $playerSize, $playerColor);
            $raylib->drawGrid(10, 1.0);        // Draw a grid
        $raylib->endMode3D();

        $raylib->drawText('Move player with cursors to collide', 220, 40, 20, Color::gray());
        $raylib->drawFPS(10, 10);
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
