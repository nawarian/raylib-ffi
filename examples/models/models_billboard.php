<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Camera3D, Color, Vector3};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [models] example - drawing billboards');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(5, 4, 5),
    new Vector3(0, 2, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$bill = \Nawarian\Raylib\LoadTexture(__DIR__ . '/resources/billboard.png');     // Our texture billboard
$billPosition = new Vector3(0, 2, 0); // Position where draw billboard
\Nawarian\Raylib\SetCameraMode($camera, Camera3D::MODE_ORBITAL);  // Set an orbital camera mode

\Nawarian\Raylib\SetTargetFPS(60);                       // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {           // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\UpdateCamera($camera);              // Update camera
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\BeginMode3D($camera);

            \Nawarian\Raylib\DrawGrid(10, 1);        // Draw a grid

            \Nawarian\Raylib\DrawBillboard($camera, $bill, $billPosition, 2.0, Color::white());

        \Nawarian\Raylib\EndMode3D();

        \Nawarian\Raylib\DrawFPS(10, 10);

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($bill);        // Unload texture

\Nawarian\Raylib\CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
