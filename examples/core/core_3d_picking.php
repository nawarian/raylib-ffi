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

use function Nawarian\Raylib\{
    BeginDrawing,
    BeginMode3D,
    CheckCollisionRayBox,
    ClearBackground,
    CloseWindow,
    DrawCube,
    DrawCubeWires,
    DrawFPS,
    DrawGrid,
    DrawRay,
    DrawText,
    EndDrawing,
    EndMode3D,
    GetMousePosition,
    GetMouseRay,
    InitWindow,
    IsMouseButtonPressed,
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

InitWindow($screenWidth, $screenHeight, "raylib [core] example - 3d picking");

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

SetCameraMode($camera, Camera3D::MODE_FREE); // Set a free camera mode

SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {       // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    UpdateCamera($camera);          // Update camera

    if (IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        if (!$collision) {
            $ray = GetMouseRay(GetMousePosition(), $camera);

            // Check collision between ray and box
            $collision = CheckCollisionRayBox($ray, new BoundingBox(
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
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        BeginMode3D($camera);
            if ($collision) {
                DrawCube($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::red());
                DrawCubeWires($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::maroon());

                DrawCubeWires(
                    $cubePosition,
                    $cubeSize->x + 0.2,
                    $cubeSize->y + 0.2,
                    $cubeSize->z + 0.2,
                    Color::green()
                );
            } else {
                DrawCube($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::gray());
                DrawCubeWires($cubePosition, $cubeSize->x, $cubeSize->y, $cubeSize->z, Color::darkGray());
            }

            DrawRay($ray, Color::maroon());
            DrawGrid(10, 1.0);
        EndMode3D();

        DrawText("Try selecting the box with mouse!", 240, 10, 20, Color::darkGray());

        if ($collision) {
            DrawText(
                "BOX SELECTED",
                (int) (($screenWidth - MeasureText("BOX SELECTED", 30)) / 2),
                (int) ($screenHeight * 0.1),
                30,
                Color::green()
            );
        }

        DrawFPS(10, 10);

    EndDrawing();
    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
