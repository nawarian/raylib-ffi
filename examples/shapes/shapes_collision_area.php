<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Rectangle};

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//---------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [shapes] example - collision area');

// Box A: Moving box
$boxA = new Rectangle(10, (int) ($raylib->getScreenHeight() / 2 - 50), 200, 100);
$boxASpeedX = 4;

// Box B: Mouse moved box
$boxB = new Rectangle(
    (int) ($raylib->getScreenWidth() / 2 - 30),
    (int) ($raylib->getScreenHeight() / 2 - 30),
    60,
    60,
);

$boxCollision = new Rectangle(0, 0, 0, 0); // Collision rectangle

$screenUpperLimit = 40;      // Top menu limits

$pause = false;             // Movement pause

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//----------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //-----------------------------------------------------
    // Move box if not paused
    if (!$pause) {
        $boxA->x += $boxASpeedX;
    }

    // Bounce box on x screen limits
    if ((($boxA->x + $boxA->width) >= $raylib->getScreenWidth()) || ($boxA->x <= 0)) {
        $boxASpeedX *= -1;
    }

    // Update player-controlled-box (box02)
    $boxB->x = $raylib->getMouseX() - $boxB->width / 2;
    $boxB->y = $raylib->getMouseY() - $boxB->height / 2;

    // Make sure Box B does not go out of move area limits
    if (($boxB->x + $boxB->width) >= $raylib->getScreenWidth()) {
        $boxB->x = $raylib->getScreenWidth() - $boxB->width;
    } elseif ($boxB->x <= 0) {
        $boxB->x = 0;
    }

    if (($boxB->y + $boxB->height) >= $raylib->getScreenHeight()) {
        $boxB->y = $raylib->getScreenHeight() - $boxB->height;
    } elseif ($boxB->y <= $screenUpperLimit) {
        $boxB->y = $screenUpperLimit;
    }

    // Check boxes collision
    $collision = $raylib->checkCollisionRecs($boxA, $boxB);

    // Get collision rectangle (only on collision)
    if ($collision) {
        $boxCollision = $raylib->getCollisionRec($boxA, $boxB);
    }

    // Pause Box A movement
    if ($raylib->isKeyPressed(Raylib::KEY_SPACE)) {
        $pause = !$pause;
    }
    //-----------------------------------------------------

    // Draw
    //-----------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        $raylib->drawRectangle(
            0,
            0,
            $screenWidth,
            $screenUpperLimit,
            $collision ? Color::red() : Color::black(),
        );

        $raylib->drawRectangleRec($boxA, Color::gold());
        $raylib->drawRectangleRec($boxB, Color::blue());

        if ($collision) {
            // Draw collision area
            $raylib->drawRectangleRec($boxCollision, Color::lime());

            // Draw collision message
            $raylib->drawText(
                'COLLISION!',
                (int) ($raylib->getScreenWidth() / 2 - $raylib->measureText('COLLISION!', 20) / 2),
                (int) ($screenUpperLimit / 2 - 10),
                20,
                Color::black(),
            );

            // Draw collision area
            $raylib->drawText(
                $raylib->textFormat(
                    'Collision Area: %d',
                    (int) $boxCollision->width * (int) $boxCollision->height
                ),
                (int) ($raylib->getScreenWidth() / 2 - 100),
                $screenUpperLimit + 10,
                20,
                Color::black(),
            );
        }

        $raylib->drawFPS(10, 10);

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //-----------------------------------------------------
}

// De-Initialization
//---------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//----------------------------------------------------------
