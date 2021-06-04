<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const MOUSE_SCALE_MARK_SIZE = 12;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [shapes] example - rectangle scaling mouse');

$rec = new Rectangle(100, 100, 200, 80);

$mouseScaleMode = false;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $mousePosition = $raylib->getMousePosition();

    if (
        $raylib->checkCollisionPointRec($mousePosition, $rec)
        && $raylib->checkCollisionPointRec(
            $mousePosition,
            new Rectangle(
                $rec->x + $rec->width - MOUSE_SCALE_MARK_SIZE,
                $rec->y + $rec->height - MOUSE_SCALE_MARK_SIZE,
                MOUSE_SCALE_MARK_SIZE,
                MOUSE_SCALE_MARK_SIZE,
            )
        )
    ) {
        $mouseScaleReady = true;
        if ($raylib->isMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
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

        if ($raylib->isMouseButtonReleased(Raylib::MOUSE_LEFT_BUTTON)) {
            $mouseScaleMode = false;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        $raylib->drawText('Scale rectangle dragging from bottom-right corner!', 10, 10, 20, Color::gray());

        $raylib->DrawRectangleRec($rec, $raylib->fade(Color::green(), 0.5));

        if ($mouseScaleReady) {
            $raylib->drawRectangleLinesEx($rec, 1, Color::red());
            $raylib->drawTriangle(
                new Vector2($rec->x + $rec->width - MOUSE_SCALE_MARK_SIZE, $rec->y + $rec->height),
                new Vector2($rec->x + $rec->width, $rec->y + $rec->height),
                new Vector2($rec->x + $rec->width, $rec->y + $rec->height - MOUSE_SCALE_MARK_SIZE),
                Color::red(),
            );
        }

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
