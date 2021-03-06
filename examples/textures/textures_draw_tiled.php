<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

use function Nawarian\Raylib\{
    BeginDrawing,
    CheckCollisionPointRec,
    ClearBackground,
    CloseWindow,
    ColorAlpha,
    DrawRectangle,
    DrawRectangleLinesEx,
    DrawRectangleRec,
    DrawText,
    DrawTexture,
    DrawTextureTiled,
    EndDrawing,
    GetFPS,
    GetMousePosition,
    GetScreenHeight,
    GetScreenWidth,
    InitWindow,
    IsKeyPressed,
    IsMouseButtonPressed,
    LoadTexture,
    SetConfigFlags,
    SetTargetFPS,
    SetTextureFilter,
    TextFormat,
    UnloadTexture,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

const OPT_WIDTH = 220;
const MARGIN_SIZE = 8;
const COLOR_SIZE = 16;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

SetConfigFlags(Raylib::FLAG_WINDOW_RESIZABLE); // Make the window resizable
InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - Draw part of a texture tiled');

// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)
$texPattern = LoadTexture(__DIR__ . '/resources/patterns.png');
SetTextureFilter($texPattern, Raylib::FILTER_TRILINEAR); // Makes the texture smoother when upscaled

// Coordinates for all patterns inside the texture
$recPattern = [
    new Rectangle(3, 3, 66, 66),
    new Rectangle(75, 3, 100, 100),
    new Rectangle(3, 75, 66, 66),
    new Rectangle(7, 156, 50, 50),
    new Rectangle(85, 106, 90, 45),
    new Rectangle(75, 154, 100, 600),
];

// Setup colors
$colors = [
    Color::black(),
    Color::maroon(),
    Color::orange(),
    Color::blue(),
    Color::purple(),
    Color::beige(),
    Color::lime(),
    Color::red(),
    Color::darkGray(),
    Color::skyBlue(),
];

$colorRec = [];

// Calculate rectangle for each color
$x = 0;
$y = 0;
for ($i = 0; $i < count($colors); $i++) {
    $colorRec[$i] = new Rectangle(0, 0, 0, 0);
    $colorRec[$i]->x = 2 + MARGIN_SIZE + $x;
    $colorRec[$i]->y = 22 + 256 + MARGIN_SIZE + $y;
    $colorRec[$i]->width = COLOR_SIZE * 2;
    $colorRec[$i]->height = COLOR_SIZE;

    if ($i == (count($colors) / 2 - 1)) {
        $x = 0;
        $y += COLOR_SIZE + MARGIN_SIZE;
    } else {
        $x += (COLOR_SIZE * 2 + MARGIN_SIZE);
    }
}

$activePattern = 0;
$activeCol = 0;
$scale = 1.0;
$rotation = 0.0;

SetTargetFPS(60);
//---------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $screenWidth = GetScreenWidth();
    $screenHeight = GetScreenHeight();

    // Handle mouse
    if (IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $mouse = GetMousePosition();

        // Check which pattern was clicked and set it as the active pattern
        for ($i = 0; $i < count($recPattern); $i++) {
            if (
                CheckCollisionPointRec($mouse, new Rectangle(
                    2 + MARGIN_SIZE + $recPattern[$i]->x,
                    40 + MARGIN_SIZE + $recPattern[$i]->y,
                    $recPattern[$i]->width,
                    $recPattern[$i]->height,
                ))
            ) {
                $activePattern = $i;
                break;
            }
        }

        // Check to see which color was clicked and set it as the active color
        for ($i = 0; $i < count($colorRec); ++$i) {
            if (CheckCollisionPointRec($mouse, $colorRec[$i])) {
                $activeCol = $i;
                break;
            }
        }
    }

    // Handle keys

    // Change scale
    if (IsKeyPressed(Raylib::KEY_UP)) {
        $scale += 0.25;
    }

    if (IsKeyPressed(Raylib::KEY_DOWN)) {
        $scale -= 0.25;
    }

    if ($scale > 10.0) {
        $scale = 10.0;
    } elseif ($scale <= 0.0) {
        $scale = 0.25;
    }

    // Change rotation
    if (IsKeyPressed(Raylib::KEY_LEFT)) {
        $rotation -= 25.0;
    }

    if (IsKeyPressed(Raylib::KEY_RIGHT)) {
        $rotation += 25.0;
    }

    // Reset
    if (IsKeyPressed(Raylib::KEY_SPACE)) {
        $rotation = 0.0;
        $scale = 1.0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();
        ClearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        // Draw the tiled area
        DrawTextureTiled($texPattern, $recPattern[$activePattern], new Rectangle(
            OPT_WIDTH + MARGIN_SIZE,
            MARGIN_SIZE,
            $screenWidth - OPT_WIDTH - 2 * MARGIN_SIZE,
            $screenHeight - 2 * MARGIN_SIZE,
        ), new Vector2(0, 0), $rotation, $scale, $colors[$activeCol]);

        // Draw options
        DrawRectangle(
            MARGIN_SIZE,
            MARGIN_SIZE,
            OPT_WIDTH - MARGIN_SIZE,
            $screenHeight - 2 * MARGIN_SIZE,
            ColorAlpha(Color::lightGray(), 0.5)
        );

        DrawText('Select Pattern', 2 + MARGIN_SIZE, 30 + MARGIN_SIZE, 10, Color::black());
        DrawTexture($texPattern, 2 + MARGIN_SIZE, 40 + MARGIN_SIZE, Color::black());
        DrawRectangle(
            2 + MARGIN_SIZE + $recPattern[$activePattern]->x,
            40 + MARGIN_SIZE + $recPattern[$activePattern]->y,
            $recPattern[$activePattern]->width,
            $recPattern[$activePattern]->height,
            ColorAlpha(Color::darkBlue(), 0.3)
        );

        DrawText('Select Color', 2 + MARGIN_SIZE, 10 + 256 + MARGIN_SIZE, 10, Color::black());
        for ($i = 0; $i < count($colors); $i++) {
            DrawRectangleRec($colorRec[$i], $colors[$i]);
            if ($activeCol === $i) {
                DrawRectangleLinesEx($colorRec[$i], 3, ColorAlpha(Color::white(), 0.5));
            }
        }

        DrawText('Scale (UP/DOWN to change)', 2 + MARGIN_SIZE, 80 + 256 + MARGIN_SIZE, 10, Color::black());
        DrawText(TextFormat('%.2fx', $scale), 2 + MARGIN_SIZE, 92 + 256 + MARGIN_SIZE, 20, Color::black());

        DrawText('Rotation (LEFT/RIGHT to change)', 2 + MARGIN_SIZE, 122 + 256 + MARGIN_SIZE, 10, Color::black());
        DrawText(TextFormat('%.0f degrees', $rotation), 2 + MARGIN_SIZE, 134 + 256 + MARGIN_SIZE, 20, Color::black());

        DrawText('Press [SPACE] to reset', 2 + MARGIN_SIZE, 164 + 256 + MARGIN_SIZE, 10, Color::darkBlue());

        // Draw FPS
        DrawText(TextFormat('%d FPS', GetFPS()), 2 + MARGIN_SIZE, 2 + MARGIN_SIZE, 20, Color::black());

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($texPattern);        // Unload texture

CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
