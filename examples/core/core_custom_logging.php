<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Custom logging function
function LogCustom(int $msgType, string $text, array $args): void
{
    $timeStr = strftime("%Y-%m-%d %H:%M:%S", time());

    printf("[%s] ", $timeStr);

    switch ($msgType) {
        case Raylib::LOG_INFO:
            printf("[INFO] : ");
            break;
        case Raylib::LOG_ERROR:
            printf("[ERROR]: ");
            break;
        case Raylib::LOG_WARNING:
            printf("[WARN] : ");
            break;
        case Raylib::LOG_DEBUG:
            printf("[DEBUG]: ");
            break;
    }

    printf($text, ...$args);
    printf("\n");
}

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

// First thing we do is setting our custom logger to ensure everything raylib logs
// will use our own logger instead of its internal one
$raylib->setTraceLogCallback('LogCustom');

$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - custom logging");

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {  // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    // TODO: Update your variables here
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

    $raylib->clearBackground(Color::rayWhite());

    $raylib->drawText(
        "Check out the console output to see the custom logger in action!",
        60,
        200,
        20,
        Color::lightGray(),
    );

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
