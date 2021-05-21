<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [shapes] example - basic shapes drawing');

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
// Update
//----------------------------------------------------------------------------------
// TODO: Update your variables here
//----------------------------------------------------------------------------------

// Draw
//----------------------------------------------------------------------------------
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawText('some basic shapes available on raylib', 20, 20, 20, Color::darkGray());

        $raylib->drawCircle((int) ($screenWidth / 4), 120, 35, Color::darkBlue());

        $raylib->drawRectangle((int) ($screenWidth / 4 * 2 - 60), 100, 120, 60, Color::red());
        // NOTE: Uses QUADS internally, not lines
        $raylib->drawRectangleLines((int) ($screenWidth / 4 * 2 - 40), 320, 80, 60, Color::orange());
        $raylib->drawRectangleGradientH(
            (int) ($screenWidth / 4 * 2 - 90),
            170,
            180,
            130,
            Color::maroon(),
            Color::gold(),
        );

        $raylib->drawTriangle(
            new Vector2($screenWidth / 4 * 3, 80),
            new Vector2($screenWidth / 4 * 3 - 60, 150),
            new Vector2($screenWidth / 4 * 3 + 60, 150),
            Color::violet(),
        );

        $raylib->drawPoly(new Vector2($screenWidth / 4 * 3, 320), 6, 80, 0, Color::brown());

        $raylib->drawCircleGradient((int) ($screenWidth / 4), 220, 60, Color::green(), Color::skyBlue());

        // NOTE: We draw all LINES based shapes together to optimize internal drawing,
        // this way, all LINES are rendered in a single draw pass
        $raylib->drawLine(18, 42, $screenWidth - 18, 42, Color::black());
        $raylib->drawCircleLines((int) ($screenWidth / 4), 340, 80, Color::darkBlue());
        $raylib->drawTriangleLines(
            new Vector2((int) ($screenWidth / 4 * 3), 160),
            new Vector2((int) ($screenWidth / 4 * 3 - 20), 230),
            new Vector2((int) ($screenWidth / 4 * 3 + 20), 230),
            Color::darkBlue(),
        );
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
