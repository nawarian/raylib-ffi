<?php

declare(strict_types=1);

use Nawarian\Raylib\HasRaylibBlendModeConstants;
use Nawarian\Raylib\HasRaylibKeysConstants;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Rectangle;
use Nawarian\Raylib\Types\Vector2;

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const MAX_PARTICLES = 200;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow(
    $screenWidth,
    $screenHeight,
    'raylib [textures] example - particles blending'
);

// Particles pool, reuse them!
$mouseTail = [];

// Initialize particles
foreach (range(0, MAX_PARTICLES) as $i) {
    $r = $raylib->getRandomValue(0, 255);
    $g = $raylib->getRandomValue(0, 255);
    $b = $raylib->getRandomValue(0, 255);

    $mouseTail[$i] = new class (
        new Vector2(0.0, 0.0),
        new Color($r, $g, $b, 255),
        1.0,
        (float) $raylib->getRandomValue(1, 30) / 20.0,
        (float) $raylib->getRandomValue(0, 360),
        false
    ) {
        public Vector2 $position;
        public Color $color;
        public float $alpha;
        public float $size;
        public float $rotation;
        public bool $active;    // NOTE: Use it to activate/deactive particle

        public function __construct(
            Vector2 $position,
            Color $color,
            float $alpha,
            float $size,
            float $rotation,
            bool $active
        ) {
            $this->position = $position;
            $this->color = $color;
            $this->alpha = $alpha;
            $this->size = $size;
            $this->rotation = $rotation;
            $this->active = $active;
        }
    };
}

$gravity = 3.0;

$smoke = $raylib->loadTexture(__DIR__ . '/resources/spark_flame.png');

$blending = HasRaylibBlendModeConstants::BLEND_ALPHA;

$raylib->setTargetFPS(60);
//-------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) { // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------

    // Activate one particle every frame and Update active particles
    // NOTE: Particles initial position should be mouse position when activated
    // NOTE: Particles fall down with gravity and rotation... and disappear after 2 seconds (alpha = 0)
    // NOTE: When a particle disappears, active = false and it can be reused.
    $i = 0;
    for (; $i < MAX_PARTICLES; $i++) {
        if (!$mouseTail[$i]->active) {
            $mouseTail[$i]->active = true;
            $mouseTail[$i]->alpha = 1.0;
            $mouseTail[$i]->position = $raylib->getMousePosition();
            $i = MAX_PARTICLES;
        }
    }

    for ($i = 0; $i < MAX_PARTICLES; $i++) {
        if ($mouseTail[$i]->active) {
            $mouseTail[$i]->position->y += $gravity / 2;
            $mouseTail[$i]->alpha -= 0.005;

            if ($mouseTail[$i]->alpha <= 0.0) {
                $mouseTail[$i]->active = false;
            }

            $mouseTail[$i]->rotation += 2.0;
        }
    }

    if ($raylib->isKeyPressed(HasRaylibKeysConstants::KEY_SPACE)) {
        if ($blending == HasRaylibBlendModeConstants::BLEND_ALPHA) {
            $blending = HasRaylibBlendModeConstants::BLEND_ADDITIVE;
        } else {
            $blending = HasRaylibBlendModeConstants::BLEND_ALPHA;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
    $raylib->clearBackground(Color::darkGray());

    $raylib->beginBlendMode($blending);

    // Draw active particles
    for ($i = 0; $i < MAX_PARTICLES; $i++) {
        if ($mouseTail[$i]->active) {
            $raylib->drawTexturePro(
                $smoke,
                new Rectangle(0.0, 0.0, (float) $smoke->width, (float) $smoke->height),
                new Rectangle(
                    $mouseTail[$i]->position->x,
                    $mouseTail[$i]->position->y,
                    (float) $smoke->width * $mouseTail[$i]->size,
                    (float) $smoke->height * $mouseTail[$i]->size
                ),
                new Vector2(
                    (float) $smoke->width * $mouseTail[$i]->size / 2.0,
                    (float) $smoke->height * $mouseTail[$i]->size / 2.0
                ),
                $mouseTail[$i]->rotation,
                $raylib->fade($mouseTail[$i]->color, $mouseTail[$i]->alpha)
            );
        }
    }

    $raylib->endBlendMode();

    $raylib->drawText('PRESS SPACE to CHANGE BLENDING MODE', 180, 20, 20, Color::black());

    if ($blending == HasRaylibBlendModeConstants::BLEND_ALPHA) {
        $raylib->drawText('ALPHA BLENDING', 290, $screenHeight - 40, 20, Color::black());
    } else {
        $raylib->drawText('ADDITIVE BLENDING', 280, $screenHeight - 40, 20, Color::rayWhite());
    }
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadTexture($smoke);

$raylib->closeWindow();   // Close window and OpenGL context
//--------------------------------------------------------------------------------------
