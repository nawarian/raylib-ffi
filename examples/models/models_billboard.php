<?php

declare(strict_types=1);

use Nawarian\Raylib\Types\{Camera3D, Color, Vector3};

use function Nawarian\Raylib\{
    BeginDrawing,
    BeginMode3D,
    ClearBackground,
    CloseWindow,
    DrawBillboard,
    DrawFPS,
    DrawGrid,
    EndDrawing,
    EndMode3D,
    InitWindow,
    LoadTexture,
    SetCameraMode,
    SetTargetFPS,
    UnloadTexture,
    UpdateCamera,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [models] example - drawing billboards');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(5, 4, 5),
    new Vector3(0, 2, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$bill = LoadTexture(__DIR__ . '/resources/billboard.png');     // Our texture billboard
$billPosition = new Vector3(0, 2, 0); // Position where draw billboard
SetCameraMode($camera, Camera3D::MODE_ORBITAL);  // Set an orbital camera mode

SetTargetFPS(60);                       // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {           // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    UpdateCamera($camera);              // Update camera
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        BeginMode3D($camera);

            DrawGrid(10, 1);        // Draw a grid

            DrawBillboard($camera, $bill, $billPosition, 2.0, Color::white());

        EndMode3D();

        DrawFPS(10, 10);

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($bill);        // Unload texture

CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
