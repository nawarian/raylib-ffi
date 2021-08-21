<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Rectangle};

use function Nawarian\Raylib\{
    BeginDrawing,
    CheckCollisionRecs,
    ClearBackground,
    CloseWindow,
    DrawFPS,
    DrawRectangle,
    DrawRectangleRec,
    DrawText,
    EndDrawing,
    GetCollisionRec,
    GetMouseX,
    GetMouseY,
    GetScreenHeight,
    GetScreenWidth,
    InitWindow,
    IsKeyPressed,
    MeasureText,
    SetTargetFPS,
    TextFormat,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

// Initialization
//---------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - collision area');

// Box A: Moving box
$boxA = new Rectangle(10, (int) (GetScreenHeight() / 2 - 50), 200, 100);
$boxASpeedX = 4;

// Box B: Mouse moved box
$boxB = new Rectangle(
    (int) (GetScreenWidth() / 2 - 30),
    (int) (GetScreenHeight() / 2 - 30),
    60,
    60,
);

$boxCollision = new Rectangle(0, 0, 0, 0); // Collision rectangle

$screenUpperLimit = 40;      // Top menu limits

$pause = false;             // Movement pause

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//----------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //-----------------------------------------------------
    // Move box if not paused
    if (!$pause) {
        $boxA->x += $boxASpeedX;
    }

    // Bounce box on x screen limits
    if ((($boxA->x + $boxA->width) >= GetScreenWidth()) || ($boxA->x <= 0)) {
        $boxASpeedX *= -1;
    }

    // Update player-controlled-box (box02)
    $boxB->x = GetMouseX() - $boxB->width / 2;
    $boxB->y = GetMouseY() - $boxB->height / 2;

    // Make sure Box B does not go out of move area limits
    if (($boxB->x + $boxB->width) >= GetScreenWidth()) {
        $boxB->x = GetScreenWidth() - $boxB->width;
    } elseif ($boxB->x <= 0) {
        $boxB->x = 0;
    }

    if (($boxB->y + $boxB->height) >= GetScreenHeight()) {
        $boxB->y = GetScreenHeight() - $boxB->height;
    } elseif ($boxB->y <= $screenUpperLimit) {
        $boxB->y = $screenUpperLimit;
    }

    // Check boxes collision
    $collision = CheckCollisionRecs($boxA, $boxB);

    // Get collision rectangle (only on collision)
    if ($collision) {
        $boxCollision = GetCollisionRec($boxA, $boxB);
    }

    // Pause Box A movement
    if (IsKeyPressed(Raylib::KEY_SPACE)) {
        $pause = !$pause;
    }
    //-----------------------------------------------------

    // Draw
    //-----------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        DrawRectangle(0, 0, $screenWidth, $screenUpperLimit, $collision ? Color::red() : Color::black());

        DrawRectangleRec($boxA, Color::gold());
        DrawRectangleRec($boxB, Color::blue());

        if ($collision) {
            // Draw collision area
            DrawRectangleRec($boxCollision, Color::lime());

            // Draw collision message
            DrawText(
                'COLLISION!',
                (int) (GetScreenWidth() / 2 - MeasureText('COLLISION!', 20) / 2),
                (int) ($screenUpperLimit / 2 - 10),
                20,
                Color::black()
            );

            // Draw collision area
            DrawText(
                TextFormat('Collision Area: %d', (int) $boxCollision->width * (int) $boxCollision->height),
                (int) (GetScreenWidth() / 2 - 100),
                $screenUpperLimit + 10,
                20,
                Color::black()
            );
        }

        DrawFPS(10, 10);

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    EndDrawing();
    //-----------------------------------------------------
}

// De-Initialization
//---------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//----------------------------------------------------------
