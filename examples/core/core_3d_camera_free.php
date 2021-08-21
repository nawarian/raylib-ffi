<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\{
    Raylib,
};
use Nawarian\Raylib\Types\{
    Camera3D,
    Color,
    Vector3,
};

const MAX_COLUMNS = 20;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, "raylib [core] example - 3d camera free");

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10.0, 10.0, 10.0),
    new Vector3(0.0, 0.0, 0.0),
    new Vector3(0.0, 1.0, 0.0),
    45.0,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 0, 0);

\Nawarian\Raylib\SetCameraMode($camera, Camera3D::MODE_FREE); // Set a free camera mode

\Nawarian\Raylib\SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {       // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\UpdateCamera($camera);          // Update camera

    if (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_Z)) {
        $camera->target = new Vector3(0, 0, 0);
    }
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

        \Nawarian\Raylib\DrawRectangle(10, 10, 320, 133, \Nawarian\Raylib\Fade(Color::skyBlue(), 0.5));
        \Nawarian\Raylib\DrawRectangleLines(10, 10, 320, 133, Color::blue());

        \Nawarian\Raylib\DrawText("Free camera default controls:", 20, 20, 10, Color::black());
        \Nawarian\Raylib\DrawText("- Mouse Wheel to Zoom in-out", 40, 40, 10, Color::darkGray());
        \Nawarian\Raylib\DrawText("- Mouse Wheel Pressed to Pan", 40, 60, 10, Color::darkGray());
        \Nawarian\Raylib\DrawText("- Alt + Mouse Wheel Pressed to Rotate", 40, 80, 10, Color::darkGray());
        \Nawarian\Raylib\DrawText("- Alt + Ctrl + Mouse Wheel Pressed for Smooth Zoom", 40, 100, 10, Color::darkGray());
        \Nawarian\Raylib\DrawText("- Z to zoom to (0, 0, 0)", 40, 120, 10, Color::darkGray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
