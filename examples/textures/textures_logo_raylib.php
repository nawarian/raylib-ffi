<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - texture loading and drawing');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)
$texture = \Nawarian\Raylib\LoadTexture(__DIR__ . '/resources/raylib_logo.png');     // Texture loading
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

        \Nawarian\Raylib\DrawText('this IS a texture!', 360, 370, 10, Color::gray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($texture);   // Texture unloading
\Nawarian\Raylib\CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
