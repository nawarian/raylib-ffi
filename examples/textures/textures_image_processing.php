<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Rectangle;

require_once __DIR__ . '/../../vendor/autoload.php';

const NUM_PROCESS = 8;

$processText = [
    'NO PROCESSING',
    'COLOR GRAYSCALE',
    'COLOR TINT',
    'COLOR INVERT',
    'COLOR CONTRAST',
    'COLOR BRIGHTNESS',
    'FLIP VERTICAL',
    'FLIP HORIZONTAL'
];

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - image processing');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)

$image = \Nawarian\Raylib\LoadImage(__DIR__ . '/resources/parrots.png');        // Loaded in CPU memory (RAM)
//phpcs:ignore Generic.Files.LineLength.TooLong
\Nawarian\Raylib\ImageFormat($image, Raylib::UNCOMPRESSED_R8G8B8A8);    // Format image to RGBA 32bit (required for texture update) <-- ISSUE
$texture = \Nawarian\Raylib\LoadTextureFromImage($image);       // Image converted to texture, GPU memory (VRAM)

$currentProcess = Raylib::NONE;
$textureReload = false;

$toggleRecs = [];
$mouseHoverRec = -1;

foreach (range(0, NUM_PROCESS) as $i) {
    $toggleRecs[$i] = new Rectangle(
        40.0,
        (float) (50 + 32 * $i),
        150.0,
        30.0
    );
}

\Nawarian\Raylib\SetTargetFPS(60);
//---------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------

    // Mouse toggle group logic
    for ($i = 0; $i < NUM_PROCESS; $i++) {
        if (\Nawarian\Raylib\CheckCollisionPointRec(\Nawarian\Raylib\GetMousePosition(), $toggleRecs[$i])) {
            $mouseHoverRec = $i;

            if (\Nawarian\Raylib\IsMouseButtonReleased(Raylib::MOUSE_LEFT_BUTTON)) {
                $currentProcess = $i;
                $textureReload = true;
            }

            break;
        } else {
            $mouseHoverRec = -1;
        }
    }

    // Keyboard toggle group logic
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_DOWN)) {
        $currentProcess++;

        if ($currentProcess > 7) {
            $currentProcess = 0;
        }

        $textureReload = true;
    } elseif (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_UP)) {
        $currentProcess--;

        if ($currentProcess < 0) {
            $currentProcess = 7;
        }

        $textureReload = true;
    }

    // Reload texture when required
    if ($textureReload) {
        \Nawarian\Raylib\UnloadImage($image);                                           // Unload current image data
        $image = \Nawarian\Raylib\LoadImage(__DIR__ . '/resources/parrots.png');    // Re-load image data

        // NOTE: Image processing is a costly CPU process to be done every frame,
        // If image processing is required in a frame-basis, it should be done
        // with a texture and by shaders
        switch ($currentProcess) {
            case Raylib::COLOR_GRAYSCALE:
                \Nawarian\Raylib\ImageColorGrayscale($image);
                break;
            case Raylib::COLOR_TINT:
                \Nawarian\Raylib\ImageColorTint($image, Color::green());
                break;
            case Raylib::COLOR_INVERT:
                \Nawarian\Raylib\ImageColorInvert($image);
                break;
            case Raylib::COLOR_CONTRAST:
                \Nawarian\Raylib\ImageColorContrast($image, -40);
                break;
            case Raylib::COLOR_BRIGHTNESS:
                \Nawarian\Raylib\ImageColorBrightness($image, -80);
                break;
            case Raylib::FLIP_VERTICAL:
                \Nawarian\Raylib\ImageFlipVertical($image);
                break;
            case Raylib::FLIP_HORIZONTAL:
                \Nawarian\Raylib\ImageFlipHorizontal($image);
                break;
            default:
                break;
        }

        /**
         * @psalm-suppress DeprecatedMethod
         */
        $pixels = \Nawarian\Raylib\GetImageData($image);    // Get pixel data from image (RGBA 32bit)
        \Nawarian\Raylib\UpdateTexture($texture, $pixels);  // Update texture with new image data

        $textureReload = false;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawText('IMAGE PROCESSING:', 40, 30, 10, Color::darkGray());

        // Draw rectangles
        for ($i = 0; $i < NUM_PROCESS; $i++) {
            \Nawarian\Raylib\DrawRectangleRec($toggleRecs[$i], ($i == $currentProcess || $i == $mouseHoverRec) ? Color::skyBlue() : Color::lightGray());
            \Nawarian\Raylib\DrawRectangleLines((int) $toggleRecs[$i]->x, (int) $toggleRecs[$i]->y, (int) $toggleRecs[$i]->width, (int) $toggleRecs[$i]->height, ($i == $currentProcess || $i == $mouseHoverRec) ? Color::blue() : Color::gray());

            \Nawarian\Raylib\DrawText($processText[$i], (int) ($toggleRecs[$i]->x + $toggleRecs[$i]->width / 2 -
                \Nawarian\Raylib\MeasureText($processText[$i], 10) / 2), (int) $toggleRecs[$i]->y + 11, 10, ($i == $currentProcess || $i == $mouseHoverRec) ? Color::darkBlue() : Color::darkGray());
        }

        \Nawarian\Raylib\DrawTexture($texture, $screenWidth - $texture->width - 60, (int) ($screenHeight / 2 - $texture->height / 2), Color::white());
        \Nawarian\Raylib\DrawRectangleLines($screenWidth - $texture->width - 60, $screenHeight / 2 - $texture->height / 2, $texture->width, $texture->height, Color::black());
        //----------------------------------------------------------------------------------
    \Nawarian\Raylib\EndDrawing();
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($texture);   // Unload texture from VRAM
\Nawarian\Raylib\UnloadImage($image);    // Unload image from RAM

\Nawarian\Raylib\CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
