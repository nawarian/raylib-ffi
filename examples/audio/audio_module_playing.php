<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Vector2;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const MAX_CIRCLES = 64;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->setConfigFlags(Raylib::FLAG_MSAA_4X_HINT);  // NOTE: Try to enable MSAA 4X

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [audio] example - module playing (streaming)');

$raylib->initAudioDevice();       // Initialize audio device

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
    $circles[$i]->radius = $raylib->GetRandomValue(10, 40);
    $circles[$i]->position->x = $raylib->GetRandomValue(
        (int) $circles[$i]->radius,
        (int) ($screenWidth - $circles[$i]->radius),
    );
    $circles[$i]->position->y = $raylib->GetRandomValue(
        (int) $circles[$i]->radius,
        (int) ($screenHeight - $circles[$i]->radius),
    );
    $circles[$i]->speed = (float) $raylib->GetRandomValue(1, 100) / 2000.0;
    $circles[$i]->color = $colors[$raylib->GetRandomValue(0, 13)];
}

$music = $raylib->loadMusicStream('resources/mini1111.xm');
$music->looping = false;
$pitch = 1.0;

$raylib->playMusicStream($music);

$timePlayed = 0.0;
$pause = false;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $raylib->updateMusicStream($music);      // Update music buffer with new stream data

    // Restart music playing (stop and play)
    if ($raylib->isKeyPressed(Raylib::KEY_SPACE)) {
        $raylib->stopMusicStream($music);
        $raylib->playMusicStream($music);
    }

    // Pause/Resume music playing
    if ($raylib->isKeyPressed(Raylib::KEY_P)) {
        $pause = !$pause;

        if ($pause) {
            $raylib->pauseMusicStream($music);
        } else {
            $raylib->resumeMusicStream($music);
        }
    }

    if ($raylib->isKeyDown(Raylib::KEY_DOWN)) {
        $pitch -= 0.01;
    } elseif ($raylib->isKeyDown(Raylib::KEY_UP)) {
        $pitch += 0.01;
    }

    $raylib->setMusicPitch($music, $pitch);

    // Get timePlayed scaled to bar dimensions
    $timePlayed = $raylib->getMusicTimePlayed($music) / $raylib->getMusicTimeLength($music) * ($screenWidth - 40);

    // Color circles animation
    for ($i = MAX_CIRCLES - 1; ($i >= 0) && !$pause; $i--) {
        $circles[$i]->alpha += $circles[$i]->speed;
        $circles[$i]->radius += $circles[$i]->speed * 10.0;

        if ($circles[$i]->alpha > 1.0) {
            $circles[$i]->speed *= -1;
        }

        if ($circles[$i]->alpha <= 0.0) {
            $circles[$i]->alpha = 0.0;
            $circles[$i]->radius = $raylib->getRandomValue(10, 40);
            $circles[$i]->position->x = $raylib->getRandomValue(
                (int) $circles[$i]->radius,
                (int) ($screenWidth - $circles[$i]->radius),
            );
            $circles[$i]->position->y = $raylib->getRandomValue(
                (int) $circles[$i]->radius,
                (int) ($screenHeight - $circles[$i]->radius),
            );
            $circles[$i]->color = $colors[$raylib->getRandomValue(0, 13)];
            $circles[$i]->speed = (float) $raylib->getRandomValue(1, 100) / 2000.0;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        for ($i = MAX_CIRCLES - 1; $i >= 0; $i--) {
            $raylib->drawCircleV(
                $circles[$i]->position,
                $circles[$i]->radius,
                $raylib->fade($circles[$i]->color, $circles[$i]->alpha),
            );
        }

        // Draw time bar
        $raylib->drawRectangle(20, $screenHeight - 20 - 12, $screenWidth - 40, 12, Color::lightGray());
        $raylib->drawRectangle(20, $screenHeight - 20 - 12, (int) $timePlayed, 12, Color::maroon());
        $raylib->drawRectangleLines(20, $screenHeight - 20 - 12, $screenWidth - 40, 12, Color::gray());

        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadMusicStream($music);          // Unload music stream buffers from RAM

$raylib->closeAudioDevice();     // Close audio device (music streaming is automatically stopped)

$raylib->closeWindow();          // Close window and OpenGL context
//--------------------------------------------------------------------------------------
