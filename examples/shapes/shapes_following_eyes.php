<?php

declare(strict_types=1);

use Nawarian\Raylib\Types\{Color, Vector2};

use function Nawarian\Raylib\{
    BeginDrawing,
    CheckCollisionPointCircle,
    ClearBackground,
    CloseWindow,
    DrawCircleV,
    DrawFPS,
    EndDrawing,
    GetMousePosition,
    GetScreenHeight,
    GetScreenWidth,
    InitWindow,
    SetTargetFPS,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, "raylib [shapes] example - following eyes");

$scleraLeftPosition = new Vector2(GetScreenWidth() / 2 - 100, GetScreenHeight() / 2);
$scleraRightPosition = new Vector2(GetScreenWidth() / 2 + 100, GetScreenHeight() / 2);
$scleraRadius = 80;

$irisRadius = 24;

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $irisLeftPosition = GetMousePosition();
    $irisRightPosition = GetMousePosition();

    // Check not inside the left eye sclera
    if (!CheckCollisionPointCircle($irisLeftPosition, $scleraLeftPosition, $scleraRadius - 20)) {
        $dx = $irisLeftPosition->x - $scleraLeftPosition->x;
        $dy = $irisLeftPosition->y - $scleraLeftPosition->y;

        $angle = atan2($dy, $dx);

        $dxx = ($scleraRadius - $irisRadius) * cos($angle);
        $dyy = ($scleraRadius - $irisRadius) * sin($angle);

        $irisLeftPosition->x = $scleraLeftPosition->x + $dxx;
        $irisLeftPosition->y = $scleraLeftPosition->y + $dyy;
    }

    // Check not inside the right eye sclera
    if (!CheckCollisionPointCircle($irisRightPosition, $scleraRightPosition, $scleraRadius - 20)) {
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
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        DrawCircleV($scleraLeftPosition, $scleraRadius, Color::lightGray());
        DrawCircleV($irisLeftPosition, $irisRadius, Color::brown());
        DrawCircleV($irisLeftPosition, 10, Color::black());

        DrawCircleV($scleraRightPosition, $scleraRadius, Color::lightGray());
        DrawCircleV($irisRightPosition, $irisRadius, Color::darkGreen());
        DrawCircleV($irisRightPosition, 10, Color::black());

        DrawFPS(10, 10);

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
