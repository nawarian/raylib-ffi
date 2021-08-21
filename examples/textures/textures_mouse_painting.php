<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Rectangle;
use Nawarian\Raylib\Types\RenderTexture2D;
use Nawarian\Raylib\Types\Vector2;

require_once  __DIR__ . '/../../vendor/autoload.php';

const MAX_COLORS_COUNT = 23;    // Number of colors available

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - mouse painting');

// Colours to choose from
$colors = [
    Color::rayWhite(), Color::yellow(), Color::gold(), Color::orange(),
    Color::pink(), Color::red(), Color::maroon(), Color::green(),
    Color::lime(), Color::darkGreen(), Color::skyBlue(), Color::blue(),
    Color::darkBlue(), Color::purple(), Color::violet(), Color::darkPurple(),
    Color::beige(), Color::brown(), Color::darkBrown(), Color::lightGray(),
    Color::gray(), Color::darkGray(), Color::black()
];

// Define colorsRecs data (for every rectangle)
$colorsRecs = [];

for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
    $colorsRecs[$i] = new Rectangle(
        (float) 10 + 30 * $i + 2 * $i,
        (float) 10,
        (float) 30,
        (float) 30
    );
}

$colorSelected = 0;
$colorSelectedPrev = $colorSelected;
$colorMouseHover = 0;
$brushSize = 0;

$btnSaveRec = new Rectangle((float) 750, (float) 10, (float) 40, (float) 30);

//Includes "_" for supress error from psalm checks for Unused Variable
$_btnSaveMouseHover = false;
$showSaveMessage = false;
$saveMessageCounter = 0;

// Create a RenderTexture2D to use as a canvas
$target = \Nawarian\Raylib\LoadRenderTexture($screenWidth, $screenHeight);

// Clear render texture before entering the game loop
\Nawarian\Raylib\BeginTextureMode(new RenderTexture2D(
    $target->id,
    $target->texture,
    $target->depth
));
\Nawarian\Raylib\ClearBackground($colors[0]);
\Nawarian\Raylib\EndTextureMode();

\Nawarian\Raylib\SetTargetFPS(120);     // Set our game to run at 120 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {      // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $mousePos = \Nawarian\Raylib\GetMousePosition();

    // Move between colors with keys
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_RIGHT)) {
        $colorSelected++;
    } elseif (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_LEFT)) {
        $colorSelected--;
    }

    if ($colorSelected >= MAX_COLORS_COUNT) {
        $colorSelected = MAX_COLORS_COUNT - 1;
    } elseif ($colorSelected < 0) {
        $colorSelected = 0;
    }

    // Choose color with mouse
    for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
        if (\Nawarian\Raylib\CheckCollisionPointRec($mousePos, $colorsRecs[$i])) {
            $colorMouseHover = $i;
            break;
        } else {
            $colorMouseHover = -1;
        }
    }

    if (($colorMouseHover >= 0) && \Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $colorSelected = $colorMouseHover;
        $colorSelectedPrev = $colorSelected;
    }

    // Change brush size
    $brushSize += \Nawarian\Raylib\GetMouseWheelMove() * 5;

    if ($brushSize < 2) {
        $brushSize = 2;
    }

    if ($brushSize > 50) {
        $brushSize = 50;
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_C)) {
        // Clear render texture to clear color
        \Nawarian\Raylib\BeginTextureMode($target);
        \Nawarian\Raylib\ClearBackground($colors[0]);
        \Nawarian\Raylib\EndTextureMode();
    }

    if (
        \Nawarian\Raylib\IsMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON) ||
        (\Nawarian\Raylib\GetGestureDetected() === Raylib::GESTURE_DRAG)
    ) {
        // Paint circle into render texture
        // NOTE: To avoid discontinuous circles, we could store
        // previous-next mouse points and just draw a line using brush size
        \Nawarian\Raylib\BeginTextureMode($target);

        if ($mousePos->y > 50) {
            \Nawarian\Raylib\DrawCircle((int) $mousePos->x, (int) $mousePos->y, $brushSize, $colors[$colorSelected]);
        }

        \Nawarian\Raylib\EndTextureMode();
    }

    if (\Nawarian\Raylib\IsMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
        $colorSelected = 0;

        // Erase circle from render texture
        \Nawarian\Raylib\BeginTextureMode($target);

        if ($mousePos->y > 50) {
            \Nawarian\Raylib\DrawCircle((int) $mousePos->x, (int) $mousePos->y, $brushSize, $colors[0]);
        }

        \Nawarian\Raylib\EndTextureMode();
    } else {
        $colorSelected = $colorSelectedPrev;
    }

    // Check mouse hover save button
    if (\Nawarian\Raylib\CheckCollisionPointRec($mousePos, $btnSaveRec)) {
        $btnSaveMouseHover = true;
    } else {
        $btnSaveMouseHover = false;
    }

    // Image saving logic
    // NOTE: Saving painted texture to a default named image
    if (
        ($btnSaveMouseHover && \Nawarian\Raylib\IsMouseButtonReleased(Raylib::MOUSE_LEFT_BUTTON)) ||
        \Nawarian\Raylib\IsKeyPressed(Raylib::KEY_S)
    ) {
        $image = \Nawarian\Raylib\GetTextureData($target->texture);
        \Nawarian\Raylib\ImageFlipVertical($image);
        \Nawarian\Raylib\ExportImage($image, __DIR__ . '/resources/my_amazing_texture_painting.png');
        \Nawarian\Raylib\UnloadImage($image);
        $showSaveMessage = true;
    }

    if ($showSaveMessage) {
        // On saving, show a full screen message for 2 seconds
        $saveMessageCounter++;

        if ($saveMessageCounter > 240) {
            $showSaveMessage = false;
            $saveMessageCounter = 0;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        // NOTE: Render texture must be y-flipped due to default OpenGL coordinates (left-bottom)
        \Nawarian\Raylib\DrawTextureRec($target->texture, new Rectangle(0.0, 0.0, (float) $target->texture->width, -$target->texture->height), new Vector2(0.0, 0.0), Color::white());

        // Draw drawing circle for reference
        if ($mousePos->y > 50) {
            if (\Nawarian\Raylib\IsMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
                \Nawarian\Raylib\DrawCircleLines((int) $mousePos->x, (int) $mousePos->y, $brushSize, Color::gray());
            } else {
                \Nawarian\Raylib\DrawCircle(\Nawarian\Raylib\GetMouseX(), \Nawarian\Raylib\GetMouseY(), $brushSize, $colors[$colorSelected]);
            }
        }

        // Draw top panel
        \Nawarian\Raylib\DrawRectangle(0.0, 0.0, \Nawarian\Raylib\GetScreenWidth(), 50.0, Color::rayWhite());
        \Nawarian\Raylib\DrawLine(0, 50, \Nawarian\Raylib\GetScreenWidth(), 50, Color::lightGray());

        // Draw color selection rectangles
        for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
            \Nawarian\Raylib\DrawRectangleRec($colorsRecs[$i], $colors[$i]);
        }

        \Nawarian\Raylib\DrawRectangleLines(10.0, 10.0, 30.0, 30.0, Color::lightGray());

        if ($colorMouseHover >= 0) {
            \Nawarian\Raylib\DrawRectangleRec($colorsRecs[$colorMouseHover], \Nawarian\Raylib\Fade(Color::white(), 0.6));
        }

        \Nawarian\Raylib\DrawRectangleLinesEx(new Rectangle(
            $colorsRecs[$colorSelected]->x - 2,
            $colorsRecs[$colorSelected]->y - 2,
            $colorsRecs[$colorSelected]->width + 4,
            $colorsRecs[$colorSelected]->height + 4
        ), 2, Color::black());

        // Draw save image button
        \Nawarian\Raylib\DrawRectangleLinesEx($btnSaveRec, 2, $btnSaveMouseHover ? Color::red() : Color::black());
        \Nawarian\Raylib\DrawText('SAVE!', 755, 20, 10, $btnSaveMouseHover ? Color::red() : Color::black());

        // Draw save image message
        if ($showSaveMessage) {
            \Nawarian\Raylib\DrawRectangle(0.0, 0.0, (float) \Nawarian\Raylib\GetScreenWidth(), (float) \Nawarian\Raylib\GetScreenHeight(), \Nawarian\Raylib\Fade(Color::rayWhite(), 0.8));

            \Nawarian\Raylib\DrawRectangle(0.0, 150.0, (float) \Nawarian\Raylib\GetScreenWidth(), 80.0, Color::black());

            \Nawarian\Raylib\DrawText('IMAGE SAVED:  my_amazing_texture_painting.png', 150, 180, 20, Color::rayWhite());
        }
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadRenderTexture($target);      // Unload render texture

\Nawarian\Raylib\CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
