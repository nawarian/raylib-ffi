<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

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
\Nawarian\Raylib\SetConfigFlags(Raylib::FLAG_VSYNC_HINT | Raylib::FLAG_MSAA_4X_HINT | Raylib::FLAG_WINDOW_HIGHDPI);
\Nawarian\Raylib\InitWindow($screenWidth, $screenHeight, 'raylib [core] example - window flags');

$ballPosition = new Vector2((int) (\Nawarian\Raylib\GetScreenWidth() / 2), (int) (\Nawarian\Raylib\GetScreenHeight() / 2));
$ballSpeed = new Vector2(5, 4);
$ballRadius = 20;

$framesCounter = 0;

//----------------------------------------------------------
// Main game loop
while (!\Nawarian\Raylib\WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //-----------------------------------------------------
    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_F)) {
        // modifies window size when scaling!
        \Nawarian\Raylib\ToggleFullscreen();
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_R)) {
        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_RESIZABLE)) {
            \Nawarian\Raylib\ClearWindowState(Raylib::FLAG_WINDOW_RESIZABLE);
        } else {
            \Nawarian\Raylib\SetWindowState(Raylib::FLAG_WINDOW_RESIZABLE);
        }
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_D)) {
        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_UNDECORATED)) {
            \Nawarian\Raylib\ClearWindowState(Raylib::FLAG_WINDOW_UNDECORATED);
        } else {
            \Nawarian\Raylib\SetWindowState(Raylib::FLAG_WINDOW_UNDECORATED);
        }
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_H)) {
        if (!\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_HIDDEN)) {
            \Nawarian\Raylib\SetWindowState(Raylib::FLAG_WINDOW_HIDDEN);
        }

        $framesCounter = 0;
    }

    if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_HIDDEN)) {
        $framesCounter++;
        if ($framesCounter >= 240) {
            // Show window after 3 seconds
            \Nawarian\Raylib\ClearWindowState(Raylib::FLAG_WINDOW_HIDDEN);
        }
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_N)) {
        if (!\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_MINIMIZED)) {
            \Nawarian\Raylib\MinimizeWindow();
        }

        $framesCounter = 0;
    }

    if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_MINIMIZED)) {
        $framesCounter++;
        if ($framesCounter >= 240) {
            \Nawarian\Raylib\RestoreWindow(); // Restore window after 3 seconds
        }
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_M)) {
        // NOTE: Requires FLAG_WINDOW_RESIZABLE enabled!
        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_MAXIMIZED)) {
            \Nawarian\Raylib\RestoreWindow();
        } else {
            \Nawarian\Raylib\MaximizeWindow();
        }
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_U)) {
        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_UNFOCUSED)) {
            \Nawarian\Raylib\ClearWindowState(Raylib::FLAG_WINDOW_UNFOCUSED);
        } else {
            \Nawarian\Raylib\SetWindowState(Raylib::FLAG_WINDOW_UNFOCUSED);
        }
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_T)) {
        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_TOPMOST)) {
            \Nawarian\Raylib\ClearWindowState(Raylib::FLAG_WINDOW_TOPMOST);
        } else {
            \Nawarian\Raylib\SetWindowState(Raylib::FLAG_WINDOW_TOPMOST);
        }
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_A)) {
        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN)) {
            \Nawarian\Raylib\ClearWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN);
        } else {
            \Nawarian\Raylib\SetWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN);
        }
    }

    if (\Nawarian\Raylib\IsKeyPressed(Raylib::KEY_V)) {
        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_VSYNC_HINT)) {
            \Nawarian\Raylib\ClearWindowState(Raylib::FLAG_VSYNC_HINT);
        } else {
            \Nawarian\Raylib\SetWindowState(Raylib::FLAG_VSYNC_HINT);
        }
    }

    // Bouncing ball logic
    $ballPosition->x += $ballSpeed->x;
    $ballPosition->y += $ballSpeed->y;
    if (($ballPosition->x >= (\Nawarian\Raylib\GetScreenWidth() - $ballRadius)) || ($ballPosition->x <= $ballRadius)) {
        $ballSpeed->x *= -1.0;
    }

    if (($ballPosition->y >= (\Nawarian\Raylib\GetScreenHeight() - $ballRadius)) || ($ballPosition->y <= $ballRadius)) {
        $ballSpeed->y *= -1.0;
    };
    //-----------------------------------------------------

    // Draw
    //-----------------------------------------------------
    \Nawarian\Raylib\BeginDrawing();
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_TRANSPARENT)) {
            \Nawarian\Raylib\ClearBackground(Color::blank());
        } else {
            \Nawarian\Raylib\ClearBackground(Color::rayWhite());
        }

        \Nawarian\Raylib\DrawCircleV($ballPosition, $ballRadius, Color::maroon());
        \Nawarian\Raylib\DrawRectangleLinesEx(new Rectangle(0, 0, \Nawarian\Raylib\GetScreenWidth(), \Nawarian\Raylib\GetScreenHeight()), 4, Color::rayWhite());

        \Nawarian\Raylib\DrawCircleV(\Nawarian\Raylib\GetMousePosition(), 10, Color::darkBlue());

        \Nawarian\Raylib\DrawFPS(10, 10);

        \Nawarian\Raylib\DrawText(\Nawarian\Raylib\TextFormat('Screen Size: [%d, %d]', \Nawarian\Raylib\GetScreenWidth(), \Nawarian\Raylib\GetScreenHeight()), 10, 40, 10, Color::green());

        // Draw window state info
        \Nawarian\Raylib\DrawText('Following flags can be set after window creation:', 10, 60, 10, Color::gray());

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_FULLSCREEN_MODE)) {
            \Nawarian\Raylib\DrawText('[F] FLAG_FULLSCREEN_MODE: on', 10, 80, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[F] FLAG_FULLSCREEN_MODE: off', 10, 80, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_RESIZABLE)) {
            \Nawarian\Raylib\DrawText('[R] FLAG_WINDOW_RESIZABLE: on', 10, 100, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[R] FLAG_WINDOW_RESIZABLE: off', 10, 100, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_UNDECORATED)) {
            \Nawarian\Raylib\DrawText('[D] FLAG_WINDOW_UNDECORATED: on', 10, 120, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[D] FLAG_WINDOW_UNDECORATED: off', 10, 120, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_HIDDEN)) {
            \Nawarian\Raylib\DrawText('[H] FLAG_WINDOW_HIDDEN: on', 10, 140, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[H] FLAG_WINDOW_HIDDEN: off', 10, 140, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_MINIMIZED)) {
            \Nawarian\Raylib\DrawText('[N] FLAG_WINDOW_MINIMIZED: on', 10, 160, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[N] FLAG_WINDOW_MINIMIZED: off', 10, 160, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_MAXIMIZED)) {
            \Nawarian\Raylib\DrawText('[M] FLAG_WINDOW_MAXIMIZED: on', 10, 180, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[M] FLAG_WINDOW_MAXIMIZED: off', 10, 180, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_UNFOCUSED)) {
            \Nawarian\Raylib\DrawText('[G] FLAG_WINDOW_UNFOCUSED: on', 10, 200, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[U] FLAG_WINDOW_UNFOCUSED: off', 10, 200, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_TOPMOST)) {
            \Nawarian\Raylib\DrawText('[T] FLAG_WINDOW_TOPMOST: on', 10, 220, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[T] FLAG_WINDOW_TOPMOST: off', 10, 220, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN)) {
            \Nawarian\Raylib\DrawText('[A] FLAG_WINDOW_ALWAYS_RUN: on', 10, 240, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[A] FLAG_WINDOW_ALWAYS_RUN: off', 10, 240, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_VSYNC_HINT)) {
            \Nawarian\Raylib\DrawText('[V] FLAG_VSYNC_HINT: on', 10, 260, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('[V] FLAG_VSYNC_HINT: off', 10, 260, 10, Color::maroon());
        }

        \Nawarian\Raylib\DrawText('Following flags can only be set before window creation:', 10, 300, 10, Color::gray());
        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_HIGHDPI)) {
            \Nawarian\Raylib\DrawText('FLAG_WINDOW_HIGHDPI: on', 10, 320, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('FLAG_WINDOW_HIGHDPI: off', 10, 320, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_WINDOW_TRANSPARENT)) {
            \Nawarian\Raylib\DrawText('FLAG_WINDOW_TRANSPARENT: on', 10, 340, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('FLAG_WINDOW_TRANSPARENT: off', 10, 340, 10, Color::maroon());
        }

        if (\Nawarian\Raylib\IsWindowState(Raylib::FLAG_MSAA_4X_HINT)) {
            \Nawarian\Raylib\DrawText('FLAG_MSAA_4X_HINT: on', 10, 360, 10, Color::lime());
        } else {
            \Nawarian\Raylib\DrawText('FLAG_MSAA_4X_HINT: off', 10, 360, 10, Color::maroon());
        }
        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

    \Nawarian\Raylib\EndDrawing();
    //-----------------------------------------------------
}

// De-Initialization
//---------------------------------------------------------
\Nawarian\Raylib\CloseWindow();        // Close window and OpenGL context
//----------------------------------------------------------
