<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Rectangle};

use function Nawarian\Raylib\{
    BeginDrawing,
    CheckCollisionPointRec,
    ClearBackground,
    CloseWindow,
    DrawRectangle,
    DrawRectangleLinesEx,
    DrawRectangleRec,
    DrawText,
    EndDrawing,
    Fade,
    GetMousePosition,
    GetScreenHeight,
    GetScreenWidth,
    InitWindow,
    IsKeyDown,
    MeasureText,
    SetTargetFPS,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

const MAX_COLORS_COUNT = 21;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - colors palette');

$colors = [
    Color::darkGray(),
    Color::maroon(),
    Color::orange(),
    Color::darkGreen(),
    Color::darkBlue(),
    Color::darkPurple(),
    Color::darkBrown(),
    Color::gray(),
    Color::red(),
    Color::gold(),
    Color::lime(),
    Color::blue(),
    Color::violet(),
    Color::brown(),
    Color::lightGray(),
    Color::pink(),
    Color::yellow(),
    Color::green(),
    Color::skyBlue(),
    Color::purple(),
    Color::beige(),
];

$colorNames = [
    'DARKGRAY', 'MAROON', 'ORANGE', 'DARKGREEN', 'DARKBLUE', 'DARKPURPLE',
    'DARKBROWN', 'GRAY', 'RED', 'GOLD', 'LIME', 'BLUE', 'VIOLET', 'BROWN',
    'LIGHTGRAY', 'PINK', 'YELLOW', 'GREEN', 'SKYBLUE', 'PURPLE', 'BEIGE',
];

$colorsRecs = []; // Rectangles array
// Fills colorsRecs data (for every rectangle)
for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
    $colorsRecs[$i] = new Rectangle(
        20 + 100 * ($i % 7) + 10 * ($i % 7),
        80 + 100 * ((int) ($i / 7)) + 10 * ((int) ($i / 7)),
        100,
        100,
    );
}

$colorState = array_fill(0, MAX_COLORS_COUNT, 0); // Color state: 0-DEFAULT, 1-MOUSE_HOVER

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $mousePoint = GetMousePosition();

    for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
        if (CheckCollisionPointRec($mousePoint, $colorsRecs[$i])) {
            $colorState[$i] = 1;
        } else {
            $colorState[$i] = 0;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        ClearBackground(Color::rayWhite());

        DrawText('raylib colors palette', 28, 42, 20, Color::blue());
        DrawText('press SPACE to see all colors', GetScreenWidth() - 180, GetScreenHeight() - 40, 10, Color::gray());

        for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {   // Draw all rectangles
            DrawRectangleRec($colorsRecs[$i], Fade($colors[$i], $colorState[$i] ? 0.6 : 1.0));
            if (IsKeyDown(Raylib::KEY_SPACE) || $colorState[$i]) {
                DrawRectangle(
                    $colorsRecs[$i]->x,
                    $colorsRecs[$i]->y + $colorsRecs[$i]->height - 26,
                    $colorsRecs[$i]->width,
                    20,
                    Color::black()
                );
                DrawRectangleLinesEx($colorsRecs[$i], 6, Fade(Color::black(), 0.3));
                DrawText(
                    $colorNames[$i],
                    (int) (MeasureText($colorNames[$i], 10) - $colorsRecs[$i]->x + $colorsRecs[$i]->width - 12),
                    (int) ($colorsRecs[$i]->y + $colorsRecs[$i]->height - 20),
                    10,
                    $colors[$i]
                );
            }
        }

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();                // Close window and OpenGL context
//--------------------------------------------------------------------------------------
