<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Rectangle;
use Nawarian\Raylib\Types\Vector2;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [textures] example - image drawing');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)

$cat = $raylib->loadImage(__DIR__ . '/resources/cat.png');      // Load image in CPU memory (RAM)
$raylib->imageCrop($cat, new Rectangle(100, 10, 280, 380));     // Crop an image piece
$raylib->imageFlipHorizontal($cat);                             // Flip cropped image horizontally
$raylib->imageResize($cat, 150, 200);                           // Resize flipped-cropped image

$parrots = $raylib->loadImage(__DIR__ . '/resources/parrots.png');  // Load image in CPU memory (RAM)

// Draw one image over the other with a scaling of 1.5f
$raylib->imageDraw(
    $parrots,
    $cat,
    new Rectangle(0.0, 0.0, $cat->width, $cat->height),
    new Rectangle(30.0, 40.0, $cat->width * 1.5, $cat->height * 1.5),
    Color::white()
);
$raylib->imageCrop($parrots, new Rectangle(0.0, 50.0, $parrots->width, $parrots->height - 100)); // Crop resulting image

// Draw on the image with a few image draw methods
$raylib->imageDrawPixel($parrots, 10, 10, Color::rayWhite());
$raylib->imageDrawCircle($parrots, 10, 10, 5, Color::rayWhite());
$raylib->imageDrawRectangle($parrots, 5, 20, 10, 10, Color::rayWhite());

$raylib->unloadImage($cat);     // Unload image from RAM

// Load custom font for frawing on image
$font = $raylib->loadFont(__DIR__ . '/resources/custom_jupiter_crash.png');

// Draw over image using custom font
$raylib->imageDrawTextEx(
    $parrots,
    $font,
    'PARROTS & CAT',
    new Vector2(300.0, 230.0),
    $font->baseSize,
    -2,
    Color::white()
);

$raylib->unloadFont($font);     // Unload custom spritefont (already drawn used on image)

$texture = $raylib->loadTextureFromImage($parrots); // Image converted to texture, uploaded to GPU memory (VRAM)

//Once image has been converted to texture and uploaded to VRAM,it can be unloaded from RAM
$raylib->unloadImage($parrots);

$raylib->setTargetFPS(60);
//---------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // TODO: Update your variables here
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawTexture(
            $texture,
            (int) ($screenWidth / 2),
            (int) ($screenHeight / 2 - $texture->height / 2 - 40),
            Color::white()
        );
        $raylib->drawRectangleLines(
            $screenWidth / 2 - $texture->width / 2,
            $screenHeight / 2 - $texture->height / 2 - 40,
            $texture->width,
            $texture->height,
            Color::darkGray()
        );

        $raylib->drawText(
            'We are drawing only one texture from various images composed!',
            240,
            350,
            10,
            Color::darkGray()
        );
        $raylib->drawText(
            'Source images have been cropped, scaled, flipped and copied one over the other.',
            190,
            370,
            10,
            Color::darkGray()
        );

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($texture);  // Texture unloading

$raylib->closeWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
