<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

interface HasRaylibWindowFlagConstants
{
    public const FLAG_VSYNC_HINT = 0x00000040;   // Set to try enabling V-Sync on GPU
    public const FLAG_FULLSCREEN_MODE = 0x00000002;   // Set to run program in fullscreen
    public const FLAG_WINDOW_RESIZABLE = 0x00000004;   // Set to allow resizable window
    public const FLAG_WINDOW_UNDECORATED = 0x00000008;   // Set to disable window decoration (frame and buttons)
    public const FLAG_WINDOW_HIDDEN = 0x00000080;   // Set to hide window
    public const FLAG_WINDOW_MINIMIZED = 0x00000200;   // Set to minimize window (iconify)
    public const FLAG_WINDOW_MAXIMIZED = 0x00000400;   // Set to maximize window (expanded to monitor)
    public const FLAG_WINDOW_UNFOCUSED = 0x00000800;   // Set to window non focused
    public const FLAG_WINDOW_TOPMOST = 0x00001000;   // Set to window always on top
    public const FLAG_WINDOW_ALWAYS_RUN = 0x00000100;   // Set to allow windows running while minimized
    public const FLAG_WINDOW_TRANSPARENT = 0x00000010;   // Set to allow transparent framebuffer
    public const FLAG_WINDOW_HIGHDPI = 0x00002000;   // Set to support HighDPI
    public const FLAG_MSAA_4X_HINT = 0x00000020;   // Set to try enabling MSAA 4X
    public const FLAG_INTERLACED_HINT = 0x00010000;   // Set to try enabling interlaced video format (for V3D)
}
