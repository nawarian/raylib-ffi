<?php

//declare(strict_types=1);

//use Nawarian\Raylib\Raylib;
//use Nawarian\Raylib\RaylibFactory;
//use Nawarian\Raylib\Types\Color;
//use Nawarian\Raylib\Types\Rectangle;
//
//require_once __DIR__ . '/../../vendor/autoload.php';

//$raylibFactory = new RaylibFactory();
//$raylib = $raylibFactory->newInstance();
//
//const NUM_PROCESS = 8;
//
//$processText = [
//    'NO PROCESSING',
//    'COLOR GRAYSCALE',
//    'COLOR TINT',
//    'COLOR INVERT',
//    'COLOR CONTRAST',
//    'COLOR BRIGHTNESS',
//    'FLIP VERTICAL',
//    'FLIP HORIZONTAL'
//];
//
//// Initialization
////--------------------------------------------------------------------------------------
//$screenWidth = 800;
//$screenHeight = 450;
//
//$raylib->initWindow($screenWidth, $screenHeight, 'raylib [textures] example - image processing');
//
//// NOTE: Textures MUST be loaded after Window initialization (OpenGL context is required)
//
//$image = $raylib->loadImage(__DIR__ . '/resources/parrots.png');        // Loaded in CPU memory (RAM)
////phpcs:ignore Generic.Files.LineLength.TooLong
//$raylib->imageFormat($image, Raylib::UNCOMPRESSED_R8G8B8A8);    // Format image to RGBA 32bit (required for texture update) <-- ISSUE
//$texture = $raylib->loadTextureFromImage($image);       // Image converted to texture, GPU memory (VRAM)
//
//$currentProcess = Raylib::NONE;
//$textureReload = false;
//
//$toggleRecs = [];
//$mouseHoverRec = -1;
//
//foreach (range(0, NUM_PROCESS) as $i) {
//    $toggleRecs[$i] = new Rectangle(
//        40.0,
//        (float) (50 + 32 * $i),
//        150.0,
//        30.0
//    );
//}
//
//$raylib->setTargetFPS(60);
////---------------------------------------------------------------------------------------
//
//// Main game loop
//while (!$raylib->windowShouldClose()) {     // Detect window close button or ESC key
//    // Update
//    //----------------------------------------------------------------------------------
//
//    // Mouse toggle group logic
//    for ($i = 0; $i < NUM_PROCESS; $i++) {
//        if ($raylib->checkCollisionPointRec($raylib->getMousePosition(), $toggleRecs[$i])) {
//            $mouseHoverRec = $i;
//
//            if ($raylib->isMouseButtonReleased(Raylib::MOUSE_LEFT_BUTTON)) {
//                $currentProcess = $i;
//                $textureReload = true;
//            }
//
//            break;
//        } else {
//            $mouseHoverRec = -1;
//        }
//    }
//
//    // Keyboard toggle group logic
//    if ($raylib->isKeyPressed(Raylib::KEY_DOWN)) {
//        $currentProcess++;
//
//        if ($currentProcess > 7) {
//            $currentProcess = 0;
//        }
//
//        $textureReload = true;
//    } elseif ($raylib->isKeyPressed(Raylib::KEY_UP)) {
//        $currentProcess--;
//
//        if ($currentProcess < 0) {
//            $currentProcess = 7;
//        }
//
//        $textureReload = true;
//    }
//
//    // Reload texture when required
//    if ($textureReload) {
//        $raylib->unloadImage($image);                                           // Unload current image data
//        $image = $raylib->loadImage(__DIR__ . '/resources/parrots.png');    // Re-load image data
//
//        // NOTE: Image processing is a costly CPU process to be done every frame,
//        // If image processing is required in a frame-basis, it should be done
//        // with a texture and by shaders
//        switch ($currentProcess) {
//            case Raylib::COLOR_GRAYSCALE:
//                $raylib->imageColorGrayscale($image);
//                break;
//            case Raylib::COLOR_TINT:
//                $raylib->imageColorTint($image, Color::green());
//                break;
//            case Raylib::COLOR_INVERT:
//                $raylib->imageColorInvert($image);
//                break;
//            case Raylib::COLOR_CONTRAST:
//                $raylib->imageColorContrast($image, -40);
//                break;
//            case Raylib::COLOR_BRIGHTNESS:
//                $raylib->imageColorBrightness($image, -80);
//                break;
//            case Raylib::FLIP_VERTICAL:
//                $raylib->imageFlipVertical($image);
//                break;
//            case Raylib::FLIP_HORIZONTAL:
//                $raylib->imageFlipHorizontal($image);
//                break;
//            default:
//                break;
//        }
//    }
//}
