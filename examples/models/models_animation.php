<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Camera3D, Color, Vector3};

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [models] example - model animation');

// Define the camera to look into our 3d world
$camera = new Camera3D(
    new Vector3(10, 10, 10),
    new Vector3(0, 0, 0),
    new Vector3(0, 1, 0),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$model = $raylib->loadModel(__DIR__ . '/resources/guy/guy.iqm'); // Load the animated model mesh and basic data
$texture = $raylib->loadTexture(__DIR__ . '/resources/guy/guytex.png'); // Load model texture and set material

$raylib->setMaterialTexture($model->materials[0], Raylib::MAP_DIFFUSE, $texture);  // Set model material map texture
$position = new Vector3(0, 0, 0);            // Set model position

// Load animation data
$animsCount = 0;
$anims = $raylib->loadModelAnimations(__DIR__ . '/resources/guy/guyanim.iqm', $animsCount);
$animFrameCounter = 0;

$raylib->setCameraMode($camera, Camera3D::MODE_FREE); // Set free camera mode

$raylib->setTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {      // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $raylib->updateCamera($camera);

    // Play animation when spacebar is held down
    if ($raylib->isKeyDown(Raylib::KEY_SPACE)) {
        $animFrameCounter++;
        $raylib->updateModelAnimation($model, $anims[0], $animFrameCounter);
        if ($animFrameCounter >= $anims[0]->frameCount) {
            $animFrameCounter = 0;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        $raylib->beginMode3D($camera);

            $raylib->drawModelEx(
                $model,
                $position,
                new Vector3(1, 0, 0),
                -90,
                new Vector3(1, 1, 1),
                Color::white(),
            );

            for ($i = 0; $i < $model->boneCount; $i++) {
                $ffiPosition = $anims[0]->framePoses[$animFrameCounter][$i]->translation;
                $raylib->drawCube(
                    new Vector3($ffiPosition->x, $ffiPosition->y, $ffiPosition->z),
                    0.2,
                    0.2,
                    0.2,
                    Color::red(),
                );
            }

            $raylib->drawGrid(10, 1.0);         // Draw a grid

        $raylib->endMode3D();

        $raylib->drawText('PRESS SPACE to PLAY MODEL ANIMATION', 10, 10, 20, Color::maroon());
        $raylib->drawText(
            '(c) Guy IQM 3D model by @culacant',
            $screenWidth - 200,
            $screenHeight - 20,
            10,
            Color::gray(),
        );

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($texture);     // Unload texture

// Unload model animations data
for ($i = 0; $i < $animsCount; $i++) {
    $raylib->unloadModelAnimation($anims[$i]);
}
FFI::free($anims);

$raylib->unloadModel($model);         // Unload model

$raylib->closeWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
