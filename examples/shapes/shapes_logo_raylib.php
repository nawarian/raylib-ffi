<?php

declare(strict_types=1);

use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawRectangle,
    DrawText,
    EndDrawing,
    InitWindow,
    SetTargetFPS,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - raylib logo using shapes');

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // TODO: Update your variables here
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        DrawRectangle($screenWidth / 2 - 128, $screenHeight / 2 - 128, 256, 256, Color::black());
        DrawRectangle($screenWidth / 2 - 112, $screenHeight / 2 - 112, 224, 224, Color::rayWhite());
        DrawText('raylib', (int) ($screenWidth / 2 - 44), (int) ($screenHeight / 2 + 48), 50, Color::black());

        DrawText('this is NOT a texture!', 350, 370, 10, Color::gray());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
