<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{Color, Vector2};

require_once __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [shapes] example - following eyes");

$scleraLeftPosition = new Vector2($raylib->getScreenWidth() / 2 - 100, $raylib->getScreenHeight() / 2);
$scleraRightPosition = new Vector2($raylib->getScreenWidth() / 2 + 100, $raylib->getScreenHeight() / 2);
$scleraRadius = 80;

$irisRadius = 24;

$raylib->setTargetFPS(60);               // Set our game to run at 60 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $irisLeftPosition = $raylib->getMousePosition();
    $irisRightPosition = $raylib->getMousePosition();

    // Check not inside the left eye sclera
    if (!$raylib->checkCollisionPointCircle($irisLeftPosition, $scleraLeftPosition, $scleraRadius - 20)) {
        $dx = $irisLeftPosition->x - $scleraLeftPosition->x;
        $dy = $irisLeftPosition->y - $scleraLeftPosition->y;

        $angle = atan2($dy, $dx);

        $dxx = ($scleraRadius - $irisRadius) * cos($angle);
        $dyy = ($scleraRadius - $irisRadius) * sin($angle);

        $irisLeftPosition->x = $scleraLeftPosition->x + $dxx;
        $irisLeftPosition->y = $scleraLeftPosition->y + $dyy;
    }

    // Check not inside the right eye sclera
    if (!$raylib->checkCollisionPointCircle($irisRightPosition, $scleraRightPosition, $scleraRadius - 20)) {
        $dx = $irisRightPosition->x - $scleraRightPosition->x;
        $dy = $irisRightPosition->y - $scleraRightPosition->y;

        $angle = atan2($dy, $dx);

        $dxx = ($scleraRadius - $irisRadius) * cos($angle);
        $dyy = ($scleraRadius - $irisRadius) * sin($angle);

        $irisRightPosition->x = $scleraRightPosition->x + $dxx;
        $irisRightPosition->y = $scleraRightPosition->y + $dyy;
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();
        $raylib->clearBackground(Color::rayWhite());

        $raylib->drawCircleV($scleraLeftPosition, $scleraRadius, Color::lightGray());
        $raylib->drawCircleV($irisLeftPosition, $irisRadius, Color::brown());
        $raylib->drawCircleV($irisLeftPosition, 10, Color::black());

        $raylib->drawCircleV($scleraRightPosition, $scleraRadius, Color::lightGray());
        $raylib->drawCircleV($irisRightPosition, $irisRadius, Color::darkGreen());
        $raylib->drawCircleV($irisRightPosition, 10, Color::black());

        $raylib->drawFPS(10, 10);

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
