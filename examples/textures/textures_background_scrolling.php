<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Types\{
    Color,
    Vector2,
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - background scrolling');

// NOTE: Be careful, background width must be equal or bigger than screen width
// if not, texture should be draw more than two times for scrolling effect
$background = \Nawarian\Raylib\LoadTexture(__DIR__ . '/resources/cyberpunk_street_background.png');
$midground = \Nawarian\Raylib\LoadTexture(__DIR__ . '/resources/cyberpunk_street_midground.png');
$foreground = \Nawarian\Raylib\LoadTexture(__DIR__ . '/resources/cyberpunk_street_foreground.png');

$scrollingBack = 0.0;
$scrollingMid = 0.0;
$scrollingFore = 0.0;

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
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
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(\Nawarian\Raylib\GetColor(0x052c46ff));

        // Draw background image twice
        // NOTE: Texture is scaled twice its size
        \Nawarian\Raylib\DrawTextureEx($background, new Vector2($scrollingBack, 20), 0.0, 2.0, Color::white());
        \Nawarian\Raylib\DrawTextureEx($background, new Vector2($background->width * 2 + $scrollingBack, 20), 0.0, 2.0, Color::white());

        // Draw midground image twice
        \Nawarian\Raylib\DrawTextureEx($midground, new Vector2($scrollingMid, 20), 0.0, 2.0, Color::white());
        \Nawarian\Raylib\DrawTextureEx($midground, new Vector2($midground->width * 2 + $scrollingMid, 20), 0.0, 2.0, Color::white());

        // Draw foreground image twice
        \Nawarian\Raylib\DrawTextureEx($foreground, new Vector2($scrollingFore, 70), 0.0, 2.0, Color::white());
        \Nawarian\Raylib\DrawTextureEx($foreground, new Vector2($foreground->width * 2 + $scrollingFore, 70), 0.0, 2.0, Color::white());

        \Nawarian\Raylib\DrawText('BACKGROUND SCROLLING & PARALLAX', 10, 10, 20, Color::red());
        \Nawarian\Raylib\DrawText('(c) Cyberpunk Street Environment by Luis Zuno (@ansimuz)', $screenWidth - 330, $screenHeight - 20, 10, Color::rayWhite());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($background);  // Unload background texture
\Nawarian\Raylib\UnloadTexture($midground);   // Unload midground texture
\Nawarian\Raylib\UnloadTexture($foreground);  // Unload foreground texture

\Nawarian\Raylib\CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
