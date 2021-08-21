<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{
    Color,
    Rectangle,
};

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [core] example - scissor test');

$scissorArea = new Rectangle(0, 0, 300, 300);
$scissorMode = true;

\Nawarian\Raylib\SetTargetFPS(60); // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_S)) {
        $scissorMode = !$scissorMode;
    }

    // Centre the scissor area around the mouse position
    $scissorArea->x = \Nawarian\Raylib\GetMouseX() - $scissorArea->width / 2;
    $scissorArea->y = \Nawarian\Raylib\GetMouseY() - $scissorArea->height / 2;
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        if ($scissorMode) {
            \Nawarian\Raylib\BeginScissorMode((int) $scissorArea->x, (int) $scissorArea->y, (int) $scissorArea->width, (int) $scissorArea->height);
        }

        // Draw full screen rectangle and some text
        // NOTE: Only part defined by scissor area will be rendered
        \Nawarian\Raylib\DrawRectangle(0, 0, \Nawarian\Raylib\GetScreenWidth(), \Nawarian\Raylib\GetScreenHeight(), Color::red());
        \Nawarian\Raylib\DrawText('Move the mouse around to reveal this text!', 190, 200, 20, Color::lightGray());

        if ($scissorMode) {
            \Nawarian\Raylib\EndScissorMode();
        }

        \Nawarian\Raylib\DrawRectangleLinesEx($scissorArea, 1, Color::black());
        \Nawarian\Raylib\DrawText('Press S to toggle scissor test', 10, 10, 20, Color::black());

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow(); // Close window and OpenGL context
//--------------------------------------------------------------------------------------
