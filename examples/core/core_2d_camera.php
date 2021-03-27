<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{
    Camera2D,
    Color,
    Rectangle,
    Vector2
};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const MAX_BUILDINGS = 100;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->InitWindow($screenWidth, $screenHeight, "raylib [core] example - 2d camera");

$player = new Rectangle(400, 280, 40, 40);
$buildings = [];
$buildColors = [];

$spacing = 0;

for ($i = 0; $i < MAX_BUILDINGS; $i++)
{
    $buildings[$i] = new Rectangle(
        0,
        0,
        $raylib->getRandomValue(50, 200),
        $raylib->getRandomValue(100, 800),
    );
    $buildings[$i]->y = $screenHeight - 130 - $buildings[$i]->height;
    $buildings[$i]->x = -6000 + $spacing;

    $spacing += $buildings[$i]->width;

    $buildColors[$i] = new Color(
        $raylib->getRandomValue(200, 240),
        $raylib->getRandomValue(200, 240),
        $raylib->getRandomValue(200, 250),
        255
    );
}

$camera = new Camera2D(
    new Vector2($screenWidth / 2, $screenHeight / 2),
    new Vector2($player->x + 20, $player->y + 20),
    0.0,
    1.0,
);

$raylib->SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->WindowShouldClose())        // Detect window close button or ESC key
{
    // Update
    //----------------------------------------------------------------------------------

    // Player movement
    if ($raylib->IsKeyDown(Raylib::KEY_RIGHT)) {
        $player->x += 2;
    } else if ($raylib->IsKeyDown(Raylib::KEY_LEFT)) {
        $player->x -= 2;
    }

    // Camera target follows player
    $camera->target = new Vector2($player->x + 20, $player->y + 20);

    // Camera rotation controls
    if ($raylib->IsKeyDown(Raylib::KEY_A)) {
        $camera->rotation--;
    } else if ($raylib->IsKeyDown(Raylib::KEY_S)) {
        $camera->rotation++;
    }

    // Limit camera rotation to 80 degrees (-40 to 40)
    if ($camera->rotation > 40) {
        $camera->rotation = 40;
    } else if ($camera->rotation < -40) {
        $camera->rotation = -40;
    }

    // Camera zoom controls
    $camera->zoom += ((float) $raylib->GetMouseWheelMove()*0.05);

    if ($camera->zoom > 3.0) {
        $camera->zoom = 3.0;
    } else if ($camera->zoom < 0.1) {
        $camera->zoom = 0.1;
    }

    // Camera reset (zoom and rotation)
    if ($raylib->IsKeyPressed(Raylib::KEY_R))
    {
        $camera->zoom = 1.0;
        $camera->rotation = 0.0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->BeginDrawing();

        $raylib->clearBackground(
            new Color(245, 245, 245, 255)
        );

        $raylib->beginMode2D($camera);

            $raylib->drawRectangle(
                -6000,
                320,
                13000,
                8000,
                new Color(80, 80, 80, 255),
            );

            for ($i = 0; $i < MAX_BUILDINGS; $i++) {
                $raylib->drawRectangleRec($buildings[$i], $buildColors[$i]);
            }

            $raylib->drawRectangleRec($player, new Color(230, 41, 55, 255));

            $raylib->drawLine(
                (int) $camera->target->x,
                (int) (-$screenHeight * 10),
                (int) $camera->target->x,
                (int) ($screenHeight * 10),
                new Color(0, 228, 48, 255),
            );
            $raylib->drawLine(
                (int) (-$screenWidth * 10),
                (int) $camera->target->y,
                (int) ($screenWidth * 10),
                (int) $camera->target->y,
                new Color(0, 228, 48, 255),
            );

        $raylib->EndMode2D();

        $raylib->drawText("SCREEN AREA", 640, 10, 20, new Color(230, 41, 55, 255));

        $raylib->drawRectangle(0, 0, $screenWidth, 5, new Color(230, 41, 55, 255));
        $raylib->drawRectangle(0, 5, 5, $screenHeight - 10, new Color(230, 41, 55, 255));
        $raylib->drawRectangle($screenWidth - 5, 5, 5, $screenHeight - 10, new Color(230, 41, 55, 255));
        $raylib->drawRectangle(0, $screenHeight - 5, $screenWidth, 5, new Color(230, 41, 55, 255));

        $raylib->drawRectangle(10, 10, 250, 113, $raylib->fade(new Color(102, 191, 255, 255), 0.5));
        $raylib->drawRectangleLines(10, 10, 250, 113, new Color(0, 121, 241, 255));

        $raylib->drawText("Free 2d camera controls:", 20, 20, 10, new Color(0, 0, 0, 255));
        $raylib->drawText("- Right/Left to move Offset", 40, 40, 10, new Color(80, 80, 80, 255));
        $raylib->drawText("- Mouse Wheel to Zoom in-out", 40, 60, 10, new Color(80, 80, 80, 255));
        $raylib->drawText("- A / S to Rotate", 40, 80, 10, new Color(80, 80, 80, 255));
        $raylib->drawText("- R to reset Zoom and Rotation", 40, 100, 10, new Color(80, 80, 80, 255));

    $raylib->EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------

