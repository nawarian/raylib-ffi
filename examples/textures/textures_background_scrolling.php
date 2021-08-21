<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Types\{
    Color,
    Vector2,
};

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawText,
    DrawTextureEx,
    EndDrawing,
    GetColor,
    InitWindow,
    LoadTexture,
    SetTargetFPS,
    UnloadTexture,
    WindowShouldClose
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - background scrolling');

// NOTE: Be careful, background width must be equal or bigger than screen width
// if not, texture should be draw more than two times for scrolling effect
$background = LoadTexture(__DIR__ . '/resources/cyberpunk_street_background.png');
$midground = LoadTexture(__DIR__ . '/resources/cyberpunk_street_midground.png');
$foreground = LoadTexture(__DIR__ . '/resources/cyberpunk_street_foreground.png');

$scrollingBack = 0.0;
$scrollingMid = 0.0;
$scrollingFore = 0.0;

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $scrollingBack -= 0.1;
    $scrollingMid -= 0.5;
    $scrollingFore -= 1.0;

    // NOTE: Texture is scaled twice its size, so it should be considered on scrolling
    if ($scrollingBack <= -$background->width * 2) {
        $scrollingBack = 0;
    }

    if ($scrollingMid <= -$midground->width * 2) {
        $scrollingMid = 0;
    }

    if ($scrollingFore <= -$foreground->width * 2) {
        $scrollingFore = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(GetColor(0x052c46ff));

        // Draw background image twice
        // NOTE: Texture is scaled twice its size
        DrawTextureEx($background, new Vector2($scrollingBack, 20), 0.0, 2.0, Color::white());
        DrawTextureEx($background, new Vector2($background->width * 2 + $scrollingBack, 20), 0.0, 2.0, Color::white());

        // Draw midground image twice
        DrawTextureEx($midground, new Vector2($scrollingMid, 20), 0.0, 2.0, Color::white());
        DrawTextureEx($midground, new Vector2($midground->width * 2 + $scrollingMid, 20), 0.0, 2.0, Color::white());

        // Draw foreground image twice
        DrawTextureEx($foreground, new Vector2($scrollingFore, 70), 0.0, 2.0, Color::white());
        DrawTextureEx($foreground, new Vector2($foreground->width * 2 + $scrollingFore, 70), 0.0, 2.0, Color::white());

        DrawText('BACKGROUND SCROLLING & PARALLAX', 10, 10, 20, Color::red());
        DrawText(
            '(c) Cyberpunk Street Environment by Luis Zuno (@ansimuz)',
            $screenWidth - 330,
            $screenHeight - 20,
            10,
            Color::rayWhite()
        );

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($background);  // Unload background texture
UnloadTexture($midground);   // Unload midground texture
UnloadTexture($foreground);  // Unload foreground texture

CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
