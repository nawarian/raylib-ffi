<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{BoundingBox, Camera3D, Color, Vector3};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [models] example - box collisions');

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

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------

    // Move player
    if (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_RIGHT)) {
        $playerPosition->x += 0.2;
    } elseif (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_LEFT)) {
        $playerPosition->x -= 0.2;
    } elseif (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_DOWN)) {
        $playerPosition->z += 0.2;
    } elseif (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_UP)) {
        $playerPosition->z -= 0.2;
    }

    $collision = false;

    // Check collisions player vs enemy-box
    if (
        \Nawarian\Raylib\CheckCollisionBoxes(new BoundingBox(
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
        ), new BoundingBox(
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
        ))
    ) {
        $collision = true;
    }

    // Check collisions player vs enemy-sphere
    if (
        \Nawarian\Raylib\CheckCollisionBoxSphere(new BoundingBox(
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
        ), $enemySpherePos, $enemySphereSize)
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
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\BeginMode3D($camera);
            // Draw enemy-box
            \Nawarian\Raylib\DrawCube($enemyBoxPos, $enemyBoxSize->x, $enemyBoxSize->y, $enemyBoxSize->z, Color::gray());
            \Nawarian\Raylib\DrawCubeWires($enemyBoxPos, $enemyBoxSize->x, $enemyBoxSize->y, $enemyBoxSize->z, Color::darkGray());

            // Draw enemy-sphere
            \Nawarian\Raylib\DrawSphere($enemySpherePos, $enemySphereSize, Color::gray());
            \Nawarian\Raylib\DrawSphereWires($enemySpherePos, $enemySphereSize, 16, 16, Color::darkGray());

            // Draw player
            \Nawarian\Raylib\DrawCubeV($playerPosition, $playerSize, $playerColor);
            \Nawarian\Raylib\DrawGrid(10, 1.0);        // Draw a grid
        \Nawarian\Raylib\EndMode3D();

        \Nawarian\Raylib\DrawText('Move player with cursors to collide', 220, 40, 20, Color::gray());
        \Nawarian\Raylib\DrawFPS(10, 10);
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
