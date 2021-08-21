<?php

declare(strict_types=1);

use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawText,
    DrawTexture,
    EndDrawing,
    InitWindow,
    LoadTexture,
    UnloadTexture,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - texture loading and drawing');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)
$texture = LoadTexture(__DIR__ . '/resources/raylib_logo.png');     // Texture loading
//---------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // TODO: Update your variables here
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        DrawTexture(
            $texture,
            (int) ($screenWidth / 2 - $texture->width / 2),
            (int) ($screenHeight / 2 - $texture->height / 2),
            Color::white()
        );

        DrawText('this IS a texture!', 360, 370, 10, Color::gray());

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($texture);   // Texture unloading
CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
