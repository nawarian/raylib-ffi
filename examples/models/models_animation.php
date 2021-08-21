<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Camera3D, Color, Vector3};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [models] example - model animation');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10, 10, 10),
    new Vector3(0, 0, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$model = \Nawarian\Raylib\LoadModel(__DIR__ . '/resources/guy/guy.iqm'); // Load the animated model mesh and basic data
$texture = \Nawarian\Raylib\LoadTexture(__DIR__ . '/resources/guy/guytex.png'); // Load model texture and set material

/**
 * @psalm-suppress UndefinedMethod
 * @psalm-suppress MixedArgument
 */
\Nawarian\Raylib\SetMaterialTexture($model->materials[0], Raylib::MAP_DIFFUSE, $texture);  // Set model material map texture
$position = new Vector3(0, 0, 0);            // Set model position

// Load animation data
$animsCount = 0;
/** @var \FFI\CData&\ArrayAccess<int, \FFI\CData> $anims */
$anims = \Nawarian\Raylib\LoadModelAnimations(__DIR__ . '/resources/guy/guyanim.iqm', $animsCount);
$animFrameCounter = 0;

\Nawarian\Raylib\SetCameraMode($camera, Camera3D::MODE_FREE); // Set free camera mode

\Nawarian\Raylib\SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {      // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\UpdateCamera($camera);

    // Play animation when spacebar is held down
    if (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_SPACE)) {
        $animFrameCounter++;
        \Nawarian\Raylib\UpdateModelAnimation($model, $anims[0], $animFrameCounter);
        /** @psalm-suppress UndefinedPropertyFetch */
        if ($animFrameCounter >= $anims[0]->frameCount) {
            $animFrameCounter = 0;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        \Nawarian\Raylib\BeginMode3D($camera);

            \Nawarian\Raylib\DrawModelEx($model, $position, new Vector3(1, 0, 0), -90, new Vector3(1, 1, 1), Color::white());

            for ($i = 0; $i < $model->boneCount; $i++) {
                /**
                 * @var stdClass $ffiPosition
                 * @psalm-suppress UndefinedPropertyFetch
                 * @psalm-suppress MixedArrayAccess
                 * @psalm-suppress MixedPropertyFetch
                 */
                $ffiPosition = $anims[0]->framePoses[$animFrameCounter][$i]->translation;
                \Nawarian\Raylib\DrawCube(new Vector3((float) $ffiPosition->x, (float) $ffiPosition->y, (float) $ffiPosition->z), 0.2, 0.2, 0.2, Color::red());
            }

            \Nawarian\Raylib\DrawGrid(10, 1.0);         // Draw a grid

        \Nawarian\Raylib\EndMode3D();

        \Nawarian\Raylib\DrawText('PRESS SPACE to PLAY MODEL ANIMATION', 10, 10, 20, Color::maroon());
        \Nawarian\Raylib\DrawText('(c) Guy IQM 3D model by @culacant', $screenWidth - 200, $screenHeight - 20, 10, Color::gray());

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($texture);     // Unload texture

// Unload model animations data
for ($i = 0; $i < $animsCount; $i++) {
    \Nawarian\Raylib\UnloadModelAnimation($anims[$i]);
}
FFI::free($anims);

\Nawarian\Raylib\UnloadModel($model);         // Unload model

\Nawarian\Raylib\CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
