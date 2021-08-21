<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawRectangle,
    DrawText,
    EndDrawing,
    GetMouseWheelMove,
    InitWindow,
    SetTargetFPS,
    TextFormat,
    WindowShouldClose
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, "raylib [core] example - input mouse wheel");

$boxPositionY = $screenHeight / 2 - 40;
$scrollSpeed = 4;            // Scrolling speed in pixels

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $boxPositionY -= GetMouseWheelMove() * $scrollSpeed;
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        DrawRectangle($screenWidth / 2 - 40, $boxPositionY, 80, 80, Color::maroon());

        DrawText("Use mouse wheel to move the cube up and down!", 10, 10, 20, Color::gray());
        DrawText(TextFormat("Box position Y: %03d", $boxPositionY), 10, 40, 20, Color::lightGray());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
