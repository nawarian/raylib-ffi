<?php

declare(strict_types=1);

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;

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
$colorRecs = [];