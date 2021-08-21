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

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, "raylib [core] example - 3d camera mode");

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10.0, 10.0, 10.0),
    new Vector3(0.0, 0.0, 0.0),
    new Vector3(0.0, 1.0, 0.0),
    45.0,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 0, 0);

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // TODO: Update your variables here
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

    \Nawarian\Raylib\DrawText("Welcome to the third dimension!", 10, 40, 20, Color::darkGray());
    \Nawarian\Raylib\DrawFPS(10, 10);

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
