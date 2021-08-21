<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

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
    DrawText,
    EndDrawing,
    EndMode3D,
    GetWorldToScreen,
    InitWindow,
    MeasureText,
    SetCameraMode,
    SetTargetFPS,
    UpdateCamera,
    WindowShouldClose
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [core] example - 3d camera free');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10, 10, 10),
    new Vector3(0, 0, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 0, 0);

SetCameraMode($camera, Camera3D::MODE_FREE); // Set a free camera mode

SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {      // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    UpdateCamera($camera);          // Update camera

    // Calculate cube screen space position (with a little offset to be in top)
    $cubeScreenPosition = GetWorldToScreen(
        new Vector3($cubePosition->x, $cubePosition->y + 2.5, $cubePosition->z),
        $camera
    );
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

        DrawText(
            'Enemy: 100 / 100',
            (int) ($cubeScreenPosition->x - MeasureText('Enemy: 100/100', 20) / 2),
            (int) $cubeScreenPosition->y,
            20,
            Color::black()
        );
        DrawText(
            'Text is always on top of the cube',
            (int) (($screenWidth - MeasureText('Text is always on top of the cube', 20)) / 2),
            25,
            20,
            Color::gray()
        );

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
