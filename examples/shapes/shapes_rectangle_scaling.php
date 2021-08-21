<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

use function Nawarian\Raylib\{
    BeginDrawing,
    CheckCollisionPointRec,
    ClearBackground,
    CloseWindow,
    DrawRectangleLinesEx,
    DrawRectangleRec,
    DrawText,
    DrawTriangle,
    EndDrawing,
    Fade,
    GetMousePosition,
    InitWindow,
    IsMouseButtonPressed,
    IsMouseButtonReleased,
    SetTargetFPS,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

const MOUSE_SCALE_MARK_SIZE = 12;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - rectangle scaling mouse');

$rec = new Rectangle(100, 100, 200, 80);

$mouseScaleMode = false;

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $mousePosition = GetMousePosition();

    if (
        CheckCollisionPointRec($mousePosition, $rec)
        && CheckCollisionPointRec($mousePosition, new Rectangle(
            $rec->x + $rec->width - MOUSE_SCALE_MARK_SIZE,
            $rec->y + $rec->height - MOUSE_SCALE_MARK_SIZE,
            MOUSE_SCALE_MARK_SIZE,
            MOUSE_SCALE_MARK_SIZE,
        ))
    ) {
        $mouseScaleReady = true;
        if (IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
            $mouseScaleMode = true;
        }
    } else {
        $mouseScaleReady = false;
    }

    if ($mouseScaleMode) {
        $mouseScaleReady = true;

        $rec->width = ($mousePosition->x - $rec->x);
        $rec->height = ($mousePosition->y - $rec->y);

        if ($rec->width < MOUSE_SCALE_MARK_SIZE) {
            $rec->width = MOUSE_SCALE_MARK_SIZE;
        }
        if ($rec->height < MOUSE_SCALE_MARK_SIZE) {
            $rec->height = MOUSE_SCALE_MARK_SIZE;
        }

        if (IsMouseButtonReleased(Raylib::MOUSE_LEFT_BUTTON)) {
            $mouseScaleMode = false;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();
        ClearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        DrawText('Scale rectangle dragging from bottom-right corner!', 10, 10, 20, Color::gray());

        DrawRectangleRec($rec, Fade(Color::green(), 0.5));

        if ($mouseScaleReady) {
            DrawRectangleLinesEx($rec, 1, Color::red());
            DrawTriangle(
                new Vector2($rec->x + $rec->width - MOUSE_SCALE_MARK_SIZE, $rec->y + $rec->height),
                new Vector2($rec->x + $rec->width, $rec->y + $rec->height),
                new Vector2($rec->x + $rec->width, $rec->y + $rec->height - MOUSE_SCALE_MARK_SIZE),
                Color::red()
            );
        }

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
