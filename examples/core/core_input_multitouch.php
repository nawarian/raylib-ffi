<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Vector2;

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

const MAX_TOUCH_POINTS = 10;
$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - input multitouch");

$ballPosition = new Vector2(-100, -100);

$touchCounter = 0;
$touchPosition = new Vector2(0, 0);

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//---------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $ballPosition = $raylib->getMousePosition();

    $ballColor = Color::beige();

    if ($raylib->isMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON)) {
        $ballColor = Color::maroon();
    }

    if ($raylib->isMouseButtonDown(Raylib::MOUSE_MIDDLE_BUTTON)) {
        $ballColor = Color::lime();
    }

    if ($raylib->isMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
        $ballColor = Color::darkBlue();
    }

    if ($raylib->isMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $touchCounter = 10;
    }

    if ($raylib->isMouseButtonPressed(Raylib::MOUSE_MIDDLE_BUTTON)) {
        $touchCounter = 10;
    }

    if ($raylib->isMouseButtonPressed(Raylib::MOUSE_RIGHT_BUTTON)) {
        $touchCounter = 10;
    }

    if ($touchCounter > 0) {
        $touchCounter--;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        $raylib->clearBackground(Color::rayWhite());

        // Multitouch
        for ($i = 0; $i < MAX_TOUCH_POINTS; ++$i) {
            $touchPosition = $raylib->getTouchPosition($i);                    // Get the touch point

            // Make sure point is not (-1,-1) as this means there is no touch for it
            if (($touchPosition->x >= 0) && ($touchPosition->y >= 0)) {
                // Draw circle and touch index number
                $raylib->drawCircleV($touchPosition, 34, Color::orange());
                $raylib->drawText(
                    $raylib->textFormat("%d", $i),
                    (int) ($touchPosition->x - 10),
                    (int) ($touchPosition->y - 70),
                    40,
                    Color::black(),
                );
            }
        }

        // Draw the normal mouse location
        $raylib->drawCircleV($ballPosition, 30 + ($touchCounter * 3), $ballColor);

        $raylib->DrawText(
            "move ball with mouse and click mouse button to change color",
            10,
            10,
            20,
            Color::darkGray(),
        );

        $raylib->DrawText(
            "touch the screen at multiple locations to get multiple balls",
            10,
            30,
            20,
            Color::darkGray(),
        );

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
