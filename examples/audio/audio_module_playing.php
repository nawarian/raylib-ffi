<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Vector2;

require_once __DIR__ . '/../../vendor/autoload.php';

const MAX_CIRCLES = 64;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\SetConfigFlags(Raylib::FLAG_MSAA_4X_HINT);  // NOTE: Try to enable MSAA 4X

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [audio] example - module playing (streaming)');

\Nawarian\Raylib\InitAudioDevice();       // Initialize audio device

/** @var Color[] $colors */
$colors = [
    Color::orange(),
    Color::red(),
    Color::gold(),
    Color::lime(),
    Color::blue(),
    Color::violet(),
    Color::brown(),
    Color::lightGray(),
    Color::pink(),
    Color::yellow(),
    Color::green(),
    Color::skyBlue(),
    Color::purple(),
    Color::beige(),
];

// Creates ome circles for visual effect
$circles = [];
for ($i = MAX_CIRCLES - 1; $i >= 0; $i--) {
    $circles[$i] = new class {
        public Vector2 $position;
        public float $radius = 0;
        public float $alpha = 0;
        public float $speed = 0;
        public Color $color;

        public function __construct()
        {
            $this->position = new Vector2(0, 0);
            $this->color = Color::black();
        }
    };

    $circles[$i]->alpha = 0.0;
    $circles[$i]->radius = \Nawarian\Raylib\GetRandomValue(10, 40);
    $circles[$i]->position->x = \Nawarian\Raylib\GetRandomValue((int) $circles[$i]->radius, (int) ($screenWidth - $circles[$i]->radius));
    $circles[$i]->position->y = \Nawarian\Raylib\GetRandomValue((int) $circles[$i]->radius, (int) ($screenHeight - $circles[$i]->radius));
    $circles[$i]->speed = (float) \Nawarian\Raylib\GetRandomValue(1, 100) / 2000.0;
    $circles[$i]->color = $colors[\Nawarian\Raylib\GetRandomValue(0, 13)];
}

$music = \Nawarian\Raylib\LoadMusicStream(__DIR__ . '/resources/mini1111.xm');
$music->looping = false;
$pitch = 1.0;

\Nawarian\Raylib\PlayMusicStream($music);

$pause = false;

\Nawarian\Raylib\SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\UpdateMusicStream($music);      // Update music buffer with new stream data

    // Restart music playing (stop and play)
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        \Nawarian\Raylib\StopMusicStream($music);
        \Nawarian\Raylib\PlayMusicStream($music);
    }

    // Pause/Resume music playing
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_P)) {
        $pause = !$pause;

        if ($pause) {
            \Nawarian\Raylib\PauseMusicStream($music);
        } else {
            \Nawarian\Raylib\ResumeMusicStream($music);
        }
    }

    if (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_DOWN)) {
        $pitch -= 0.01;
    } elseif (\Nawarian\Raylib\IsKeyDown(Raylib::KEY_UP)) {
        $pitch += 0.01;
    }

    \Nawarian\Raylib\SetMusicPitch($music, $pitch);

    // Get timePlayed scaled to bar dimensions
    $timePlayed = \Nawarian\Raylib\GetMusicTimePlayed($music) / \Nawarian\Raylib\GetMusicTimeLength($music) * ($screenWidth - 40);

    // Color circles animation
    for ($i = MAX_CIRCLES - 1; ($i >= 0) && !$pause; $i--) {
        $circles[$i]->alpha += $circles[$i]->speed;
        $circles[$i]->radius += $circles[$i]->speed * 10.0;

        if ($circles[$i]->alpha > 1.0) {
            $circles[$i]->speed *= -1;
        }

        if ($circles[$i]->alpha <= 0.0) {
            $circles[$i]->alpha = 0.0;
            $circles[$i]->radius = \Nawarian\Raylib\GetRandomValue(10, 40);
            $circles[$i]->position->x = \Nawarian\Raylib\GetRandomValue((int) $circles[$i]->radius, (int) ($screenWidth - $circles[$i]->radius));
            $circles[$i]->position->y = \Nawarian\Raylib\GetRandomValue((int) $circles[$i]->radius, (int) ($screenHeight - $circles[$i]->radius));
            $circles[$i]->color = $colors[\Nawarian\Raylib\GetRandomValue(0, 13)];
            $circles[$i]->speed = (float) \Nawarian\Raylib\GetRandomValue(1, 100) / 2000.0;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();

        \Nawarian\Raylib\ClearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        for ($i = MAX_CIRCLES - 1; $i >= 0; $i--) {
            \Nawarian\Raylib\DrawCircleV($circles[$i]->position, $circles[$i]->radius, \Nawarian\Raylib\Fade($circles[$i]->color, $circles[$i]->alpha));
        }

        // Draw time bar
        \Nawarian\Raylib\DrawRectangle(20, $screenHeight - 20 - 12, $screenWidth - 40, 12, Color::lightGray());
        \Nawarian\Raylib\DrawRectangle(20, $screenHeight - 20 - 12, (int) $timePlayed, 12, Color::maroon());
        \Nawarian\Raylib\DrawRectangleLines(20, $screenHeight - 20 - 12, $screenWidth - 40, 12, Color::gray());

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadMusicStream($music);          // Unload music stream buffers from RAM

\Nawarian\Raylib\CloseAudioDevice();     // Close audio device (music streaming is automatically stopped)

\Nawarian\Raylib\CloseWindow();          // Close window and OpenGL context
//--------------------------------------------------------------------------------------
