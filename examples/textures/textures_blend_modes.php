<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginBlendMode,
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawText,
    DrawTexture,
    EndBlendMode,
    EndDrawing,
    InitWindow,
    IsKeyPressed,
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

InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - blend modes');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)
$bgImage = LoadImage(__DIR__ . '/resources/cyberpunk_street_background.png');     // Loaded in CPU memory (RAM)
$bgTexture = LoadTextureFromImage($bgImage);          // Image converted to texture, GPU memory (VRAM)

$fgImage = LoadImage(__DIR__ . '/resources/cyberpunk_street_foreground.png');     // Loaded in CPU memory (RAM)
$fgTexture = LoadTextureFromImage($fgImage);          // Image converted to texture, GPU memory (VRAM)

// Once image has been converted to texture and uploaded to VRAM, it can be unloaded from RAM
UnloadImage($bgImage);
UnloadImage($fgImage);

$blendCountMax = 4;
$blendMode = 0;

// Main game loop
while (!WindowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (IsKeyPressed(Raylib::KEY_SPACE)) {
        if ($blendMode >= ($blendCountMax - 1)) {
            $blendMode = 0;
        } else {
            $blendMode++;
        };
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        DrawTexture(
            $bgTexture,
            (int) ($screenWidth / 2 - $bgTexture->width / 2),
            (int) ($screenHeight / 2 - $bgTexture->height / 2),
            Color::white()
        );

        // Apply the blend mode and then draw the foreground texture
        BeginBlendMode($blendMode);
            DrawTexture(
                $fgTexture,
                (int) ($screenWidth / 2 - $fgTexture->width / 2),
                (int) ($screenHeight / 2 - $fgTexture->height / 2),
                Color::white()
            );
        EndBlendMode();

        // Draw the texts
        DrawText('Press SPACE to change blend modes.', 310, 350, 10, Color::gray());

        switch ($blendMode) {
            case Raylib::BLEND_ALPHA:
                DrawText('Current: BLEND_ALPHA', (int) (($screenWidth / 2) - 60), 370, 10, Color::gray());
                break;
            case Raylib::BLEND_ADDITIVE:
                DrawText('Current: BLEND_ADDITIVE', (int) (($screenWidth / 2) - 60), 370, 10, Color::gray());
                break;
            case Raylib::BLEND_MULTIPLIED:
                DrawText('Current: BLEND_MULTIPLIED', (int) (($screenWidth / 2) - 60), 370, 10, Color::gray());
                break;
            case Raylib::BLEND_ADD_COLORS:
                DrawText('Current: BLEND_ADD_COLORS', (int) (($screenWidth / 2) - 60), 370, 10, Color::gray());
                break;
        }

        DrawText(
            '(c) Cyberpunk Street Environment by Luis Zuno (@ansimuz)',
            $screenWidth - 330,
            $screenHeight - 20,
            10,
            Color::gray()
        );

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($fgTexture); // Unload foreground texture
UnloadTexture($bgTexture); // Unload background texture

CloseWindow();            // Close window and OpenGL context
//--------------------------------------------------------------------------------------
