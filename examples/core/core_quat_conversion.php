<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\{
    Raylib,
    RaylibFactory,
};
use Nawarian\Raylib\Types\{
    Camera3D,
    Color,
    Vector3,
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

$pi = pi();
$deg2rad = $pi / 180;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - quat conversions");

$camera = new Camera3D(
    new Vector3(0, 10, 10),
    new Vector3(0, 0, 0),
    new Vector3(0, 1, 10),
    45,
    Camera3D::PROJECTION_PERSPECTIVE,
);

$mesh = $raylib->genMeshCylinder(0.2, 1.0, 32);
$model = $raylib->loadModelFromMesh($mesh);

// Some required variables
$q1 = new Quaternion();

$m1 = new Matrix();
$m2 = new Matrix();
$m3 = new Matrix();
$m4 = new Matrix();

$v1 = new Vector3(0, 0, 0);
$v2 = new Vector3(0, 0, 0);

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //--------------------------------------------------------------------------------------
    if (!$raylib->isKeyDown(Raylib::KEY_SPACE)) {
        $v1->x += 0.01;
        $v1->y += 0.03;
        $v1->z += 0.05;
    }

    if ($v1->x > $pi * 2) {
        $v1->x -= $pi * 2;
    }

    if ($v1->y > $pi * 2) {
        $v1->y -= $pi * 2;
    }

    if ($v1->z > $pi * 2) {
        $v1->z -= $pi * 2;
    }

    $q1 = QuaternionFromEuler($v1->x, $v1->y, $v1->z);
    $m1 = MatrixRotateZYX($v1);
    $m2 = QuaternionToMatrix($q1);

    $q1 = QuaternionFromMatrix($m1);
    $m3 = QuaternionToMatrix($q1);

    $v2 = QuaternionToEuler($q1);
    $v2->x *= $deg2rad;
    $v2->y *= $deg2rad;
    $v2->z *= $deg2rad;

    $m4 = MatrixRotateZYX($v2);
    //--------------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
    // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        $raylib->clearBackground(Color::rayWhite());

        $raylib->beginMode3D($camera);

            $model->transform = $m1;
            $raylib->drawModel($model, new Vector3(-1, 0, 0), 1, Color::red());

            $model->transform = $m2;
            $raylib->drawModel($model, new Vector3(1, 0, 0), 1, Color::red());

            $model->transform = $m3;
            $raylib->drawModel($model, new Vector3(0, 0, 0), 1, Color::red());

            $model->transform = $m4;
            $raylib->drawModel($model, new Vector3(0, 0, -1), 1.0, Color::red());

            $raylib->drawGrid(10, 1.0);

        $raylib->endMode3D();

        if ($v2->x < 0) {
            $v2->x += $pi * 2;
        }

        if ($v2->y < 0) {
            $v2->y += $pi * 2;
        }

        if ($v2->z < 0) {
            $v2->z += $pi * 2;
        }

        $cx = $cy = $cz = Color::black();
        if ($v1->x == $v2->x) {
            $cx = Color::green();
        }

        if ($v1->y == $v2->y) {
            $cy = Color::green();
        }

        if ($v1->z == $v2->z) {
            $cz = Color::green();
        }

        $raylib->DrawText($raylib->TextFormat("%2.3f", $v1->x), 20, 20, 20, $cx);
        $raylib->DrawText($raylib->TextFormat("%2.3f", $v1->y), 20, 40, 20, $cy);
        $raylib->DrawText($raylib->TextFormat("%2.3f", $v1->z), 20, 60, 20, $cz);

        $raylib->DrawText($raylib->TextFormat("%2.3f", $v2->x), 200, 20, 20, $cx);
        $raylib->DrawText($raylib->TextFormat("%2.3f", $v2->y), 200, 40, 20, $cy);
        $raylib->DrawText($raylib->TextFormat("%2.3f", $v2->z), 200, 60, 20, $cz);

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadModel($model);   // Unload model data (mesh and materials)

$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
