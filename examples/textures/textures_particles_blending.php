<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Rectangle;
use Nawarian\Raylib\Types\Vector2;

require_once __DIR__ . '/../../vendor/autoload.php';

const MAX_PARTICLES = 200;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - particles blending');

// Particles pool, reuse them!
$mouseTail = [];

// Initialize particles
foreach (range(0, MAX_PARTICLES) as $i) {
    $r = \Nawarian\Raylib\GetRandomValue(0, 255);
    $g = \Nawarian\Raylib\GetRandomValue(0, 255);
    $b = \Nawarian\Raylib\GetRandomValue(0, 255);

    $mouseTail[$i] = new class (
        new Vector2(0.0, 0.0),
        new Color($r, $g, $b, 255),
        1.0,
        (float) \Nawarian\Raylib\GetRandomValue(1, 30) / 20.0,
        (float) \Nawarian\Raylib\GetRandomValue(0, 360),
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

$smoke = \Nawarian\Raylib\LoadTexture(__DIR__ . '/resources/spark_flame.png');

$blending = Raylib::BLEND_ALPHA;

\Nawarian\Raylib\SetTargetFPS(60);
//-------------------------------------------------------------------------------------

// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) { // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------

    // Activate one particle every frame and Update active particles
    // NOTE: Particles initial position should be mouse position when activated
    // NOTE: Particles fall down with gravity and rotation... and disappear after 2 seconds (alpha = 0)
    // NOTE: When a particle disappears, active = false and it can be reused.
    for ($i = 0; $i < MAX_PARTICLES; $i++) {
        if (!$mouseTail[$i]->active) {
            $mouseTail[$i]->active = true;
            $mouseTail[$i]->alpha = 1.0;
            $mouseTail[$i]->position = \Nawarian\Raylib\GetMousePosition();

            /**
             * @psalm-suppress LoopInvalidation
             */
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

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_SPACE)) {
        if ($blending === Raylib::BLEND_ALPHA) {
            $blending = Raylib::BLEND_ADDITIVE;
        } else {
            $blending = Raylib::BLEND_ALPHA;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        \Nawarian\Raylib\ClearBackground(Color::darkGray());

        \Nawarian\Raylib\BeginBlendMode($blending);

            //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
            for ($i = 0; $i < MAX_PARTICLES; $i++) {
                if ($mouseTail[$i]->active) {
                    \Nawarian\Raylib\DrawTexturePro($smoke, new Rectangle(0.0, 0.0, (float) $smoke->width, (float) $smoke->height), new Rectangle(
                        $mouseTail[$i]->position->x,
                        $mouseTail[$i]->position->y,
                        (float) $smoke->width * $mouseTail[$i]->size,
                        (float) $smoke->height * $mouseTail[$i]->size
                    ), new Vector2(
                        (float) $smoke->width * $mouseTail[$i]->size / 2.0,
                        (float) $smoke->height * $mouseTail[$i]->size / 2.0
                    ), $mouseTail[$i]->rotation, \Nawarian\Raylib\Fade($mouseTail[$i]->color, $mouseTail[$i]->alpha));
                }
            }

        \Nawarian\Raylib\EndBlendMode();

        \Nawarian\Raylib\DrawText('PRESS SPACE to CHANGE BLENDING MODE', 180, 20, 20, Color::black());

        if ($blending == Raylib::BLEND_ALPHA) {
            \Nawarian\Raylib\DrawText('ALPHA BLENDING', 290, $screenHeight - 40, 20, Color::black());
        } else {
            \Nawarian\Raylib\DrawText('ADDITIVE BLENDING', 280, $screenHeight - 40, 20, Color::rayWhite());
        }
    \Nawarian\Raylib\EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
\Nawarian\Raylib\UnloadTexture($smoke);

\Nawarian\Raylib\CloseWindow();   // Close window and OpenGL context
//--------------------------------------------------------------------------------------
