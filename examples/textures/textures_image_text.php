<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Texture2D;
use Nawarian\Raylib\Types\Vector2;

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [texture] example - image text drawing');

$parrots = \Nawarian\Raylib\LoadImage(__DIR__ . '/resources/parrots.png');      // Load image in CPU memory (RAM)

// TTF Font loading with custom generation parameters
$font = \Nawarian\Raylib\LoadFontEx(__DIR__ . '/resources/KAISG.ttf', 64, 0, 0);

// Draw over image using custom font
\Nawarian\Raylib\ImageDrawTextEx($parrots, $font, '[Parrots font drawing]', new Vector2(20.0, 20.0), (float) $font->baseSize, 0.0, Color::red());

$texture = \Nawarian\Raylib\LoadTextureFromImage($parrots);     // Image converted to texture, uploaded to GPU memory (VRAM)

//phpcs:ignore Generic.Files.LineLength.TooLong
\Nawarian\Raylib\UnloadImage($parrots);     // Once image has been converted to texture and uploaded to VRAM, it can be unloaded from RAM

$position = new Vector2(
    (float) ($screenWidth / 2 - $texture->width / 2),
    (float) ($screenHeight / 2 - $texture->height / 2 - 20),
);

\Nawarian\Raylib\SetTargetFPS(60);
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_SPACE)) {
        $showFont = true;
    } else {
        $showFont = false;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        if (!$showFont) {
            // Draw texture with text already drawn inside
            \Nawarian\Raylib\DrawTextureV($texture, $position, Color::white());

            // Draw text directly using sprite font
            \Nawarian\Raylib\DrawTextEx($font, '[Parrots font drawing]', new Vector2($position->x + 20, $position->y + 20 + 280), (float) $font->baseSize, 0.0, Color::white());
        } else {
            \Nawarian\Raylib\DrawTexture($font->texture, (int) ($screenWidth / 2 - $font->texture->width / 2), 50, Color::black());
        }

        \Nawarian\Raylib\DrawText('PRESS SPACE to SEE USED SPRITEFONT', 290, 420, 10, Color::darkGray());
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($texture);   // Texture unloading

\Nawarian\Raylib\UnloadFont($font);     // Unload custom spritefont

\Nawarian\Raylib\CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
