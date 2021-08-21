<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

const MOUSE_SCALE_MARK_SIZE = 12;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - rectangle scaling mouse');

$rec = new Rectangle(100, 100, 200, 80);

$mouseScaleMode = false;

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $mousePosition = \Nawarian\Raylib\GetMousePosition();

    if (
        \Nawarian\Raylib\CheckCollisionPointRec($mousePosition, $rec)
        && \Nawarian\Raylib\CheckCollisionPointRec($mousePosition, new Rectangle(
            $rec->x + $rec->width - MOUSE_SCALE_MARK_SIZE,
            $rec->y + $rec->height - MOUSE_SCALE_MARK_SIZE,
            MOUSE_SCALE_MARK_SIZE,
            MOUSE_SCALE_MARK_SIZE,
        ))
    ) {
        $mouseScaleReady = true;
        if (\Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
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

        if (\Nawarian\Raylib\IsMouseButtonReleased(Raylib::MOUSE_LEFT_BUTTON)) {
            $mouseScaleMode = false;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        \Nawarian\Raylib\DrawText('Scale rectangle dragging from bottom-right corner!', 10, 10, 20, Color::gray());

        \Nawarian\Raylib\DrawRectangleRec($rec, \Nawarian\Raylib\Fade(Color::green(), 0.5));

        if ($mouseScaleReady) {
            \Nawarian\Raylib\DrawRectangleLinesEx($rec, 1, Color::red());
            \Nawarian\Raylib\DrawTriangle(new Vector2($rec->x + $rec->width - MOUSE_SCALE_MARK_SIZE, $rec->y + $rec->height), new Vector2($rec->x + $rec->width, $rec->y + $rec->height), new Vector2($rec->x + $rec->width, $rec->y + $rec->height - MOUSE_SCALE_MARK_SIZE), Color::red());
        }

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
