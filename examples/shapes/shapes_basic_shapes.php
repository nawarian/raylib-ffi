<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - basic shapes drawing');

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
// Update
//----------------------------------------------------------------------------------
// TODO: Update your variables here
//----------------------------------------------------------------------------------

// Draw
//----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        \Nawarian\Raylib\DrawText('some basic shapes available on raylib', 20, 20, 20, Color::darkGray());

        \Nawarian\Raylib\DrawCircle((int) ($screenWidth / 4), 120, 35, Color::darkBlue());

        \Nawarian\Raylib\DrawRectangle((int) ($screenWidth / 4 * 2 - 60), 100, 120, 60, Color::red());
        // NOTE: Uses QUADS internally, not lines
        \Nawarian\Raylib\DrawRectangleLines((int) ($screenWidth / 4 * 2 - 40), 320, 80, 60, Color::orange());
        \Nawarian\Raylib\DrawRectangleGradientH((int) ($screenWidth / 4 * 2 - 90), 170, 180, 130, Color::maroon(), Color::gold());

        \Nawarian\Raylib\DrawTriangle(new Vector2($screenWidth / 4 * 3, 80), new Vector2($screenWidth / 4 * 3 - 60, 150), new Vector2($screenWidth / 4 * 3 + 60, 150), Color::violet());

        \Nawarian\Raylib\DrawPoly(new Vector2($screenWidth / 4 * 3, 320), 6, 80, 0, Color::brown());

        \Nawarian\Raylib\DrawCircleGradient((int) ($screenWidth / 4), 220, 60, Color::green(), Color::skyBlue());

        // NOTE: We draw all LINES based shapes together to optimize internal drawing,
        // this way, all LINES are rendered in a single draw pass
        \Nawarian\Raylib\DrawLine(18, 42, $screenWidth - 18, 42, Color::black());
        \Nawarian\Raylib\DrawCircleLines((int) ($screenWidth / 4), 340, 80, Color::darkBlue());
        \Nawarian\Raylib\DrawTriangleLines(new Vector2((int) ($screenWidth / 4 * 3), 160), new Vector2((int) ($screenWidth / 4 * 3 - 20), 230), new Vector2((int) ($screenWidth / 4 * 3 + 20), 230), Color::darkBlue());
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
