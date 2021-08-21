<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - image loading');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)

$image = \Nawarian\Raylib\LoadImage(__DIR__ . '/resources/raylib_logo.png');        // Loaded in CPU memory (RAM)
$texture = \Nawarian\Raylib\LoadTextureFromImage($image);       // Image converted to texture, GPU memory (VRAM)

//phpcs:ignore Generic.Files.LineLength.TooLong
\Nawarian\Raylib\UnloadImage($image);   // Once image has been converted to texture and uploaded to VRAM, it can be unloaded from RAM
//---------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // TODO: Update your variables here
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawTexture($texture, (int) ($screenWidth / 2 - $texture->width / 2), (int) ($screenHeight / 2 - $texture->height / 2), Color::white());

        \Nawarian\Raylib\DrawText('this IS a texture loaded from an image!', 300, 370, 10, Color::gray());
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($texture);       // Texture unloading

\Nawarian\Raylib\CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
