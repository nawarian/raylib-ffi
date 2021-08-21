<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\Color;

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawCircleV,
    DrawText,
    EndDrawing,
    GetMousePosition,
    GetTouchPosition,
    InitWindow,
    IsMouseButtonDown,
    IsMouseButtonPressed,
    SetTargetFPS,
    TextFormat,
    WindowShouldClose
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

const MAX_TOUCH_POINTS = 10;
InitWindow($screenWidth, $screenHeight, "raylib [core] example - input multitouch");

$touchCounter = 0;
SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//---------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $ballPosition = GetMousePosition();

    $ballColor = Color::beige();

    if (IsMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON)) {
        $ballColor = Color::maroon();
    }

    if (IsMouseButtonDown(Raylib::MOUSE_MIDDLE_BUTTON)) {
        $ballColor = Color::lime();
    }

    if (IsMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
        $ballColor = Color::darkBlue();
    }

    if (IsMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $touchCounter = 10;
    }

    if (IsMouseButtonPressed(Raylib::MOUSE_MIDDLE_BUTTON)) {
        $touchCounter = 10;
    }

    if (IsMouseButtonPressed(Raylib::MOUSE_RIGHT_BUTTON)) {
        $touchCounter = 10;
    }

    if ($touchCounter > 0) {
        $touchCounter--;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        ClearBackground(Color::rayWhite());

        // Multitouch
        for ($i = 0; $i < MAX_TOUCH_POINTS; ++$i) {
            $touchPosition = GetTouchPosition($i);                    // Get the touch point

            // Make sure point is not (-1,-1) as this means there is no touch for it
            if (($touchPosition->x >= 0) && ($touchPosition->y >= 0)) {
                // Draw circle and touch index number
                DrawCircleV($touchPosition, 34, Color::orange());
                DrawText(
                    TextFormat("%d", $i),
                    (int) ($touchPosition->x - 10),
                    (int) ($touchPosition->y - 70),
                    40,
                    Color::black()
                );
            }
        }

        // Draw the normal mouse location
        DrawCircleV($ballPosition, 30 + ($touchCounter * 3), $ballColor);

        DrawText("move ball with mouse and click mouse button to change color", 10, 10, 20, Color::darkGray());

        DrawText("touch the screen at multiple locations to get multiple balls", 10, 30, 20, Color::darkGray());

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
