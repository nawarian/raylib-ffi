<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Camera3D, Color, Vector3};

use function Nawarian\Raylib\{
    BeginDrawing,
    BeginMode3D,
    ClearBackground,
    CloseWindow,
    DrawCube,
    DrawGrid,
    DrawModelEx,
    DrawText,
    EndDrawing,
    EndMode3D,
    InitWindow,
    IsKeyDown,
    LoadModel,
    LoadModelAnimations,
    LoadTexture,
    SetCameraMode,
    SetMaterialTexture,
    SetTargetFPS,
    UnloadModel,
    UnloadModelAnimation,
    UnloadTexture,
    UpdateCamera,
    UpdateModelAnimation,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [models] example - model animation');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10, 10, 10),
    new Vector3(0, 0, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$model = LoadModel(__DIR__ . '/resources/guy/guy.iqm'); // Load the animated model mesh and basic data
$texture = LoadTexture(__DIR__ . '/resources/guy/guytex.png'); // Load model texture and set material

/**
 * @psalm-suppress UndefinedMethod
 * @psalm-suppress MixedArgument
 */
SetMaterialTexture($model->materials[0], Raylib::MAP_DIFFUSE, $texture);  // Set model material map texture
$position = new Vector3(0, 0, 0);            // Set model position

// Load animation data
$animsCount = 0;
/** @var \FFI\CData&\ArrayAccess<int, \FFI\CData> $anims */
$anims = LoadModelAnimations(__DIR__ . '/resources/guy/guyanim.iqm', $animsCount);
$animFrameCounter = 0;

SetCameraMode($camera, Camera3D::MODE_FREE); // Set free camera mode

SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {      // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    UpdateCamera($camera);

    // Play animation when spacebar is held down
    if (IsKeyDown(Raylib::KEY_SPACE)) {
        $animFrameCounter++;
        UpdateModelAnimation($model, $anims[0], $animFrameCounter);
        /** @psalm-suppress UndefinedPropertyFetch */
        if ($animFrameCounter >= $anims[0]->frameCount) {
            $animFrameCounter = 0;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        BeginMode3D($camera);

            DrawModelEx($model, $position, new Vector3(1, 0, 0), -90, new Vector3(1, 1, 1), Color::white());

            for ($i = 0; $i < $model->boneCount; $i++) {
                /**
                 * @var stdClass $ffiPosition
                 * @psalm-suppress UndefinedPropertyFetch
                 * @psalm-suppress MixedArrayAccess
                 * @psalm-suppress MixedPropertyFetch
                 */
                $ffiPosition = $anims[0]->framePoses[$animFrameCounter][$i]->translation;
                DrawCube(
                    new Vector3((float) $ffiPosition->x, (float) $ffiPosition->y, (float) $ffiPosition->z),
                    0.2,
                    0.2,
                    0.2,
                    Color::red()
                );
            }

            DrawGrid(10, 1.0);         // Draw a grid

        EndMode3D();

        DrawText('PRESS SPACE to PLAY MODEL ANIMATION', 10, 10, 20, Color::maroon());
        DrawText('(c) Guy IQM 3D model by @culacant', $screenWidth - 200, $screenHeight - 20, 10, Color::gray());

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($texture);     // Unload texture

// Unload model animations data
for ($i = 0; $i < $animsCount; $i++) {
    UnloadModelAnimation($anims[$i]);
}
FFI::free($anims);

UnloadModel($model);         // Unload model

CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
