<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Rectangle};

use function Nawarian\Raylib\{BeginDrawing,
    CheckCollisionPointRec,
    ClearBackground,
    CloseWindow,
    DrawRectangleLines,
    DrawRectangleRec,
    DrawText,
    DrawTexture,
    EndDrawing,
    GetMousePosition,
    ImageColorBrightness,
    ImageColorContrast,
    ImageColorGrayscale,
    ImageColorInvert,
    ImageColorTint,
    ImageFlipHorizontal,
    ImageFlipVertical,
    ImageFormat,
    InitWindow,
    IsKeyPressed,
    IsMouseButtonReleased,
    LoadImage,
    LoadImageColors,
    LoadTextureFromImage,
    MeasureText,
    SetTargetFPS,
    UnloadImage,
    UnloadTexture,
    UpdateTexture,
    WindowShouldClose};

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

InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - image processing');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)

$image = LoadImage(__DIR__ . '/resources/parrots.png');        // Loaded in CPU memory (RAM)
//phpcs:ignore Generic.Files.LineLength.TooLong
ImageFormat($image, Raylib::UNCOMPRESSED_R8G8B8A8);    // Format image to RGBA 32bit (required for texture update) <-- ISSUE
$texture = LoadTextureFromImage($image);       // Image converted to texture, GPU memory (VRAM)

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

SetTargetFPS(60);
//---------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {     // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------

    // Mouse toggle group logic
    for ($i = 0; $i < NUM_PROCESS; $i++) {
        if (CheckCollisionPointRec(GetMousePosition(), $toggleRecs[$i])) {
            $mouseHoverRec = $i;

            if (IsMouseButtonReleased(Raylib::MOUSE_LEFT_BUTTON)) {
                $currentProcess = $i;
                $textureReload = true;
            }

            break;
        } else {
            $mouseHoverRec = -1;
        }
    }

    // Keyboard toggle group logic
    if (IsKeyPressed(Raylib::KEY_DOWN)) {
        $currentProcess++;

        if ($currentProcess > 7) {
            $currentProcess = 0;
        }

        $textureReload = true;
    } elseif (IsKeyPressed(Raylib::KEY_UP)) {
        $currentProcess--;

        if ($currentProcess < 0) {
            $currentProcess = 7;
        }

        $textureReload = true;
    }

    // Reload texture when required
    if ($textureReload) {
        UnloadImage($image);                                           // Unload current image data
        $image = LoadImage(__DIR__ . '/resources/parrots.png');    // Re-load image data

        // NOTE: Image processing is a costly CPU process to be done every frame,
        // If image processing is required in a frame-basis, it should be done
        // with a texture and by shaders
        switch ($currentProcess) {
            case Raylib::COLOR_GRAYSCALE:
                ImageColorGrayscale($image);
                break;
            case Raylib::COLOR_TINT:
                ImageColorTint($image, Color::green());
                break;
            case Raylib::COLOR_INVERT:
                ImageColorInvert($image);
                break;
            case Raylib::COLOR_CONTRAST:
                ImageColorContrast($image, -40);
                break;
            case Raylib::COLOR_BRIGHTNESS:
                ImageColorBrightness($image, -80);
                break;
            case Raylib::FLIP_VERTICAL:
                ImageFlipVertical($image);
                break;
            case Raylib::FLIP_HORIZONTAL:
                ImageFlipHorizontal($image);
                break;
            default:
                break;
        }

        /**
         * @psalm-suppress DeprecatedMethod
         */
        $pixels = LoadImageColors($image);    // Get pixel data from image (RGBA 32bit)
        UpdateTexture($texture, $pixels);  // Update texture with new image data

        $textureReload = false;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    BeginDrawing();
        ClearBackground(Color::rayWhite());

        DrawText('IMAGE PROCESSING:', 40, 30, 10, Color::darkGray());

        // Draw rectangles
        for ($i = 0; $i < NUM_PROCESS; $i++) {
            DrawRectangleRec(
                $toggleRecs[$i],
                ($i == $currentProcess || $i == $mouseHoverRec) ? Color::skyBlue() : Color::lightGray()
            );

            DrawRectangleLines(
                (int) $toggleRecs[$i]->x,
                (int) $toggleRecs[$i]->y,
                (int) $toggleRecs[$i]->width,
                (int) $toggleRecs[$i]->height,
                ($i == $currentProcess || $i == $mouseHoverRec) ? Color::blue() : Color::gray()
            );

            DrawText(
                $processText[$i],
                (int) ($toggleRecs[$i]->x + $toggleRecs[$i]->width / 2 - MeasureText($processText[$i], 10) / 2),
                (int) $toggleRecs[$i]->y + 11,
                10,
                ($i === $currentProcess || $i === $mouseHoverRec) ? Color::darkBlue() : Color::darkGray()
            );
        }

        DrawTexture(
            $texture,
            $screenWidth - $texture->width - 60,
            (int) ($screenHeight / 2 - $texture->height / 2),
            Color::white()
        );
        DrawRectangleLines(
            $screenWidth - $texture->width - 60,
            $screenHeight / 2 - $texture->height / 2,
            $texture->width,
            $texture->height,
            Color::black()
        );
        //----------------------------------------------------------------------------------
    EndDrawing();
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($texture);   // Unload texture from VRAM
UnloadImage($image);    // Unload image from RAM

CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
