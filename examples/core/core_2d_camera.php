<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\RaylibFFI as Raylib;

Raylib::boot();

const MAX_BUILDINGS = 100;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

Raylib::InitWindow($screenWidth, $screenHeight, "raylib [core] example - 2d camera");

$player = Raylib::Rectangle(400, 280, 40, 40);
$buildings = [];
$buildColors = [];

$spacing = 0;

for ($i = 0; $i < MAX_BUILDINGS; $i++)
{
    $buildings[$i] = Raylib::Rectangle(
        0,
        0,
        Raylib::GetRandomValue(50, 200),
        Raylib::GetRandomValue(100, 800),
    );
    $buildings[$i]->y = $screenHeight - 130 - $buildings[$i]->height;
    $buildings[$i]->x = -6000 + $spacing;

    $spacing += $buildings[$i]->width;

    $buildColors[$i] = Raylib::Color(
        Raylib::GetRandomValue(200, 240),
        Raylib::GetRandomValue(200, 240),
        Raylib::GetRandomValue(200, 250),
        255
    );
}

$camera = Raylib::Camera2D(
    Raylib::Vector2($screenWidth / 2, $screenHeight / 2),
    Raylib::Vector2($player->x + 20, $player->y + 20),
    0.0,
    1.0,
);

Raylib::SetTargetFPS(60);                   // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!Raylib::WindowShouldClose())        // Detect window close button or ESC key
{
    // Update
    //----------------------------------------------------------------------------------

    // Player movement
    if (Raylib::IsKeyDown(Raylib::KEY_RIGHT)) {
        $player->x += 2;
    } else if (Raylib::IsKeyDown(Raylib::KEY_LEFT)) {
        $player->x -= 2;
    }

    // Camera target follows player
    $camera->target = Raylib::Vector2($player->x + 20, $player->y + 20);

    // Camera rotation controls
    if (Raylib::IsKeyDown(Raylib::KEY_A)) {
        $camera->rotation--;
    } else if (Raylib::IsKeyDown(Raylib::KEY_S)) {
        $camera->rotation++;
    }

    // Limit camera rotation to 80 degrees (-40 to 40)
    if ($camera->rotation > 40) {
        $camera->rotation = 40;
    } else if ($camera->rotation < -40) {
        $camera->rotation = -40;
    }

    // Camera zoom controls
    $camera->zoom += ((float) Raylib::GetMouseWheelMove()*0.05);

    if ($camera->zoom > 3.0) {
        $camera->zoom = 3.0;
    } else if ($camera->zoom < 0.1) {
        $camera->zoom = 0.1;
    }

    // Camera reset (zoom and rotation)
    if (Raylib::IsKeyPressed(Raylib::KEY_R))
    {
        $camera->zoom = 1.0;
        $camera->rotation = 0.0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    Raylib::BeginDrawing();

        Raylib::ClearBackground(
            Raylib::Color(245, 245, 245, 255)
        );

        Raylib::BeginMode2D($camera);

            Raylib::DrawRectangle(
                -6000,
                320,
                13000,
                8000,
                Raylib::Color(80, 80, 80, 255),
            );

            for ($i = 0; $i < MAX_BUILDINGS; $i++) {
                Raylib::DrawRectangleRec($buildings[$i], $buildColors[$i]);
            }

            Raylib::DrawRectangleRec($player, Raylib::Color(230, 41, 55, 255));

            Raylib::DrawLine(
                $camera->target->x,
                -$screenHeight * 10,
                $camera->target->x,
                $screenHeight * 10,
                Raylib::Color(0, 228, 48, 255),
            );
            Raylib::DrawLine(
                -$screenWidth * 10,
                $camera->target->y,
                $screenWidth * 10,
                $camera->target->y,
                Raylib::Color(0, 228, 48, 255),
            );

        Raylib::EndMode2D();

        Raylib::DrawText("SCREEN AREA", 640, 10, 20, Raylib::Color(230, 41, 55, 255));

        Raylib::DrawRectangle(0, 0, $screenWidth, 5, Raylib::Color(230, 41, 55, 255));
        Raylib::DrawRectangle(0, 5, 5, $screenHeight - 10, Raylib::Color(230, 41, 55, 255));
        Raylib::DrawRectangle($screenWidth - 5, 5, 5, $screenHeight - 10, Raylib::Color(230, 41, 55, 255));
        Raylib::DrawRectangle(0, $screenHeight - 5, $screenWidth, 5, Raylib::Color(230, 41, 55, 255));

        Raylib::DrawRectangle(10, 10, 250, 113, Raylib::Fade(Raylib::Color(102, 191, 255, 255), 0.5));
        Raylib::DrawRectangleLines( 10, 10, 250, 113, Raylib::Color(0, 121, 241, 255));

        Raylib::DrawText("Free 2d camera controls:", 20, 20, 10, Raylib::Color(0, 0, 0, 255));
        Raylib::DrawText("- Right/Left to move Offset", 40, 40, 10, Raylib::Color(80, 80, 80, 255));
        Raylib::DrawText("- Mouse Wheel to Zoom in-out", 40, 60, 10, Raylib::Color(80, 80, 80, 255));
        Raylib::DrawText("- A / S to Rotate", 40, 80, 10, Raylib::Color(80, 80, 80, 255));
        Raylib::DrawText("- R to reset Zoom and Rotation", 40, 100, 10, Raylib::Color(80, 80, 80, 255));

    Raylib::EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
Raylib::CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------

