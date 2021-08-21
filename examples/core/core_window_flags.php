<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\Types\{Color, Rectangle, Vector2};

use function Nawarian\Raylib\{
    BeginDrawing,
    ClearBackground,
    ClearWindowState,
    CloseWindow,
    DrawCircleV,
    DrawFPS,
    DrawRectangleLinesEx,
    DrawText,
    EndDrawing,
    GetMousePosition,
    GetScreenHeight,
    GetScreenWidth,
    InitWindow,
    IsKeyPressed,
    IsWindowState,
    MaximizeWindow,
    MinimizeWindow,
    RestoreWindow,
    SetConfigFlags,
    SetWindowState,
    TextFormat,
    ToggleFullscreen,
    WindowShouldClose
};

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
SetConfigFlags(Raylib::FLAG_VSYNC_HINT | Raylib::FLAG_MSAA_4X_HINT | Raylib::FLAG_WINDOW_HIGHDPI);
InitWindow($screenWidth, $screenHeight, 'raylib [core] example - window flags');

$ballPosition = new Vector2((int) (GetScreenWidth() / 2), (int) (GetScreenHeight() / 2));
$ballSpeed = new Vector2(5, 4);
$ballRadius = 20;

$framesCounter = 0;

//----------------------------------------------------------
// Main game loop
while (!WindowShouldClose()) {   // Detect window close button or ESC key
    // Update
    //-----------------------------------------------------
    if (IsKeyPressed(Raylib::KEY_F)) {
        // modifies window size when scaling!
        ToggleFullscreen();
    }

    if (IsKeyPressed(Raylib::KEY_R)) {
        if (IsWindowState(Raylib::FLAG_WINDOW_RESIZABLE)) {
            ClearWindowState(Raylib::FLAG_WINDOW_RESIZABLE);
        } else {
            SetWindowState(Raylib::FLAG_WINDOW_RESIZABLE);
        }
    }

    if (IsKeyPressed(Raylib::KEY_D)) {
        if (IsWindowState(Raylib::FLAG_WINDOW_UNDECORATED)) {
            ClearWindowState(Raylib::FLAG_WINDOW_UNDECORATED);
        } else {
            SetWindowState(Raylib::FLAG_WINDOW_UNDECORATED);
        }
    }

    if (IsKeyPressed(Raylib::KEY_H)) {
        if (!IsWindowState(Raylib::FLAG_WINDOW_HIDDEN)) {
            SetWindowState(Raylib::FLAG_WINDOW_HIDDEN);
        }

        $framesCounter = 0;
    }

    if (IsWindowState(Raylib::FLAG_WINDOW_HIDDEN)) {
        $framesCounter++;
        if ($framesCounter >= 240) {
            // Show window after 3 seconds
            ClearWindowState(Raylib::FLAG_WINDOW_HIDDEN);
        }
    }

    if (IsKeyPressed(Raylib::KEY_N)) {
        if (!IsWindowState(Raylib::FLAG_WINDOW_MINIMIZED)) {
            MinimizeWindow();
        }

        $framesCounter = 0;
    }

    if (IsWindowState(Raylib::FLAG_WINDOW_MINIMIZED)) {
        $framesCounter++;
        if ($framesCounter >= 240) {
            RestoreWindow(); // Restore window after 3 seconds
        }
    }

    if (IsKeyPressed(Raylib::KEY_M)) {
        // NOTE: Requires FLAG_WINDOW_RESIZABLE enabled!
        if (IsWindowState(Raylib::FLAG_WINDOW_MAXIMIZED)) {
            RestoreWindow();
        } else {
            MaximizeWindow();
        }
    }

    if (IsKeyPressed(Raylib::KEY_U)) {
        if (IsWindowState(Raylib::FLAG_WINDOW_UNFOCUSED)) {
            ClearWindowState(Raylib::FLAG_WINDOW_UNFOCUSED);
        } else {
            SetWindowState(Raylib::FLAG_WINDOW_UNFOCUSED);
        }
    }

    if (IsKeyPressed(Raylib::KEY_T)) {
        if (IsWindowState(Raylib::FLAG_WINDOW_TOPMOST)) {
            ClearWindowState(Raylib::FLAG_WINDOW_TOPMOST);
        } else {
            SetWindowState(Raylib::FLAG_WINDOW_TOPMOST);
        }
    }

    if (IsKeyPressed(Raylib::KEY_A)) {
        if (IsWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN)) {
            ClearWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN);
        } else {
            SetWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN);
        }
    }

    if (IsKeyPressed(Raylib::KEY_V)) {
        if (IsWindowState(Raylib::FLAG_VSYNC_HINT)) {
            ClearWindowState(Raylib::FLAG_VSYNC_HINT);
        } else {
            SetWindowState(Raylib::FLAG_VSYNC_HINT);
        }
    }

    // Bouncing ball logic
    $ballPosition->x += $ballSpeed->x;
    $ballPosition->y += $ballSpeed->y;
    if (($ballPosition->x >= (GetScreenWidth() - $ballRadius)) || ($ballPosition->x <= $ballRadius)) {
        $ballSpeed->x *= -1.0;
    }

    if (($ballPosition->y >= (GetScreenHeight() - $ballRadius)) || ($ballPosition->y <= $ballRadius)) {
        $ballSpeed->y *= -1.0;
    };
    //-----------------------------------------------------

    // Draw
    //-----------------------------------------------------
    BeginDrawing();
        // phpcs:disable Generic.WhiteSpace.ScopeIndent.IncorrectExact

        if (IsWindowState(Raylib::FLAG_WINDOW_TRANSPARENT)) {
            ClearBackground(Color::blank());
        } else {
            ClearBackground(Color::rayWhite());
        }

        DrawCircleV($ballPosition, $ballRadius, Color::maroon());
        DrawRectangleLinesEx(new Rectangle(0, 0, GetScreenWidth(), GetScreenHeight()), 4, Color::rayWhite());

        DrawCircleV(GetMousePosition(), 10, Color::darkBlue());

        DrawFPS(10, 10);

        DrawText(TextFormat('Screen Size: [%d, %d]', GetScreenWidth(), GetScreenHeight()), 10, 40, 10, Color::green());

        // Draw window state info
        DrawText('Following flags can be set after window creation:', 10, 60, 10, Color::gray());

        if (IsWindowState(Raylib::FLAG_FULLSCREEN_MODE)) {
            DrawText('[F] FLAG_FULLSCREEN_MODE: on', 10, 80, 10, Color::lime());
        } else {
            DrawText('[F] FLAG_FULLSCREEN_MODE: off', 10, 80, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_WINDOW_RESIZABLE)) {
            DrawText('[R] FLAG_WINDOW_RESIZABLE: on', 10, 100, 10, Color::lime());
        } else {
            DrawText('[R] FLAG_WINDOW_RESIZABLE: off', 10, 100, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_WINDOW_UNDECORATED)) {
            DrawText('[D] FLAG_WINDOW_UNDECORATED: on', 10, 120, 10, Color::lime());
        } else {
            DrawText('[D] FLAG_WINDOW_UNDECORATED: off', 10, 120, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_WINDOW_HIDDEN)) {
            DrawText('[H] FLAG_WINDOW_HIDDEN: on', 10, 140, 10, Color::lime());
        } else {
            DrawText('[H] FLAG_WINDOW_HIDDEN: off', 10, 140, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_WINDOW_MINIMIZED)) {
            DrawText('[N] FLAG_WINDOW_MINIMIZED: on', 10, 160, 10, Color::lime());
        } else {
            DrawText('[N] FLAG_WINDOW_MINIMIZED: off', 10, 160, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_WINDOW_MAXIMIZED)) {
            DrawText('[M] FLAG_WINDOW_MAXIMIZED: on', 10, 180, 10, Color::lime());
        } else {
            DrawText('[M] FLAG_WINDOW_MAXIMIZED: off', 10, 180, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_WINDOW_UNFOCUSED)) {
            DrawText('[G] FLAG_WINDOW_UNFOCUSED: on', 10, 200, 10, Color::lime());
        } else {
            DrawText('[U] FLAG_WINDOW_UNFOCUSED: off', 10, 200, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_WINDOW_TOPMOST)) {
            DrawText('[T] FLAG_WINDOW_TOPMOST: on', 10, 220, 10, Color::lime());
        } else {
            DrawText('[T] FLAG_WINDOW_TOPMOST: off', 10, 220, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN)) {
            DrawText('[A] FLAG_WINDOW_ALWAYS_RUN: on', 10, 240, 10, Color::lime());
        } else {
            DrawText('[A] FLAG_WINDOW_ALWAYS_RUN: off', 10, 240, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_VSYNC_HINT)) {
            DrawText('[V] FLAG_VSYNC_HINT: on', 10, 260, 10, Color::lime());
        } else {
            DrawText('[V] FLAG_VSYNC_HINT: off', 10, 260, 10, Color::maroon());
        }

        DrawText('Following flags can only be set before window creation:', 10, 300, 10, Color::gray());
        if (IsWindowState(Raylib::FLAG_WINDOW_HIGHDPI)) {
            DrawText('FLAG_WINDOW_HIGHDPI: on', 10, 320, 10, Color::lime());
        } else {
            DrawText('FLAG_WINDOW_HIGHDPI: off', 10, 320, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_WINDOW_TRANSPARENT)) {
            DrawText('FLAG_WINDOW_TRANSPARENT: on', 10, 340, 10, Color::lime());
        } else {
            DrawText('FLAG_WINDOW_TRANSPARENT: off', 10, 340, 10, Color::maroon());
        }

        if (IsWindowState(Raylib::FLAG_MSAA_4X_HINT)) {
            DrawText('FLAG_MSAA_4X_HINT: on', 10, 360, 10, Color::lime());
        } else {
            DrawText('FLAG_MSAA_4X_HINT: off', 10, 360, 10, Color::maroon());
        }
        // phpcs:enable Generic.WhiteSpace.ScopeIndent.IncorrectExact

    EndDrawing();
    //-----------------------------------------------------
}

// De-Initialization
//---------------------------------------------------------
CloseWindow();        // Close window and OpenGL context
//----------------------------------------------------------
