<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{
    Camera3D,
    Color,
    Vector3,
};

use function Nawarian\Raylib\{
    BeginDrawing,
    BeginMode3D,
    ClearBackground,
    CloseWindow,
    DrawCube,
    DrawCubeWires,
    DrawGrid,
    DrawRectangle,
    DrawRectangleLines,
    DrawText,
    EndDrawing,
    EndMode3D,
    Fade,
    InitWindow,
    IsKeyDown,
    SetCameraMode,
    SetTargetFPS,
    UpdateCamera,
    WindowShouldClose
};

const MAX_COLUMNS = 20;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, "raylib [core] example - 3d camera free");

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10.0, 10.0, 10.0),
    new Vector3(0.0, 0.0, 0.0),
    new Vector3(0.0, 1.0, 0.0),
    45.0,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 0, 0);

SetCameraMode($camera, Camera3D::MODE_FREE); // Set a free camera mode

SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {       // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    UpdateCamera($camera);          // Update camera

    if (IsKeyDown(Raylib::KEY_Z)) {
        $camera->target = new Vector3(0, 0, 0);
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        BeginMode3D($camera);

            DrawCube($cubePosition, 2.0, 2.0, 2.0, Color::red());
            DrawCubeWires($cubePosition, 2.0, 2.0, 2.0, Color::maroon());

            DrawGrid(10, 1.0);

        EndMode3D();

        DrawRectangle(10, 10, 320, 133, Fade(Color::skyBlue(), 0.5));
        DrawRectangleLines(10, 10, 320, 133, Color::blue());

        DrawText("Free camera default controls:", 20, 20, 10, Color::black());
        DrawText("- Mouse Wheel to Zoom in-out", 40, 40, 10, Color::darkGray());
        DrawText("- Mouse Wheel Pressed to Pan", 40, 60, 10, Color::darkGray());
        DrawText("- Alt + Mouse Wheel Pressed to Rotate", 40, 80, 10, Color::darkGray());
        DrawText("- Alt + Ctrl + Mouse Wheel Pressed for Smooth Zoom", 40, 100, 10, Color::darkGray());
        DrawText("- Z to zoom to (0, 0, 0)", 40, 120, 10, Color::darkGray());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
