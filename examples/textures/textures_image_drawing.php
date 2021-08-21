<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Rectangle;
use Nawarian\Raylib\Types\Vector2;

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - image drawing');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)

$cat = \Nawarian\Raylib\LoadImage(__DIR__ . '/resources/cat.png');      // Load image in CPU memory (RAM)
\Nawarian\Raylib\ImageCrop($cat, new Rectangle(100, 10, 280, 380));     // Crop an image piece
\Nawarian\Raylib\ImageFlipHorizontal($cat);                             // Flip cropped image horizontally
\Nawarian\Raylib\ImageResize($cat, 150, 200);                           // Resize flipped-cropped image

$parrots = \Nawarian\Raylib\LoadImage(__DIR__ . '/resources/parrots.png');  // Load image in CPU memory (RAM)

// Draw one image over the other with a scaling of 1.5f
\Nawarian\Raylib\ImageDraw($parrots, $cat, new Rectangle(0.0, 0.0, $cat->width, $cat->height), new Rectangle(30.0, 40.0, $cat->width * 1.5, $cat->height * 1.5), Color::white());
\Nawarian\Raylib\ImageCrop($parrots, new Rectangle(0.0, 50.0, $parrots->width, $parrots->height - 100)); // Crop resulting image

// Draw on the image with a few image draw methods
\Nawarian\Raylib\ImageDrawPixel($parrots, 10, 10, Color::rayWhite());
\Nawarian\Raylib\ImageDrawCircle($parrots, 10, 10, 5, Color::rayWhite());
\Nawarian\Raylib\ImageDrawRectangle($parrots, 5, 20, 10, 10, Color::rayWhite());

\Nawarian\Raylib\UnloadImage($cat);     // Unload image from RAM

// Load custom font for frawing on image
$font = \Nawarian\Raylib\LoadFont(__DIR__ . '/resources/custom_jupiter_crash.png');

// Draw over image using custom font
\Nawarian\Raylib\ImageDrawTextEx($parrots, $font, 'PARROTS & CAT', new Vector2(300.0, 230.0), $font->baseSize, -2, Color::white());

\Nawarian\Raylib\UnloadFont($font);     // Unload custom spritefont (already drawn used on image)

$texture = \Nawarian\Raylib\LoadTextureFromImage($parrots); // Image converted to texture, uploaded to GPU memory (VRAM)

//phpcs:ignore Generic.Files.LineLength.TooLong
\Nawarian\Raylib\UnloadImage($parrots); //Once image has been converted to texture and uploaded to VRAM,it can be unloaded from RAM

\Nawarian\Raylib\SetTargetFPS(60);
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

        \Nawarian\Raylib\DrawTexture($texture, (int) ($screenWidth / 2 - $texture->width / 2), (int) ($screenHeight / 2 - $texture->height / 2 - 40), Color::white());
        \Nawarian\Raylib\DrawRectangleLines($screenWidth / 2 - $texture->width / 2, $screenHeight / 2 - $texture->height / 2 - 40, $texture->width, $texture->height, Color::darkGray());

        \Nawarian\Raylib\DrawText('We are drawing only one texture from various images composed!', 240, 350, 10, Color::darkGray());
        \Nawarian\Raylib\DrawText('Source images have been cropped, scaled, flipped and copied one over the other.', 190, 370, 10, Color::darkGray());

    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($texture);  // Texture unloading

\Nawarian\Raylib\CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
