<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\{
    Raylib,
    RaylibFactory,
};
use Nawarian\Raylib\Types\Color;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

const MAX_TOUCH_POINTS = 10;
\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, "raylib [core] example - input multitouch");

$touchCounter = 0;
\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//---------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $ballPosition = \Nawarian\Raylib\GetMousePosition();

    $ballColor = Color::beige();

    if (\Nawarian\Raylib\IsMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON)) {
        $ballColor = Color::maroon();
    }

    if (\Nawarian\Raylib\IsMouseButtonDown(Raylib::MOUSE_MIDDLE_BUTTON)) {
        $ballColor = Color::lime();
    }

    if (\Nawarian\Raylib\IsMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
        $ballColor = Color::darkBlue();
    }

    if (\Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $touchCounter = 10;
    }

    if (\Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_MIDDLE_BUTTON)) {
        $touchCounter = 10;
    }

    if (\Nawarian\Raylib\IsMouseButtonPressed(Raylib::MOUSE_RIGHT_BUTTON)) {
        $touchCounter = 10;
    }

    if ($touchCounter > 0) {
        $touchCounter--;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        // Multitouch
        for ($i = 0; $i < MAX_TOUCH_POINTS; ++$i) {
            $touchPosition = \Nawarian\Raylib\GetTouchPosition($i);                    // Get the touch point

            // Make sure point is not (-1,-1) as this means there is no touch for it
            if (($touchPosition->x >= 0) && ($touchPosition->y >= 0)) {
                // Draw circle and touch index number
                \Nawarian\Raylib\DrawCircleV($touchPosition, 34, Color::orange());
                \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextFormat("%d", $i), (int) ($touchPosition->x - 10), (int) ($touchPosition->y - 70), 40, Color::black());
            }
        }

        // Draw the normal mouse location
        \Nawarian\Raylib\DrawCircleV($ballPosition, 30 + ($touchCounter * 3), $ballColor);

        \Nawarian\Raylib\DrawText("move ball with mouse and click mouse button to change color", 10, 10, 20, Color::darkGray());

        \Nawarian\Raylib\DrawText("touch the screen at multiple locations to get multiple balls", 10, 30, 20, Color::darkGray());

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
