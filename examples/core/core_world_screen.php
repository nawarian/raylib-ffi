<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Types\{
    Camera3D,
    Color,
    Vector3,
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [core] example - 3d camera free');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10, 10, 10),
    new Vector3(0, 0, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 0, 0);

\Nawarian\Raylib\SetCameraMode($camera, Camera3D::MODE_FREE); // Set a free camera mode

\Nawarian\Raylib\SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {      // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\UpdateCamera($camera);          // Update camera

    // Calculate cube screen space position (with a little offset to be in top)
    $cubeScreenPosition = \Nawarian\Raylib\GetWorldToScreen(new Vector3($cubePosition->x, $cubePosition->y + 2.5, $cubePosition->z), $camera);
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\BeginMode3D($camera);

            \Nawarian\Raylib\DrawCube($cubePosition, 2.0, 2.0, 2.0, Color::red());
            \Nawarian\Raylib\DrawCubeWires($cubePosition, 2.0, 2.0, 2.0, Color::maroon());

            \Nawarian\Raylib\DrawGrid(10, 1.0);

        \Nawarian\Raylib\EndMode3D();

        \Nawarian\Raylib\DrawText('Enemy: 100 / 100', (int) ($cubeScreenPosition->x - \Nawarian\Raylib\MeasureText('Enemy: 100/100', 20) / 2), (int) $cubeScreenPosition->y, 20, Color::black());
        \Nawarian\Raylib\DrawText('Text is always on top of the cube', (int) (($screenWidth - \Nawarian\Raylib\MeasureText('Text is always on top of the cube', 20)) / 2), 25, 20, Color::gray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
