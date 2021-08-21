<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{
    Color,
    Rectangle,
};

use function Nawarian\Raylib\{
    BeginDrawing,
    BeginScissorMode,
    ClearBackground,
    CloseWindow,
    DrawRectangle,
    DrawRectangleLinesEx,
    DrawText,
    EndDrawing,
    EndScissorMode,
    GetMouseX,
    GetMouseY,
    GetScreenHeight,
    GetScreenWidth,
    InitWindow,
    IsKeyPressed,
    SetTargetFPS,
    WindowShouldClose
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [core] example - scissor test');

$scissorArea = new Rectangle(0, 0, 300, 300);
$scissorMode = true;

SetTargetFPS(60); // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (IsKeyPressed(Raylib::KEY_S)) {
        $scissorMode = !$scissorMode;
    }

    // Centre the scissor area around the mouse position
    $scissorArea->x = GetMouseX() - $scissorArea->width / 2;
    $scissorArea->y = GetMouseY() - $scissorArea->height / 2;
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        if ($scissorMode) {
            BeginScissorMode(
                (int) $scissorArea->x,
                (int) $scissorArea->y,
                (int) $scissorArea->width,
                (int) $scissorArea->height
            );
        }

        // Draw full screen rectangle and some text
        // NOTE: Only part defined by scissor area will be rendered
        DrawRectangle(0, 0, GetScreenWidth(), GetScreenHeight(), Color::red());
        DrawText('Move the mouse around to reveal this text!', 190, 200, 20, Color::lightGray());

        if ($scissorMode) {
            EndScissorMode();
        }

        DrawRectangleLinesEx($scissorArea, 1, Color::black());
        DrawText('Press S to toggle scissor test', 10, 10, 20, Color::black());

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
CloseWindow(); // Close window and OpenGL context
//--------------------------------------------------------------------------------------
