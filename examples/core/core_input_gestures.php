<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{
    Color,
    Rectangle
};

use function Nawarian\Raylib\{
    BeginDrawing,
    CheckCollisionPointRec,
    ClearBackground,
    CloseWindow,
    DrawCircleV,
    DrawRectangle,
    DrawRectangleLines,
    DrawRectangleRec,
    DrawText,
    EndDrawing,
    Fade,
    GetGestureDetected,
    GetTouchPosition,
    InitWindow,
    SetTargetFPS,
    WindowShouldClose
};

const MAX_GESTURE_STRINGS = 20;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, "raylib [core] example - input gestures");

$touchArea = new Rectangle(220, 10, $screenWidth - 230, $screenHeight - 20);

$gesturesCount = 0;
$gestureStrings = array_fill(0, MAX_GESTURE_STRINGS, []);

$currentGesture = Raylib::GESTURE_NONE;

//SetGesturesEnabled(0b0000000000001001);   // Enable only some gestures to be detected

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {    // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // Reset gestures strings
    if ($gesturesCount > MAX_GESTURE_STRINGS) {
        $gestureStrings = array_fill(0, MAX_GESTURE_STRINGS, '');
        $gesturesCount = 0;
    }

    $lastGesture = $currentGesture;
    $currentGesture = GetGestureDetected();
    $touchPosition = GetTouchPosition(0);

    if (CheckCollisionPointRec($touchPosition, $touchArea) && ($currentGesture !== Raylib::GESTURE_NONE)) {
        if ($currentGesture !== $lastGesture) {
            // Store gesture string
            switch ($currentGesture) {
                case Raylib::GESTURE_TAP:
                    $gestureStrings[$gesturesCount] = 'GESTURE TAP';
                    break;
                case Raylib::GESTURE_DOUBLETAP:
                    $gestureStrings[$gesturesCount] = 'GESTURE DOUBLETAP';
                    break;
                case Raylib::GESTURE_HOLD:
                    $gestureStrings[$gesturesCount] = 'GESTURE HOLD';
                    break;
                case Raylib::GESTURE_DRAG:
                    $gestureStrings[$gesturesCount] = 'GESTURE DRAG';
                    break;
                case Raylib::GESTURE_SWIPE_RIGHT:
                    $gestureStrings[$gesturesCount] = 'GESTURE SWIPE RIGHT';
                    break;
                case Raylib::GESTURE_SWIPE_LEFT:
                    $gestureStrings[$gesturesCount] = 'GESTURE SWIPE LEFT';
                    break;
                case Raylib::GESTURE_SWIPE_UP:
                    $gestureStrings[$gesturesCount] = 'GESTURE SWIPE UP';
                    break;
                case Raylib::GESTURE_SWIPE_DOWN:
                    $gestureStrings[$gesturesCount] = 'GESTURE SWIPE DOWN';
                    break;
                case Raylib::GESTURE_PINCH_IN:
                    $gestureStrings[$gesturesCount] = 'GESTURE PINCH IN';
                    break;
                case Raylib::GESTURE_PINCH_OUT:
                    $gestureStrings[$gesturesCount] = 'GESTURE PINCH OUT';
                    break;
            }

            $gesturesCount++;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        DrawRectangleRec($touchArea, Color::gray());
        DrawRectangle(225, 15, $screenWidth - 240, $screenHeight - 30, Color::rayWhite());

        DrawText("GESTURES TEST AREA", $screenWidth - 270, $screenHeight - 40, 20, Fade(Color::gray(), 0.5));

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        for ($i = 0; $i < $gesturesCount; ++$i) {
            if ($i % 2 === 0) {
                DrawRectangle(10, 30 + 20 * $i, 200, 20, Fade(Color::lightGray(), 0.5));
            } else {
                DrawRectangle(10, 30 + 20 * $i, 200, 20, Fade(Color::lightGray(), 0.3));
            }

            if ($i < $gesturesCount - 1 && $gestureStrings[$i]) {
                DrawText($gestureStrings[$i], 35, 36 + 20 * $i, 10, Color::darkGray());
            } elseif ($gestureStrings[$i]) {
                DrawText($gestureStrings[$i], 35, 36 + 20 * $i, 10, Color::maroon());
            }
        }

        DrawRectangleLines(10, 29, 200, $screenHeight - 50, Color::gray());
        DrawText("DETECTED GESTURES", 50, 15, 10, Color::gray());

        if ($currentGesture !== Raylib::GESTURE_NONE) {
            DrawCircleV($touchPosition, 30, Color::maroon());
        }
        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
