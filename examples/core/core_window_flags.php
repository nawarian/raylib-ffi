<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\{Raylib, RaylibFactory};
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

$raylibFactory = new RaylibFactory();
$raylib = $raylibFactory->newInstance();

// Initialization
//---------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

// Possible window flags
/*
FLAG_VSYNC_HINT
FLAG_FULLSCREEN_MODE    -> not working properly -> wrong scaling!
FLAG_WINDOW_RESIZABLE
FLAG_WINDOW_UNDECORATED
FLAG_WINDOW_TRANSPARENT
FLAG_WINDOW_HIDDEN
FLAG_WINDOW_MINIMIZED   -> Not supported on window creation
FLAG_WINDOW_MAXIMIZED   -> Not supported on window creation
FLAG_WINDOW_UNFOCUSED
FLAG_WINDOW_TOPMOST
FLAG_WINDOW_HIGHDPI     -> errors after minimize-resize, fb size is recalculated
FLAG_WINDOW_ALWAYS_RUN
FLAG_MSAA_4X_HINT
*/

// Set configuration flags for window creation
$raylib->setConfigFlags(Raylib::FLAG_VSYNC_HINT | Raylib::FLAG_MSAA_4X_HINT | Raylib::FLAG_WINDOW_HIGHDPI);
$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - window flags");

$ballPosition = new Vector2((int) ($raylib->getScreenWidth() / 2), (int) ($raylib->getScreenHeight() / 2));
$ballSpeed = new Vector2(5, 4);
$ballRadius = 20;

$framesCounter = 0;

//----------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //-----------------------------------------------------
    if ($raylib->$raylib->isKeyPressed(Raylib::KEY_F)) {
        // modifies window size when scaling!
        $raylib->toggleFullscreen();
    }

    if ($raylib->isKeyPressed(Raylib::KEY_R)) {
        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_RESIZABLE)) {
            $raylib->clearWindowState(Raylib::FLAG_WINDOW_RESIZABLE);
        } else {
            $raylib->setWindowState(Raylib::FLAG_WINDOW_RESIZABLE);
        }
    }

    if ($raylib->isKeyPressed(Raylib::KEY_D)) {
        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_UNDECORATED)) {
            $raylib->ClearWindowState(Raylib::FLAG_WINDOW_UNDECORATED);
        } else {
            $raylib->SetWindowState(Raylib::FLAG_WINDOW_UNDECORATED);
        }
    }

    if ($raylib->isKeyPressed(Raylib::KEY_H)) {
        if (!$raylib->isWindowState(Raylib::FLAG_WINDOW_HIDDEN)) {
            $raylib->setWindowState(Raylib::FLAG_WINDOW_HIDDEN);
        }

        $framesCounter = 0;
    }

    if ($raylib->isWindowState(Raylib::FLAG_WINDOW_HIDDEN)) {
        $framesCounter++;
        if ($framesCounter >= 240) {
            // Show window after 3 seconds
            $raylib->clearWindowState(Raylib::FLAG_WINDOW_HIDDEN);
        }
    }

    if ($raylib->isKeyPressed(Raylib::KEY_N)) {
        if (!$raylib->isWindowState(Raylib::FLAG_WINDOW_MINIMIZED)) {
            $raylib->minimizeWindow();
        }

        $framesCounter = 0;
    }

    if ($raylib->isWindowState(Raylib::FLAG_WINDOW_MINIMIZED)) {
        $framesCounter++;
        if ($framesCounter >= 240) {
            $raylib->restoreWindow(); // Restore window after 3 seconds
        }
    }

    if ($raylib->isKeyPressed(Raylib::KEY_M)) {
        // NOTE: Requires FLAG_WINDOW_RESIZABLE enabled!
        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_MAXIMIZED)) {
            $raylib->restoreWindow();
        } else {
            $raylib->maximizeWindow();
        }
    }

    if ($raylib->isKeyPressed(Raylib::KEY_U)) {
        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_UNFOCUSED)) {
            $raylib->clearWindowState(Raylib::FLAG_WINDOW_UNFOCUSED);
        } else {
            $raylib->setWindowState(Raylib::FLAG_WINDOW_UNFOCUSED);
        }
    }

    if ($raylib->isKeyPressed(Raylib::KEY_T)) {
        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_TOPMOST)) {
            $raylib->clearWindowState(Raylib::FLAG_WINDOW_TOPMOST);
        } else {
            $raylib->setWindowState(Raylib::FLAG_WINDOW_TOPMOST);
        }
    }

    if ($raylib->isKeyPressed(Raylib::KEY_A)) {
        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN)) {
            $raylib->clearWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN);
        } else {
            $raylib->setWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN);
        }
    }

    if ($raylib->isKeyPressed(Raylib::KEY_V)) {
        if ($raylib->isWindowState(Raylib::FLAG_VSYNC_HINT)) {
            $raylib->clearWindowState(Raylib::FLAG_VSYNC_HINT);
        } else {
            $raylib->setWindowState(Raylib::FLAG_VSYNC_HINT);
        }
    }

    // Bouncing ball logic
    $ballPosition->x += $ballSpeed->x;
    $ballPosition->y += $ballSpeed->y;
    if (($ballPosition->x >= ($raylib->getScreenWidth() - $ballRadius)) || ($ballPosition->x <= $ballRadius)) {
        $ballSpeed->x *= -1.0;
    }

    if (($ballPosition->y >= ($raylib->getScreenHeight() - $ballRadius)) || ($ballPosition->y <= $ballRadius)) {
        $ballSpeed->y *= -1.0;
    };
    //-----------------------------------------------------

    // Draw
    //-----------------------------------------------------
    $raylib->beginDrawing();

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_TRANSPARENT)) {
            $raylib->clearBackground(Color::blank());
        } else {
            $raylib->clearBackground(Color::rayWhite());
        }

        $raylib->drawCircleV($ballPosition, $ballRadius, Color::maroon());
        $raylib->drawRectangleLinesEx(
            new Rectangle(0, 0, $raylib->getScreenWidth(), $raylib->getScreenHeight()),
            4,
            Color::rayWhite(),
        );

        $raylib->drawCircleV($raylib->getMousePosition(), 10, Color::darkBlue());

        $raylib->drawFPS(10, 10);

        $raylib->drawText(
            $raylib->formatText("Screen Size: [%d, %d]", $raylib->getScreenWidth(), $raylib->getScreenHeight()),
            10,
            40,
            10,
            Color::green(),
        );

        // Draw window state info
        $raylib->drawText(
            "Following flags can be set after window creation:",
            10,
            60,
            10,
            Color::gray(),
        );

        if ($raylib->isWindowState(Raylib::FLAG_FULLSCREEN_MODE)) {
            $raylib->drawText("[F] FLAG_FULLSCREEN_MODE: on", 10, 80, 10, Color::lime());
        } else {
            $raylib->drawText("[F] FLAG_FULLSCREEN_MODE: off", 10, 80, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_RESIZABLE)) {
            $raylib->drawText("[R] FLAG_WINDOW_RESIZABLE: on", 10, 100, 10, Color::lime());
        } else {
            $raylib->drawText("[R] FLAG_WINDOW_RESIZABLE: off", 10, 100, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_UNDECORATED)) {
            $raylib->drawText("[D] FLAG_WINDOW_UNDECORATED: on", 10, 120, 10, Color::lime());
        } else {
            $raylib->drawText("[D] FLAG_WINDOW_UNDECORATED: off", 10, 120, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_HIDDEN)) {
            $raylib->drawText("[H] FLAG_WINDOW_HIDDEN: on", 10, 140, 10, Color::lime());
        } else {
            $raylib->drawText("[H] FLAG_WINDOW_HIDDEN: off", 10, 140, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_MINIMIZED)) {
            $raylib->drawText("[N] FLAG_WINDOW_MINIMIZED: on", 10, 160, 10, Color::lime());
        } else {
            $raylib->drawText("[N] FLAG_WINDOW_MINIMIZED: off", 10, 160, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_MAXIMIZED)) {
            $raylib->drawText("[M] FLAG_WINDOW_MAXIMIZED: on", 10, 180, 10, Color::lime());
        } else {
            $raylib->drawText("[M] FLAG_WINDOW_MAXIMIZED: off", 10, 180, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_UNFOCUSED)) {
            $raylib->drawText("[G] FLAG_WINDOW_UNFOCUSED: on", 10, 200, 10, Color::lime());
        } else {
            $raylib->drawText("[U] FLAG_WINDOW_UNFOCUSED: off", 10, 200, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_TOPMOST)) {
            $raylib->drawText("[T] FLAG_WINDOW_TOPMOST: on", 10, 220, 10, Color::lime());
        } else {
            $raylib->drawText("[T] FLAG_WINDOW_TOPMOST: off", 10, 220, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN)) {
            $raylib->drawText("[A] FLAG_WINDOW_ALWAYS_RUN: on", 10, 240, 10, Color::lime());
        } else {
            $raylib->drawText("[A] FLAG_WINDOW_ALWAYS_RUN: off", 10, 240, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_VSYNC_HINT)) {
            $raylib->drawText("[V] FLAG_VSYNC_HINT: on", 10, 260, 10, Color::lime());
        } else {
            $raylib->drawText("[V] FLAG_VSYNC_HINT: off", 10, 260, 10, Color::maroon());
        }

        $raylib->drawText(
            "Following flags can only be set before window creation:",
            10,
            300,
            10,
            Color::gray(),
        );
        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_HIGHDPI)) {
            $raylib->drawText("FLAG_WINDOW_HIGHDPI: on", 10, 320, 10, Color::lime());
        } else {
            $raylib->drawText("FLAG_WINDOW_HIGHDPI: off", 10, 320, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_WINDOW_TRANSPARENT)) {
            $raylib->drawText("FLAG_WINDOW_TRANSPARENT: on", 10, 340, 10, Color::lime());
        } else {
            $raylib->drawText("FLAG_WINDOW_TRANSPARENT: off", 10, 340, 10, Color::maroon());
        }

        if ($raylib->isWindowState(Raylib::FLAG_MSAA_4X_HINT)) {
            $raylib->drawText("FLAG_MSAA_4X_HINT: on", 10, 360, 10, Color::lime());
        } else {
            $raylib->drawText("FLAG_MSAA_4X_HINT: off", 10, 360, 10, Color::maroon());
        }

    $raylib->endDrawing();
    //-----------------------------------------------------
}

// De-Initialization
//---------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//----------------------------------------------------------
