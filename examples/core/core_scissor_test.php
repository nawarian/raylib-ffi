<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\{
    Raylib,
    RaylibFactory,
};
use Nawarian\Raylib\Types\{
    Color,
    Rectangle,
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [core] example - scissor test');

$scissorArea = new Rectangle(0, 0, 300, 300);
$scissorMode = true;

$raylib->setTargetFPS(60); // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isKeyPressed(Raylib::KEY_S)) {
        $scissorMode = !$scissorMode;
    }

    // Centre the scissor area around the mouse position
    $scissorArea->x = $raylib->getMouseX() - $scissorArea->width / 2;
    $scissorArea->y = $raylib->getMouseY() - $scissorArea->height / 2;
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        if ($scissorMode) {
            $raylib->beginScissorMode(
                (int) $scissorArea->x,
                (int) $scissorArea->y,
                (int) $scissorArea->width,
                (int) $scissorArea->height,
            );
        }

        // Draw full screen rectangle and some text
        // NOTE: Only part defined by scissor area will be rendered
        $raylib->drawRectangle(0, 0, $raylib->getScreenWidth(), $raylib->getScreenHeight(), Color::red());
        $raylib->drawText('Move the mouse around to reveal this text!', 190, 200, 20, Color::lightGray());

        if ($scissorMode) {
            $raylib->endScissorMode();
        }

        $raylib->drawRectangleLinesEx($scissorArea, 1, Color::black());
        $raylib->drawText('Press S to toggle scissor test', 10, 10, 20, Color::black());

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow(); // Close window and OpenGL context
//--------------------------------------------------------------------------------------
