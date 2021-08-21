<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, "raylib [shapes] example - following eyes");

$scleraLeftPosition = new Vector2(\Nawarian\Raylib\GetScreenWidth() / 2 - 100, \Nawarian\Raylib\GetScreenHeight() / 2);
$scleraRightPosition = new Vector2(\Nawarian\Raylib\GetScreenWidth() / 2 + 100, \Nawarian\Raylib\GetScreenHeight() / 2);
$scleraRadius = 80;

$irisRadius = 24;

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $irisLeftPosition = \Nawarian\Raylib\GetMousePosition();
    $irisRightPosition = \Nawarian\Raylib\GetMousePosition();

    // Check not inside the left eye sclera
    if (!\Nawarian\Raylib\CheckCollisionPointCircle($irisLeftPosition, $scleraLeftPosition, $scleraRadius - 20)) {
        $dx = $irisLeftPosition->x - $scleraLeftPosition->x;
        $dy = $irisLeftPosition->y - $scleraLeftPosition->y;

        $angle = atan2($dy, $dx);

        $dxx = ($scleraRadius - $irisRadius) * cos($angle);
        $dyy = ($scleraRadius - $irisRadius) * sin($angle);

        $irisLeftPosition->x = $scleraLeftPosition->x + $dxx;
        $irisLeftPosition->y = $scleraLeftPosition->y + $dyy;
    }

    // Check not inside the right eye sclera
    if (!\Nawarian\Raylib\CheckCollisionPointCircle($irisRightPosition, $scleraRightPosition, $scleraRadius - 20)) {
        $dx = $irisRightPosition->x - $scleraRightPosition->x;
        $dy = $irisRightPosition->y - $scleraRightPosition->y;

        $angle = atan2($dy, $dx);

        $dxx = ($scleraRadius - $irisRadius) * cos($angle);
        $dyy = ($scleraRadius - $irisRadius) * sin($angle);

        $irisRightPosition->x = $scleraRightPosition->x + $dxx;
        $irisRightPosition->y = $scleraRightPosition->y + $dyy;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawCircleV($scleraLeftPosition, $scleraRadius, Color::lightGray());
        \Nawarian\Raylib\DrawCircleV($irisLeftPosition, $irisRadius, Color::brown());
        \Nawarian\Raylib\DrawCircleV($irisLeftPosition, 10, Color::black());

        \Nawarian\Raylib\DrawCircleV($scleraRightPosition, $scleraRadius, Color::lightGray());
        \Nawarian\Raylib\DrawCircleV($irisRightPosition, $irisRadius, Color::darkGreen());
        \Nawarian\Raylib\DrawCircleV($irisRightPosition, 10, Color::black());

        \Nawarian\Raylib\DrawFPS(10, 10);

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
