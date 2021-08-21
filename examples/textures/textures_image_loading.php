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
    LoadImage,
    LoadTextureFromImage,
    UnloadImage,
    UnloadTexture,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - image loading');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)

$image = LoadImage(__DIR__ . '/resources/raylib_logo.png');        // Loaded in CPU memory (RAM)
$texture = LoadTextureFromImage($image);       // Image converted to texture, GPU memory (VRAM)

//phpcs:ignore Generic.Files.LineLength.TooLong
UnloadImage($image);   // Once image has been converted to texture and uploaded to VRAM, it can be unloaded from RAM
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

        DrawText('this IS a texture loaded from an image!', 300, 370, 10, Color::gray());
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($texture);       // Texture unloading

CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
