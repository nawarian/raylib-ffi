<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{
    BoundingBox,
    Camera3D,
    Color,
    Ray,
    Vector3,
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, "raylib [core] example - 3d picking");

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10.0, 10.0, 10.0),
    new Vector3(0.0, 0.0, 0.0),
    new Vector3(0.0, 1.0, 0.0),
    45.0,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$cubePosition = new Vector3(0, 1.0, 0);
$cubeSize = new Vector3(2.0, 2.0, 2.0);

$ray = new Ray(
    new Vector3(0, 0, 0),
    new Vector3(0, 0, 0),
);                   // Picking line ray

$collision = false;

\Nawarian\Raylib\SetCameraMode($camera, Camera3D::MODE_FREE); // Set a free camera mode

\Nawarian\Raylib\SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {       // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\UpdateCamera($camera);          // Update camera

    if (\Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        if (!$collision) {
            $ray = \Nawarian\Raylib\GetMouseRay(\Nawarian\Raylib\GetMousePosition(), $camera);

            // Check collision between ray and box
            $collision = \Nawarian\Raylib\CheckCollisionRayBox($ray, new BoundingBox(
                new Vector3(
                    $cubePosition->x - $cubeSize->x / 2,
                    $cubePosition->y - $cubeSize->y / 2,
                    $cubePosition->z - $cubeSize->z / 2,
                ),
                new Vector3(
                    $cubePosition->x + $cubeSize->x / 2,
                    $cubePosition->y + $cubeSize->y / 2,
                    $cubePosition->z + $cubeSize->z / 2,
                ),
            ));
        } else {
            $collision = false;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\BeginMode3D($camera);
            if ($collision) {
                \Nawarian\Raylib\DrawCube($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::red());
                \Nawarian\Raylib\DrawCubeWires($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::maroon());

                \Nawarian\Raylib\DrawCubeWires($cubePosition, $cubeSize->x + 0.2, $cubeSize->y + 0.2, $cubeSize->z + 0.2, Color::green());
            } else {
                \Nawarian\Raylib\DrawCube($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::gray());
                \Nawarian\Raylib\DrawCubeWires($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::darkGray());
            }

            \Nawarian\Raylib\DrawRay($ray, Color::maroon());
            \Nawarian\Raylib\DrawGrid(10, 1.0);
        \Nawarian\Raylib\EndMode3D();

        \Nawarian\Raylib\DrawText("Try selecting the box with mouse!", 240, 10, 20, Color::darkGray());

        if ($collision) {
            \Nawarian\Raylib\DrawText("BOX SELECTED", (int) (($screenWidth - \Nawarian\Raylib\MeasureText("BOX SELECTED", 30)) / 2), (int) ($screenHeight * 0.1), 30, Color::green());
        }

        \Nawarian\Raylib\DrawFPS(10, 10);

    \Nawarian\Raylib\EndDrawing();
    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
