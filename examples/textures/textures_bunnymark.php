<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Vector2;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const MAX_BUNNIES = 50000;
const MAX_BATCH_ELEMENTS = 8192;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [textures] example - bunnymark');

// Load bunny texture
$texBunny = $raylib->loadTexture(__DIR__ . '/resources/wabbit_alpha.png');

$bunnies = [];    // Bunnies array
foreach (range(0, MAX_BUNNIES) as $i) {
    $bunnies[$i] = new class (new Vector2(0, 0), new Vector2(0, 0), Color::black()) {
        public Vector2 $position;
        public Vector2 $speed;
        public Color $color;

        public function __construct(Vector2 $position, Vector2 $speed, Color $color)
        {
            $this->position = $position;
            $this->speed = $speed;
            $this->color = $color;
        }
    };
}

$bunniesCount = 0;           // Bunnies counter

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if ($raylib->isMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON)) {
        // Create more bunnies
        for ($i = 0; $i < 100; $i++) {
            if ($bunniesCount < MAX_BUNNIES) {
                $bunnies[$bunniesCount]->position = $raylib->getMousePosition();
                $bunnies[$bunniesCount]->speed->x = (float) $raylib->getRandomValue(-250, 250) / 60.0;
                $bunnies[$bunniesCount]->speed->y = (float) $raylib->getRandomValue(-250, 250) / 60.0;
                $bunnies[$bunniesCount]->color = new Color(
                    $raylib->getRandomValue(50, 240),
                    $raylib->getRandomValue(80, 240),
                    $raylib->getRandomValue(100, 240),
                    255,
                );
                $bunniesCount++;
            }
        }
    }

    // Update bunnies
    for ($i = 0; $i < $bunniesCount; $i++) {
        $bunnies[$i]->position->x += $bunnies[$i]->speed->x;
        $bunnies[$i]->position->y += $bunnies[$i]->speed->y;

        if (
            (($bunnies[$i]->position->x + $texBunny->width / 2) > $raylib->getScreenWidth())
            || (($bunnies[$i]->position->x + $texBunny->width / 2) < 0)
        ) {
            $bunnies[$i]->speed->x *= -1;
        }

        if (
            (($bunnies[$i]->position->y + $texBunny->height / 2) > $raylib->getScreenHeight())
            || (($bunnies[$i]->position->y + $texBunny->height / 2 - 40) < 0)
        ) {
            $bunnies[$i]->speed->y *= -1;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        for ($i = 0; $i < $bunniesCount; $i++) {
            // NOTE: When internal batch buffer limit is reached (MAX_BATCH_ELEMENTS),
            // a draw call is launched and buffer starts being filled again;
            // before issuing a draw call, updated vertex data from internal CPU buffer is send to GPU...
            // Process of sending data is costly and it could happen that GPU data has not been completely
            // processed for drawing while new data is tried to be sent (updating current in-use buffers)
            // it could generates a stall and consequently a frame drop, limiting the number of drawn bunnies
            $raylib->drawTexture(
                $texBunny,
                (int) $bunnies[$i]->position->x,
                (int) $bunnies[$i]->position->y,
                $bunnies[$i]->color
            );
        }

        $raylib->drawRectangle(0, 0, $screenWidth, 40, Color::black());
        $raylib->drawText($raylib->textFormat('bunnies: %d', $bunniesCount), 120, 10, 20, Color::green());
        $raylib->drawText(
            $raylib->textFormat('batched draw calls: %d', 1 + $bunniesCount / MAX_BATCH_ELEMENTS),
            320,
            10,
            20,
            Color::maroon(),
        );

        $raylib->drawFPS(10, 10);

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($texBunny);    // Unload bunny texture

$raylib->closeWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
