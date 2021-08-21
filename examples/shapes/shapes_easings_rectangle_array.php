<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/easings.php';

const RECS_WIDTH = 50;
const RECS_HEIGHT = 50;

const MAX_RECS_X = 800 / RECS_WIDTH;
const MAX_RECS_Y = 450 / RECS_HEIGHT;

const PLAY_TIME_IN_FRAMES = 240; // At 60 fps = 4 seconds

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [shapes] example - easings rectangle array');

$recs = [];
for ($y = 0; $y < MAX_RECS_Y; $y++) {
    for ($x = 0; $x < MAX_RECS_X; $x++) {
        $recs[$y * MAX_RECS_X + $x] = new Rectangle(
            RECS_WIDTH / 2 + RECS_WIDTH * $x,
            RECS_HEIGHT / 2 + RECS_HEIGHT * $y,
            RECS_WIDTH,
            RECS_HEIGHT,
        );
    }
}

$rotation = 0.0;
$framesCounter = 0;
$state = 0;                  // Rectangles animation state: 0-Playing, 1-Finished

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($state === 0) {
        $framesCounter++;

        for ($i = 0; $i < MAX_RECS_X * MAX_RECS_Y; $i++) {
            $recs[$i]->height = EaseCircOut($framesCounter, RECS_HEIGHT, -RECS_HEIGHT, PLAY_TIME_IN_FRAMES);
            $recs[$i]->width = EaseCircOut($framesCounter, RECS_WIDTH, -RECS_WIDTH, PLAY_TIME_IN_FRAMES);

            if ($recs[$i]->height < 0) {
                $recs[$i]->height = 0;
            }

            if ($recs[$i]->width < 0) {
                $recs[$i]->width = 0;
            }

            if (($recs[$i]->height == 0) && ($recs[$i]->width == 0)) {
                $state = 1;   // Finish playing
            }

            $rotation = EaseLinearIn($framesCounter, 0.0, 360.0, PLAY_TIME_IN_FRAMES);
        }
    } elseif (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        // When animation has finished, press space to restart
        $framesCounter = 0;

        for ($i = 0; $i < MAX_RECS_X * MAX_RECS_Y; $i++) {
            $recs[$i]->height = RECS_HEIGHT;
            $recs[$i]->width = RECS_WIDTH;
        }

        $state = 0;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        \Nawarian\Raylib\ClearBackground(Color::rayWhite());

        if ($state === 0) {
            for ($i = 0; $i < MAX_RECS_X * MAX_RECS_Y; $i++) {
                \Nawarian\Raylib\DrawRectanglePro($recs[$i], new Vector2($recs[$i]->width / 2, $recs[$i]->height / 2), $rotation, Color::red());
            }
        } else {
            \Nawarian\Raylib\DrawText('PRESS [SPACE] TO PLAY AGAIN!', 240, 200, 20, Color::gray());
        }

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
