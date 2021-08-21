<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Vector2};

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    CloseWindow,
    DrawFPS,
    DrawRectangle,
    DrawText,
    DrawTexture,
    EndDrawing,
    GetMousePosition,
    GetRandomValue,
    GetScreenHeight,
    GetScreenWidth,
    InitWindow,
    IsMouseButtonDown,
    LoadTexture,
    SetTargetFPS,
    TextFormat,
    UnloadTexture,
    WindowShouldClose
};

require_once __DIR__ . '/../../vendor/autoload.php';

const MAX_BUNNIES = 50000;
const MAX_BATCH_ELEMENTS = 8192;

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

InitWindow($screenWidth, $screenHeight, 'raylib [textures] example - bunnymark');

// Load bunny texture
$texBunny = LoadTexture(__DIR__ . '/resources/wabbit_alpha.png');

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

SetTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    if (IsMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON)) {
        // Create more bunnies
        for ($i = 0; $i < 100; $i++) {
            if ($bunniesCount < MAX_BUNNIES) {
                $bunnies[$bunniesCount]->position = GetMousePosition();
                $bunnies[$bunniesCount]->speed->x = (float) GetRandomValue(-250, 250) / 60.0;
                $bunnies[$bunniesCount]->speed->y = (float) GetRandomValue(-250, 250) / 60.0;
                $bunnies[$bunniesCount]->color = new Color(
                    GetRandomValue(50, 240),
                    GetRandomValue(80, 240),
                    GetRandomValue(100, 240),
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
            (($bunnies[$i]->position->x + $texBunny->width / 2) > GetScreenWidth())
            || (($bunnies[$i]->position->x + $texBunny->width / 2) < 0)
        ) {
            $bunnies[$i]->speed->x *= -1;
        }

        if (
            (($bunnies[$i]->position->y + $texBunny->height / 2) > GetScreenHeight())
            || (($bunnies[$i]->position->y + $texBunny->height / 2 - 40) < 0)
        ) {
            $bunnies[$i]->speed->y *= -1;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    BeginDrawing();

        ClearBackground(Color::rayWhite());

        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
        for ($i = 0; $i < $bunniesCount; $i++) {
            // NOTE: When internal batch buffer limit is reached (MAX_BATCH_ELEMENTS),
            // a draw call is launched and buffer starts being filled again;
            // before issuing a draw call, updated vertex data from internal CPU buffer is send to GPU...
            // Process of sending data is costly and it could happen that GPU data has not been completely
            // processed for drawing while new data is tried to be sent (updating current in-use buffers)
            // it could generates a stall and consequently a frame drop, limiting the number of drawn bunnies
            DrawTexture(
                $texBunny,
                (int) $bunnies[$i]->position->x,
                (int) $bunnies[$i]->position->y,
                $bunnies[$i]->color
            );
        }

        DrawRectangle(0, 0, $screenWidth, 40, Color::black());
        DrawText(TextFormat('bunnies: %d', $bunniesCount), 120, 10, 20, Color::green());
        DrawText(
            TextFormat('batched draw calls: %d', 1 + $bunniesCount / MAX_BATCH_ELEMENTS),
            320,
            10,
            20,
            Color::maroon()
        );

        DrawFPS(10, 10);

    // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    EndDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
UnloadTexture($texBunny);    // Unload bunny texture

CloseWindow();              // Close window and OpenGL context
//--------------------------------------------------------------------------------------
