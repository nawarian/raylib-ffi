<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Texture2D;
use Nawarian\Raylib\Types\Vector2;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [texture] example - image text drawing');

$parrots = $raylib->loadImage(__DIR__ . '/resources/parrots.png');      // Load image in CPU memory (RAM)

// TTF Font loading with custom generation parameters
$font = $raylib->loadFontEx(__DIR__ . '/resources/KAISG.ttf', 64, 0, 0);

// Draw over image using custom font
$raylib->imageDrawTextEx(
    $parrots,
    $font,
    '[Parrots font drawing]',
    new Vector2(20.0, 20.0),
    (float) $font->baseSize,
    0.0,
    Color::red()
);

$texture = $raylib->loadTextureFromImage($parrots);     // Image converted to texture, uploaded to GPU memory (VRAM)

//phpcs:ignore Generic.Files.LineLength.TooLong
$raylib->unloadImage($parrots);     // Once image has been converted to texture and uploaded to VRAM, it can be unloaded from RAM

$position = new Vector2(
    (float) ($screenWidth / 2 - $texture->width / 2),
    (float) ($screenHeight / 2 - $texture->height / 2 - 20),
);

$raylib->setTargetFPS(60);
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isKeyDown(Raylib::KEY_SPACE)) {
        $showFont = true;
    } else {
        $showFont = false;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        if (!$showFont) {
            // Draw texture with text already drawn inside
            $raylib->drawTextureV($texture, $position, Color::white());

            // Draw text directly using sprite font
            $raylib->drawTextEx(
                $font,
                '[Parrots font drawing]',
                new Vector2($position->x + 20, $position->y + 20 + 280),
                (float) $font->baseSize,
                0.0,
                Color::white()
            );
        } else {
            $raylib->drawTexture(
                $font->texture,
                (int) ($screenWidth / 2 - $font->texture->width / 2),
                50,
                Color::black()
            );
        }

        $raylib->drawText('PRESS SPACE to SEE USED SPRITEFONT', 290, 420, 10, Color::darkGray());
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($texture);   // Texture unloading

$raylib->unloadFont($font);     // Unload custom spritefont

$raylib->closeWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
