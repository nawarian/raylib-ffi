<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Rectangle, RenderTexture2D, Vector2};

use function Nawarian\Raylib\{
    BeginDrawing,
    BeginTextureMode,
    CheckCollisionPointRec,
    ClearBackground,
    CloseWindow,
    DrawCircle,
    DrawCircleLines,
    DrawLine,
    DrawRectangle,
    DrawRectangleLines,
    DrawRectangleLinesEx,
    DrawRectangleRec,
    DrawText,
    DrawTextureRec,
    EndDrawing,
    EndTextureMode,
    ExportImage,
    Fade,
    GetGestureDetected,
    GetMousePosition,
    GetMouseWheelMove,
    GetMouseX,
    GetMouseY,
    GetScreenHeight,
    GetScreenWidth,
    GetTextureData,
    ImageFlipVertical,
    InitWindow,
    IsKeyPressed,
    IsMouseButtonDown,
    IsMouseButtonPressed,
    IsMouseButtonReleased,
    LoadRenderTexture,
    SetTargetFPS,
    UnloadImage,
    UnloadRenderTexture,
    WindowShouldClose
};

require_once  __DIR__ . '/../../vendor/autoload.php';

const MAX_COLORS_COUNT = 23;    // Number of colors available

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - mouse painting');

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
$target = LoadRenderTexture($screenWidth, $screenHeight);

// Clear render texture before entering the game loop
BeginTextureMode(new RenderTexture2D(
    $target->id,
    $target->texture,
    $target->depth
));
ClearBackground($colors[0]);
EndTextureMode();

SetTargetFPS(120);     // Set our game to run at 120 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {      // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $mousePos = GetMousePosition();

    // Move between colors with keys
    if (IsKeyPressed(Raylib::KEY_RIGHT)) {
        $colorSelected++;
    } elseif (IsKeyPressed(Raylib::KEY_LEFT)) {
        $colorSelected--;
    }

    if ($colorSelected >= MAX_COLORS_COUNT) {
        $colorSelected = MAX_COLORS_COUNT - 1;
    } elseif ($colorSelected < 0) {
        $colorSelected = 0;
    }

    // Choose color with mouse
    for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
        if (CheckCollisionPointRec($mousePos, $colorsRecs[$i])) {
            $colorMouseHover = $i;
            break;
        } else {
            $colorMouseHover = -1;
        }
    }

    if (($colorMouseHover >= 0) && IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $colorSelected = $colorMouseHover;
        $colorSelectedPrev = $colorSelected;
    }

    // Change brush size
    $brushSize += GetMouseWheelMove() * 5;

    if ($brushSize < 2) {
        $brushSize = 2;
    }

    if ($brushSize > 50) {
        $brushSize = 50;
    }

    if (IsKeyPressed(Raylib::KEY_C)) {
        // Clear render texture to clear color
        BeginTextureMode($target);
        ClearBackground($colors[0]);
        EndTextureMode();
    }

    if (
        IsMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON) ||
        (GetGestureDetected() === Raylib::GESTURE_DRAG)
    ) {
        // Paint circle into render texture
        // NOTE: To avoid discontinuous circles, we could store
        // previous-next mouse points and just draw a line using brush size
        BeginTextureMode($target);

        if ($mousePos->y > 50) {
            DrawCircle((int) $mousePos->x, (int) $mousePos->y, $brushSize, $colors[$colorSelected]);
        }

        EndTextureMode();
    }

    if (IsMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
        $colorSelected = 0;

        // Erase circle from render texture
        BeginTextureMode($target);

        if ($mousePos->y > 50) {
            DrawCircle((int) $mousePos->x, (int) $mousePos->y, $brushSize, $colors[0]);
        }

        EndTextureMode();
    } else {
        $colorSelected = $colorSelectedPrev;
    }

    // Check mouse hover save button
    if (CheckCollisionPointRec($mousePos, $btnSaveRec)) {
        $btnSaveMouseHover = true;
    } else {
        $btnSaveMouseHover = false;
    }

    // Image saving logic
    // NOTE: Saving painted texture to a default named image
    if (
        ($btnSaveMouseHover && IsMouseButtonReleased(Raylib::MOUSE_LEFT_BUTTON)) ||
        IsKeyPressed(Raylib::KEY_S)
    ) {
        $image = GetTextureData($target->texture);
        ImageFlipVertical($image);
        ExportImage($image, __DIR__ . '/resources/my_amazing_texture_painting.png');
        UnloadImage($image);
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
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        // NOTE: Render texture must be y-flipped due to default OpenGL coordinates (left-bottom)
        DrawTextureRec(
            $target->texture,
            new Rectangle(0.0, 0.0, (float) $target->texture->width, -$target->texture->height),
            new Vector2(0.0, 0.0),
            Color::white()
        );

        // Draw drawing circle for reference
        if ($mousePos->y > 50) {
            if (IsMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
                DrawCircleLines((int) $mousePos->x, (int) $mousePos->y, $brushSize, Color::gray());
            } else {
                DrawCircle(GetMouseX(), GetMouseY(), $brushSize, $colors[$colorSelected]);
            }
        }

        // Draw top panel
        DrawRectangle(0.0, 0.0, GetScreenWidth(), 50.0, Color::rayWhite());
        DrawLine(0, 50, GetScreenWidth(), 50, Color::lightGray());

        // Draw color selection rectangles
        for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
            DrawRectangleRec($colorsRecs[$i], $colors[$i]);
        }

        DrawRectangleLines(10.0, 10.0, 30.0, 30.0, Color::lightGray());

        if ($colorMouseHover >= 0) {
            DrawRectangleRec($colorsRecs[$colorMouseHover], Fade(Color::white(), 0.6));
        }

        DrawRectangleLinesEx(new Rectangle(
            $colorsRecs[$colorSelected]->x - 2,
            $colorsRecs[$colorSelected]->y - 2,
            $colorsRecs[$colorSelected]->width + 4,
            $colorsRecs[$colorSelected]->height + 4
        ), 2, Color::black());

        // Draw save image button
        DrawRectangleLinesEx($btnSaveRec, 2, $btnSaveMouseHover ? Color::red() : Color::black());
        DrawText('SAVE!', 755, 20, 10, $btnSaveMouseHover ? Color::red() : Color::black());

        // Draw save image message
        if ($showSaveMessage) {
            DrawRectangle(0.0, 0.0, (float) GetScreenWidth(), (float) GetScreenHeight(), Fade(Color::rayWhite(), 0.8));

            DrawRectangle(0.0, 150.0, (float) GetScreenWidth(), 80.0, Color::black());

            DrawText('IMAGE SAVED:  my_amazing_texture_painting.png', 150, 180, 20, Color::rayWhite());
        }
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadRenderTexture($target);      // Unload render texture

CloseWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
