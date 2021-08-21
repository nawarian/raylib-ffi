<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - blend modes');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)
$bgImage = \Nawarian\Raylib\LoadImage(__DIR__ . '/resources/cyberpunk_street_background.png');     // Loaded in CPU memory (RAM)
$bgTexture = \Nawarian\Raylib\LoadTextureFromImage($bgImage);          // Image converted to texture, GPU memory (VRAM)

$fgImage = \Nawarian\Raylib\LoadImage(__DIR__ . '/resources/cyberpunk_street_foreground.png');     // Loaded in CPU memory (RAM)
$fgTexture = \Nawarian\Raylib\LoadTextureFromImage($fgImage);          // Image converted to texture, GPU memory (VRAM)

// Once image has been converted to texture and uploaded to VRAM, it can be unloaded from RAM
\Nawarian\Raylib\UnloadImage($bgImage);
\Nawarian\Raylib\UnloadImage($fgImage);

$blendCountMax = 4;
$blendMode = 0;

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        if ($blendMode >= ($blendCountMax - 1)) {
            $blendMode = 0;
        } else {
            $blendMode++;
        };
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        \Nawarian\Raylib\DrawTexture($bgTexture, (int) ($screenWidth / 2 - $bgTexture->width / 2), (int) ($screenHeight / 2 - $bgTexture->height / 2), Color::white());

        // Apply the blend mode and then draw the foreground texture
        \Nawarian\Raylib\BeginBlendMode($blendMode);
            \Nawarian\Raylib\DrawTexture($fgTexture, (int) ($screenWidth / 2 - $fgTexture->width / 2), (int) ($screenHeight / 2 - $fgTexture->height / 2), Color::white());
        \Nawarian\Raylib\EndBlendMode();

        // Draw the texts
        \Nawarian\Raylib\DrawText('Press SPACE to change blend modes.', 310, 350, 10, Color::gray());

        switch ($blendMode) {
            case Raylib::BLEND_ALPHA:
                \Nawarian\Raylib\DrawText('Current: BLEND_ALPHA', (int) (($screenWidth / 2) - 60), 370, 10, Color::gray());
                break;
            case Raylib::BLEND_ADDITIVE:
                \Nawarian\Raylib\DrawText('Current: BLEND_ADDITIVE', (int) (($screenWidth / 2) - 60), 370, 10, Color::gray());
                break;
            case Raylib::BLEND_MULTIPLIED:
                \Nawarian\Raylib\DrawText('Current: BLEND_MULTIPLIED', (int) (($screenWidth / 2) - 60), 370, 10, Color::gray());
                break;
            case Raylib::BLEND_ADD_COLORS:
                \Nawarian\Raylib\DrawText('Current: BLEND_ADD_COLORS', (int) (($screenWidth / 2) - 60), 370, 10, Color::gray());
                break;
        }

        \Nawarian\Raylib\DrawText('(c) Cyberpunk Street Environment by Luis Zuno (@ansimuz)', $screenWidth - 330, $screenHeight - 20, 10, Color::gray());

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($fgTexture); // Unload foreground texture
\Nawarian\Raylib\UnloadTexture($bgTexture); // Unload background texture

\Nawarian\Raylib\CloseWindow();            // Close window and OpenGL context
//--------------------------------------------------------------------------------------
