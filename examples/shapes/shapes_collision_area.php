<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Rectangle};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//---------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - collision area');

// Box A: Moving box
$boxA = new Rectangle(10, (int) (\Nawarian\Raylib\GetScreenHeight() / 2 - 50), 200, 100);
$boxASpeedX = 4;

// Box B: Mouse moved box
$boxB = new Rectangle(
    (int) (\Nawarian\Raylib\GetScreenWidth() / 2 - 30),
    (int) (\Nawarian\Raylib\GetScreenHeight() / 2 - 30),
    60,
    60,
);

$boxCollision = new Rectangle(0, 0, 0, 0); // Collision rectangle

$screenUpperLimit = 40;      // Top menu limits

$pause = false;             // Movement pause

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//----------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //-----------------------------------------------------
    // Move box if not paused
    if (!$pause) {
        $boxA->x += $boxASpeedX;
    }

    // Bounce box on x screen limits
    if ((($boxA->x + $boxA->width) >= \Nawarian\Raylib\GetScreenWidth()) || ($boxA->x <= 0)) {
        $boxASpeedX *= -1;
    }

    // Update player-controlled-box (box02)
    $boxB->x = \Nawarian\Raylib\GetMouseX() - $boxB->width / 2;
    $boxB->y = \Nawarian\Raylib\GetMouseY() - $boxB->height / 2;

    // Make sure Box B does not go out of move area limits
    if (($boxB->x + $boxB->width) >= \Nawarian\Raylib\GetScreenWidth()) {
        $boxB->x = \Nawarian\Raylib\GetScreenWidth() - $boxB->width;
    } elseif ($boxB->x <= 0) {
        $boxB->x = 0;
    }

    if (($boxB->y + $boxB->height) >= \Nawarian\Raylib\GetScreenHeight()) {
        $boxB->y = \Nawarian\Raylib\GetScreenHeight() - $boxB->height;
    } elseif ($boxB->y <= $screenUpperLimit) {
        $boxB->y = $screenUpperLimit;
    }

    // Check boxes collision
    $collision = \Nawarian\Raylib\CheckCollisionRecs($boxA, $boxB);

    // Get collision rectangle (only on collision)
    if ($collision) {
        $boxCollision = \Nawarian\Raylib\GetCollisionRec($boxA, $boxB);
    }

    // Pause Box A movement
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        $pause = !$pause;
    }
    //-----------------------------------------------------

    // Draw
    //-----------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        \Nawarian\Raylib\DrawRectangle(0, 0, $screenWidth, $screenUpperLimit, $collision ? Color::red() : Color::black());

        \Nawarian\Raylib\DrawRectangleRec($boxA, Color::gold());
        \Nawarian\Raylib\DrawRectangleRec($boxB, Color::blue());

        if ($collision) {
            // Draw collision area
            \Nawarian\Raylib\DrawRectangleRec($boxCollision, Color::lime());

            // Draw collision message
            \Nawarian\Raylib\DrawText('COLLISION!', (int) (\Nawarian\Raylib\GetScreenWidth() / 2 - \Nawarian\Raylib\MeasureText('COLLISION!', 20) / 2), (int) ($screenUpperLimit / 2 - 10), 20, Color::black());

            // Draw collision area
            \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextFormat('Collision Area: %d', (int) $boxCollision->width * (int) $boxCollision->height), (int) (\Nawarian\Raylib\GetScreenWidth() / 2 - 100), $screenUpperLimit + 10, 20, Color::black());
        }

        \Nawarian\Raylib\DrawFPS(10, 10);

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\EndDrawing();
    //-----------------------------------------------------
}

// De-Initialization
//---------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//----------------------------------------------------------
