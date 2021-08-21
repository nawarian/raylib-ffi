<?php

declare(strict_types=1);

use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

use function Nawarian\Raylib\{BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawRectangleLines,
    DrawText,
    DrawTexture,
    EndDrawing,
    ImageCrop,
    ImageDraw,
    ImageDrawCircle,
    ImageDrawPixel,
    ImageDrawRectangle,
    ImageDrawTextEx,
    ImageFlipHorizontal,
    ImageResize,
    InitWindow,
    LoadFont,
    LoadImage,
    LoadTextureFromImage,
    SetTargetFPS,
    UnloadFont,
    UnloadImage,
    UnloadTexture,
    WindowShouldClose};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - image drawing');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)

$cat = LoadImage(__DIR__ . '/resources/cat.png');      // Load image in CPU memory (RAM)
ImageCrop($cat, new Rectangle(100, 10, 280, 380));     // Crop an image piece
ImageFlipHorizontal($cat);                             // Flip cropped image horizontally
ImageResize($cat, 150, 200);                           // Resize flipped-cropped image

$parrots = LoadImage(__DIR__ . '/resources/parrots.png');  // Load image in CPU memory (RAM)

// Draw one image over the other with a scaling of 1.5f
ImageDraw(
    $parrots,
    $cat,
    new Rectangle(0.0, 0.0, $cat->width, $cat->height),
    new Rectangle(30.0, 40.0, $cat->width * 1.5, $cat->height * 1.5),
    Color::white()
);
ImageCrop($parrots, new Rectangle(0.0, 50.0, $parrots->width, $parrots->height - 100)); // Crop resulting image

// Draw on the image with a few image draw methods
ImageDrawPixel($parrots, 10, 10, Color::rayWhite());
ImageDrawCircle($parrots, 10, 10, 5, Color::rayWhite());
ImageDrawRectangle($parrots, 5, 20, 10, 10, Color::rayWhite());

UnloadImage($cat);     // Unload image from RAM

// Load custom font for frawing on image
$font = LoadFont(__DIR__ . '/resources/custom_jupiter_crash.png');

// Draw over image using custom font
ImageDrawTextEx($parrots, $font, 'PARROTS & CAT', new Vector2(300.0, 230.0), $font->baseSize, -2, Color::white());

UnloadFont($font);     // Unload custom spritefont (already drawn used on image)

$texture = LoadTextureFromImage($parrots); // Image converted to texture, uploaded to GPU memory (VRAM)

//phpcs:ignore Generic.Files.LineLength.TooLong
UnloadImage($parrots); //Once image has been converted to texture and uploaded to VRAM,it can be unloaded from RAM

SetTargetFPS(60);
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
            (int) ($screenHeight / 2 - $texture->height / 2 - 40),
            Color::white()
        );
        DrawRectangleLines(
            $screenWidth / 2 - $texture->width / 2,
            $screenHeight / 2 - $texture->height / 2 - 40,
            $texture->width,
            $texture->height,
            Color::darkGray()
        );

        DrawText('We are drawing only one texture from various images composed!', 240, 350, 10, Color::darkGray());
        DrawText(
            'Source images have been cropped, scaled, flipped and copied one over the other.',
            190,
            370,
            10,
            Color::darkGray()
        );

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($texture);  // Texture unloading

CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
