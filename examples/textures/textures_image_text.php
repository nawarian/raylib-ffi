<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Vector2};

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawText,
    DrawTextEx,
    DrawTexture,
    DrawTextureV,
    EndDrawing,
    ImageDrawTextEx,
    InitWindow,
    IsKeyDown,
    LoadFontEx,
    LoadImage,
    LoadTextureFromImage,
    SetTargetFPS,
    UnloadFont,
    UnloadImage,
    UnloadTexture,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [texture] example - image text drawing');

$parrots = LoadImage(__DIR__ . '/resources/parrots.png');      // Load image in CPU memory (RAM)

// TTF Font loading with custom generation parameters
$font = LoadFontEx(__DIR__ . '/resources/KAISG.ttf', 64, 0, 0);

// Draw over image using custom font
ImageDrawTextEx(
    $parrots,
    $font,
    '[Parrots font drawing]',
    new Vector2(20.0, 20.0),
    (float) $font->baseSize,
    0.0,
    Color::red()
);

$texture = LoadTextureFromImage($parrots);     // Image converted to texture, uploaded to GPU memory (VRAM)

//phpcs:ignore Generic.Files.LineLength.TooLong
UnloadImage($parrots);     // Once image has been converted to texture and uploaded to VRAM, it can be unloaded from RAM

$position = new Vector2(
    (float) ($screenWidth / 2 - $texture->width / 2),
    (float) ($screenHeight / 2 - $texture->height / 2 - 20),
);

SetTargetFPS(60);
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (IsKeyDown(Raylib::KEY_SPACE)) {
        $showFont = true;
    } else {
        $showFont = false;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        if (!$showFont) {
            // Draw texture with text already drawn inside
            DrawTextureV($texture, $position, Color::white());

            // Draw text directly using sprite font
            DrawTextEx(
                $font,
                '[Parrots font drawing]',
                new Vector2($position->x + 20, $position->y + 20 + 280),
                (float) $font->baseSize,
                0.0,
                Color::white()
            );
        } else {
            DrawTexture($font->texture, (int) ($screenWidth / 2 - $font->texture->width / 2), 50, Color::black());
        }

        DrawText('PRESS SPACE to SEE USED SPRITEFONT', 290, 420, 10, Color::darkGray());
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($texture);   // Texture unloading

UnloadFont($font);     // Unload custom spritefont

CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
