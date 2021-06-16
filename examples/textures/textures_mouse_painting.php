<?php

declare(strict_types=1);

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Rectangle;
use Nawarian\Raylib\Types\RenderTexture2D;
use Nawarian\Raylib\Types\Vector2;

require_once  __DIR__ . '/../../vendor/autoload.php';

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

const MAX_COLORS_COUNT = 23;    // Number of colors available

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, 'raylib [textures] example - mouse painting');

// Colours to choose from
$colors = [
    Color::rayWhite(), Color::yellow(), Color::gold(), Color::orange(),
    Color::pink(), Color::red(), Color::maroon(), Color::green(),
    Color::lime(), Color::darkGreen(), Color::skyBlue(), Color::blue(),
    Color::darkBlue(), Color::purple(), Color::violet(), Color::darkPurple(),
    Color::beige(), Color::brown(), Color::darkBrown(), Color::lightGray(),
    Color::gray(), Color::darkGray(), Color::black()
];

// Define colorsRecs data (for every rectangle)
$colorsRecs = [];

for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
    $colorsRecs[$i] = new Rectangle(
        (float) 10 + 30 * $i + 2 * $i,
        (float) 10,
        (float) 30,
        (float) 30
    );
}

$colorSelected = 0;
$colorSelectedPrev = $colorSelected;
$colorMouseHover = 0;
$brushSize = 0;

$btnSaveRec = new Rectangle((float) 750, (float) 10, (float) 40, (float) 30);

//Includes "_" for supress error from psalm checks for Unused Variable
$_btnSaveMouseHover = false;
$showSaveMessage = false;
$saveMessageCounter = 0;

// Create a RenderTexture2D to use as a canvas
$target = $raylib->loadRenderTexture($screenWidth, $screenHeight);

// Clear render texture before entering the game loop
$raylib->beginTextureMode(new RenderTexture2D(
    $target->id,
    $target->texture,
    $target->depth
));
$raylib->clearBackground($colors[0]);
$raylib->endTextureMode();

$raylib->setTargetFPS(120);     // Set our game to run at 120 frames-per-second
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {      // Detect window close button or ESC key
    // Update
    //----------------------------------------------------------------------------------
    $mousePos = $raylib->getMousePosition();

    // Move between colors with keys
    if ($raylib->isKeyPressed(Raylib::KEY_RIGHT)) {
        $colorSelected++;
    } elseif ($raylib->isKeyPressed(Raylib::KEY_LEFT)) {
        $colorSelected--;
    }

    if ($colorSelected >= MAX_COLORS_COUNT) {
        $colorSelected = MAX_COLORS_COUNT - 1;
    } elseif ($colorSelected < 0) {
        $colorSelected = 0;
    }

    // Choose color with mouse
    for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
        if ($raylib->checkCollisionPointRec($mousePos, $colorsRecs[$i])) {
            $colorMouseHover = $i;
            break;
        } else {
            $colorMouseHover = -1;
        }
    }

    if (($colorMouseHover >= 0) && $raylib->isMouseButtonPressed(Raylib::MOUSE_LEFT_BUTTON)) {
        $colorSelected = $colorMouseHover;
        $colorSelectedPrev = $colorSelected;
    }

    // Change brush size
    $brushSize += $raylib->getMouseWheelMove() * 5;

    if ($brushSize < 2) {
        $brushSize = 2;
    }

    if ($brushSize > 50) {
        $brushSize = 50;
    }

    if ($raylib->isKeyPressed(Raylib::KEY_C)) {
        // Clear render texture to clear color
        $raylib->beginTextureMode($target);
        $raylib->clearBackground($colors[0]);
        $raylib->endTextureMode();
    }

    if (
        $raylib->isMouseButtonDown(Raylib::MOUSE_LEFT_BUTTON) ||
        ($raylib->getGestureDetected() === Raylib::GESTURE_DRAG)
    ) {
        // Paint circle into render texture
        // NOTE: To avoid discontinuous circles, we could store
        // previous-next mouse points and just draw a line using brush size
        $raylib->beginTextureMode($target);

        if ($mousePos->y > 50) {
            $raylib->drawCircle(
                (int) $mousePos->x,
                (int) $mousePos->y,
                $brushSize,
                $colors[$colorSelected]
            );
        }

        $raylib->endTextureMode();
    }

    if ($raylib->isMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
        $colorSelected = 0;

        // Erase circle from render texture
        $raylib->beginTextureMode($target);

        if ($mousePos->y > 50) {
            $raylib->drawCircle(
                (int) $mousePos->x,
                (int) $mousePos->y,
                $brushSize,
                $colors[0]
            );
        }

        $raylib->endTextureMode();
    } else {
        $colorSelected = $colorSelectedPrev;
    }

    // Check mouse hover save button
    if ($raylib->checkCollisionPointRec($mousePos, $btnSaveRec)) {
        $btnSaveMouseHover = true;
    } else {
        $btnSaveMouseHover = false;
    }

    // Image saving logic
    // NOTE: Saving painted texture to a default named image
    if (
        ($btnSaveMouseHover && $raylib->isMouseButtonReleased(Raylib::MOUSE_LEFT_BUTTON)) ||
        $raylib->isKeyPressed(Raylib::KEY_S)
    ) {
        $image = $raylib->getTextureData($target->texture);
        $raylib->imageFlipVertical($image);
        $raylib->exportImage($image, __DIR__ . '/resources/my_amazing_texture_painting.png');
        $raylib->unloadImage($image);
        $showSaveMessage = true;
    }

    if ($showSaveMessage) {
        // On saving, show a full screen message for 2 seconds
        $saveMessageCounter++;

        if ($saveMessageCounter > 240) {
            $showSaveMessage = false;
            $saveMessageCounter = 0;
        }
    }
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    //phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::rayWhite());

        // NOTE: Render texture must be y-flipped due to default OpenGL coordinates (left-bottom)
        $raylib->drawTextureRec(
            $target->texture,
            new Rectangle(0.0, 0.0, (float) $target->texture->width, -$target->texture->height),
            new Vector2(0.0, 0.0),
            Color::white()
        );

        // Draw drawing circle for reference
        if ($mousePos->y > 50) {
            if ($raylib->isMouseButtonDown(Raylib::MOUSE_RIGHT_BUTTON)) {
                $raylib->drawCircleLines((int) $mousePos->x, (int) $mousePos->y, $brushSize, Color::gray());
            } else {
                $raylib->drawCircle(
                    $raylib->getMouseX(),
                    $raylib->getMouseY(),
                    $brushSize,
                    $colors[$colorSelected]
                );
            }
        }

        // Draw top panel
        $raylib->drawRectangle(0.0, 0.0, $raylib->getScreenWidth(), 50.0, Color::rayWhite());
        $raylib->drawLine(0, 50, $raylib->getScreenWidth(), 50, Color::lightGray());

        // Draw color selection rectangles
        for ($i = 0; $i < MAX_COLORS_COUNT; $i++) {
            $raylib->drawRectangleRec($colorsRecs[$i], $colors[$i]);
        }

        $raylib->drawRectangleLines(10.0, 10.0, 30.0, 30.0, Color::lightGray());

        if ($colorMouseHover >= 0) {
            $raylib->drawRectangleRec($colorsRecs[$colorMouseHover], $raylib->fade(Color::white(), 0.6));
        }

        $raylib->drawRectangleLinesEx(
            new Rectangle(
                $colorsRecs[$colorSelected]->x - 2,
                $colorsRecs[$colorSelected]->y - 2,
                $colorsRecs[$colorSelected]->width + 4,
                $colorsRecs[$colorSelected]->height + 4
            ),
            2,
            Color::black()
        );

        // Draw save image button
        $raylib->drawRectangleLinesEx($btnSaveRec, 2, $btnSaveMouseHover ? Color::red() : Color::black());
        $raylib->drawText('SAVE!', 755, 20, 10, $btnSaveMouseHover ? Color::red() : Color::black());

        // Draw save image message
        if ($showSaveMessage) {
            $raylib->drawRectangle(
                0.0,
                0.0,
                (float) $raylib->getScreenWidth(),
                (float) $raylib->getScreenHeight(),
                $raylib->fade(Color::rayWhite(), 0.8)
            );

            $raylib->drawRectangle(
                0.0,
                150.0,
                (float) $raylib->getScreenWidth(),
                80.0,
                Color::black()
            );

            $raylib->drawText(
                'IMAGE SAVED:  my_amazing_texture_painting.png',
                150,
                180,
                20,
                Color::rayWhite()
            );
        }
    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->unloadRenderTexture($target);      // Unload render texture

$raylib->closeWindow();     // Close window and OpenGL context
//--------------------------------------------------------------------------------------
