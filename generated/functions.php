<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

/**
 * Initialize window and OpenGL context
 */
function InitWindow(int $width, int $height, string $title): void
{
    global $raylib;
    $raylib->InitWindow($width, $height, $title);
}

/**
 * Check if KEY_ESCAPE pressed or Close icon pressed
 */
function WindowShouldClose(): bool
{
    global $raylib;
    return $raylib->WindowShouldClose();
}

/**
 * Close window and unload OpenGL context
 */
function CloseWindow(): void
{
    global $raylib;
    $raylib->CloseWindow();
}

/**
 * Check if window has been initialized successfully
 */
function IsWindowReady(): bool
{
    global $raylib;
    return $raylib->IsWindowReady();
}

/**
 * Check if window is currently fullscreen
 */
function IsWindowFullscreen(): bool
{
    global $raylib;
    return $raylib->IsWindowFullscreen();
}

/**
 * Check if window is currently hidden (only PLATFORM_DESKTOP)
 */
function IsWindowHidden(): bool
{
    global $raylib;
    return $raylib->IsWindowHidden();
}

/**
 * Check if window is currently minimized (only PLATFORM_DESKTOP)
 */
function IsWindowMinimized(): bool
{
    global $raylib;
    return $raylib->IsWindowMinimized();
}

/**
 * Check if window is currently maximized (only PLATFORM_DESKTOP)
 */
function IsWindowMaximized(): bool
{
    global $raylib;
    return $raylib->IsWindowMaximized();
}

/**
 * Check if window is currently focused (only PLATFORM_DESKTOP)
 */
function IsWindowFocused(): bool
{
    global $raylib;
    return $raylib->IsWindowFocused();
}

/**
 * Check if window has been resized last frame
 */
function IsWindowResized(): bool
{
    global $raylib;
    return $raylib->IsWindowResized();
}

/**
 * Check if one specific window flag is enabled
 */
function IsWindowState(int $flag): bool
{
    global $raylib;
    return $raylib->IsWindowState($flag);
}

/**
 * Set window configuration state using flags
 */
function SetWindowState(int $flags): void
{
    global $raylib;
    $raylib->SetWindowState($flags);
}

/**
 * Clear window configuration state flags
 */
function ClearWindowState(int $flags): void
{
    global $raylib;
    $raylib->ClearWindowState($flags);
}

/**
 * Toggle window state: fullscreen/windowed (only PLATFORM_DESKTOP)
 */
function ToggleFullscreen(): void
{
    global $raylib;
    $raylib->ToggleFullscreen();
}

/**
 * Set window state: maximized, if resizable (only PLATFORM_DESKTOP)
 */
function MaximizeWindow(): void
{
    global $raylib;
    $raylib->MaximizeWindow();
}

/**
 * Set window state: minimized, if resizable (only PLATFORM_DESKTOP)
 */
function MinimizeWindow(): void
{
    global $raylib;
    $raylib->MinimizeWindow();
}

/**
 * Set window state: not minimized/maximized (only PLATFORM_DESKTOP)
 */
function RestoreWindow(): void
{
    global $raylib;
    $raylib->RestoreWindow();
}

/**
 * Set icon for window (only PLATFORM_DESKTOP)
 */
function SetWindowIcon(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->SetWindowIcon($image->toCData());
}

/**
 * Set title for window (only PLATFORM_DESKTOP)
 */
function SetWindowTitle(string $title): void
{
    global $raylib;
    $raylib->SetWindowTitle($title);
}

/**
 * Set window position on screen (only PLATFORM_DESKTOP)
 */
function SetWindowPosition(int $x, int $y): void
{
    global $raylib;
    $raylib->SetWindowPosition($x, $y);
}

/**
 * Set monitor for the current window (fullscreen mode)
 */
function SetWindowMonitor(int $monitor): void
{
    global $raylib;
    $raylib->SetWindowMonitor($monitor);
}

/**
 * Set window minimum dimensions (for FLAG_WINDOW_RESIZABLE)
 */
function SetWindowMinSize(int $width, int $height): void
{
    global $raylib;
    $raylib->SetWindowMinSize($width, $height);
}

/**
 * Set window dimensions
 */
function SetWindowSize(int $width, int $height): void
{
    global $raylib;
    $raylib->SetWindowSize($width, $height);
}

/**
 * Get native window handle
 */
function GetWindowHandle(): \FFI\CData
{
    global $raylib;
    return $raylib->GetWindowHandle();
}

/**
 * Get current screen width
 */
function GetScreenWidth(): int
{
    global $raylib;
    return $raylib->GetScreenWidth();
}

/**
 * Get current screen height
 */
function GetScreenHeight(): int
{
    global $raylib;
    return $raylib->GetScreenHeight();
}

/**
 * Get number of connected monitors
 */
function GetMonitorCount(): int
{
    global $raylib;
    return $raylib->GetMonitorCount();
}

/**
 * Get current connected monitor
 */
function GetCurrentMonitor(): int
{
    global $raylib;
    return $raylib->GetCurrentMonitor();
}

/**
 * Get specified monitor position
 */
function GetMonitorPosition(int $monitor): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetMonitorPosition($monitor));
}

/**
 * Get specified monitor width (max available by monitor)
 */
function GetMonitorWidth(int $monitor): int
{
    global $raylib;
    return $raylib->GetMonitorWidth($monitor);
}

/**
 * Get specified monitor height (max available by monitor)
 */
function GetMonitorHeight(int $monitor): int
{
    global $raylib;
    return $raylib->GetMonitorHeight($monitor);
}

/**
 * Get specified monitor physical width in millimetres
 */
function GetMonitorPhysicalWidth(int $monitor): int
{
    global $raylib;
    return $raylib->GetMonitorPhysicalWidth($monitor);
}

/**
 * Get specified monitor physical height in millimetres
 */
function GetMonitorPhysicalHeight(int $monitor): int
{
    global $raylib;
    return $raylib->GetMonitorPhysicalHeight($monitor);
}

/**
 * Get specified monitor refresh rate
 */
function GetMonitorRefreshRate(int $monitor): int
{
    global $raylib;
    return $raylib->GetMonitorRefreshRate($monitor);
}

/**
 * Get window position XY on monitor
 */
function GetWindowPosition(): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWindowPosition());
}

/**
 * Get window scale DPI factor
 */
function GetWindowScaleDPI(): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWindowScaleDPI());
}

/**
 * Get the human-readable, UTF-8 encoded name of the primary monitor
 */
function GetMonitorName(int $monitor): string
{
    global $raylib;
    return $raylib->GetMonitorName($monitor);
}

/**
 * Set clipboard text content
 */
function SetClipboardText(string $text): void
{
    global $raylib;
    $raylib->SetClipboardText($text);
}

/**
 * Get clipboard text content
 */
function GetClipboardText(): string
{
    global $raylib;
    return $raylib->GetClipboardText();
}

/**
 * Shows cursor
 */
function ShowCursor(): void
{
    global $raylib;
    $raylib->ShowCursor();
}

/**
 * Hides cursor
 */
function HideCursor(): void
{
    global $raylib;
    $raylib->HideCursor();
}

/**
 * Check if cursor is not visible
 */
function IsCursorHidden(): bool
{
    global $raylib;
    return $raylib->IsCursorHidden();
}

/**
 * Enables cursor (unlock cursor)
 */
function EnableCursor(): void
{
    global $raylib;
    $raylib->EnableCursor();
}

/**
 * Disables cursor (lock cursor)
 */
function DisableCursor(): void
{
    global $raylib;
    $raylib->DisableCursor();
}

/**
 * Check if cursor is on the screen
 */
function IsCursorOnScreen(): bool
{
    global $raylib;
    return $raylib->IsCursorOnScreen();
}

/**
 * Set background color (framebuffer clear color)
 */
function ClearBackground(\Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ClearBackground($color->toCData());
}

/**
 * Setup canvas (framebuffer) to start drawing
 */
function BeginDrawing(): void
{
    global $raylib;
    $raylib->BeginDrawing();
}

/**
 * End canvas drawing and swap buffers (double buffering)
 */
function EndDrawing(): void
{
    global $raylib;
    $raylib->EndDrawing();
}

/**
 * Begin 2D mode with custom camera (2D)
 */
function BeginMode2D(\Nawarian\Raylib\Generated\Camera2D $camera): void
{
    global $raylib;
    $raylib->BeginMode2D($camera->toCData());
}

/**
 * Ends 2D mode with custom camera
 */
function EndMode2D(): void
{
    global $raylib;
    $raylib->EndMode2D();
}

/**
 * Begin 3D mode with custom camera (3D)
 */
function BeginMode3D(\Nawarian\Raylib\Generated\Camera3D $camera): void
{
    global $raylib;
    $raylib->BeginMode3D($camera->toCData());
}

/**
 * Ends 3D mode and returns to default 2D orthographic mode
 */
function EndMode3D(): void
{
    global $raylib;
    $raylib->EndMode3D();
}

/**
 * Begin drawing to render texture
 */
function BeginTextureMode(\Nawarian\Raylib\Generated\RenderTexture $target): void
{
    global $raylib;
    $raylib->BeginTextureMode($target->toCData());
}

/**
 * Ends drawing to render texture
 */
function EndTextureMode(): void
{
    global $raylib;
    $raylib->EndTextureMode();
}

/**
 * Begin custom shader drawing
 */
function BeginShaderMode(\Nawarian\Raylib\Generated\Shader $shader): void
{
    global $raylib;
    $raylib->BeginShaderMode($shader->toCData());
}

/**
 * End custom shader drawing (use default shader)
 */
function EndShaderMode(): void
{
    global $raylib;
    $raylib->EndShaderMode();
}

/**
 * Begin blending mode (alpha, additive, multiplied, subtract, custom)
 */
function BeginBlendMode(int $mode): void
{
    global $raylib;
    $raylib->BeginBlendMode($mode);
}

/**
 * End blending mode (reset to default: alpha blending)
 */
function EndBlendMode(): void
{
    global $raylib;
    $raylib->EndBlendMode();
}

/**
 * Begin scissor mode (define screen area for following drawing)
 */
function BeginScissorMode(int $x, int $y, int $width, int $height): void
{
    global $raylib;
    $raylib->BeginScissorMode($x, $y, $width, $height);
}

/**
 * End scissor mode
 */
function EndScissorMode(): void
{
    global $raylib;
    $raylib->EndScissorMode();
}

/**
 * Begin stereo rendering (requires VR simulator)
 */
function BeginVrStereoMode(\Nawarian\Raylib\Generated\VrStereoConfig $config): void
{
    global $raylib;
    $raylib->BeginVrStereoMode($config->toCData());
}

/**
 * End stereo rendering (requires VR simulator)
 */
function EndVrStereoMode(): void
{
    global $raylib;
    $raylib->EndVrStereoMode();
}

/**
 * Load VR stereo config for VR simulator device parameters
 */
function LoadVrStereoConfig(\Nawarian\Raylib\Generated\VrDeviceInfo $device): \Nawarian\Raylib\Generated\VrStereoConfig
{
    global $raylib;
    return \Nawarian\Raylib\Generated\VrStereoConfig::fromCData($raylib->LoadVrStereoConfig($device->toCData()));
}

/**
 * Unload VR stereo config
 */
function UnloadVrStereoConfig(\Nawarian\Raylib\Generated\VrStereoConfig $config): void
{
    global $raylib;
    $raylib->UnloadVrStereoConfig($config->toCData());
}

/**
 * Load shader from files and bind default locations
 */
function LoadShader(string $vsFileName, string $fsFileName): \Nawarian\Raylib\Generated\Shader
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Shader::fromCData($raylib->LoadShader($vsFileName, $fsFileName));
}

/**
 * Load shader from code strings and bind default locations
 */
function LoadShaderFromMemory(string $vsCode, string $fsCode): \Nawarian\Raylib\Generated\Shader
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Shader::fromCData($raylib->LoadShaderFromMemory($vsCode, $fsCode));
}

/**
 * Get shader uniform location
 */
function GetShaderLocation(\Nawarian\Raylib\Generated\Shader $shader, string $uniformName): int
{
    global $raylib;
    return $raylib->GetShaderLocation($shader->toCData(), $uniformName);
}

/**
 * Get shader attribute location
 */
function GetShaderLocationAttrib(\Nawarian\Raylib\Generated\Shader $shader, string $attribName): int
{
    global $raylib;
    return $raylib->GetShaderLocationAttrib($shader->toCData(), $attribName);
}

/**
 * Set shader uniform value
 */
function SetShaderValue(\Nawarian\Raylib\Generated\Shader $shader, int $locIndex, \FFI\CData $value, int $uniformType): void
{
    global $raylib;
    $raylib->SetShaderValue($shader->toCData(), $locIndex, $value, $uniformType);
}

/**
 * Set shader uniform value vector
 */
function SetShaderValueV(\Nawarian\Raylib\Generated\Shader $shader, int $locIndex, \FFI\CData $value, int $uniformType, int $count): void
{
    global $raylib;
    $raylib->SetShaderValueV($shader->toCData(), $locIndex, $value, $uniformType, $count);
}

/**
 * Set shader uniform value (matrix 4x4)
 */
function SetShaderValueMatrix(\Nawarian\Raylib\Generated\Shader $shader, int $locIndex, \Nawarian\Raylib\Generated\Matrix $mat): void
{
    global $raylib;
    $raylib->SetShaderValueMatrix($shader->toCData(), $locIndex, $mat->toCData());
}

/**
 * Set shader uniform value for texture (sampler2d)
 */
function SetShaderValueTexture(\Nawarian\Raylib\Generated\Shader $shader, int $locIndex, \Nawarian\Raylib\Generated\Texture $texture): void
{
    global $raylib;
    $raylib->SetShaderValueTexture($shader->toCData(), $locIndex, $texture->toCData());
}

/**
 * Unload shader from GPU memory (VRAM)
 */
function UnloadShader(\Nawarian\Raylib\Generated\Shader $shader): void
{
    global $raylib;
    $raylib->UnloadShader($shader->toCData());
}

/**
 * Get a ray trace from mouse position
 */
function GetMouseRay(\Nawarian\Raylib\Generated\Vector2 $mousePosition, \Nawarian\Raylib\Generated\Camera3D $camera): \Nawarian\Raylib\Generated\Ray
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Ray::fromCData($raylib->GetMouseRay($mousePosition->toCData(), $camera->toCData()));
}

/**
 * Get camera transform matrix (view matrix)
 */
function GetCameraMatrix(\Nawarian\Raylib\Generated\Camera3D $camera): \Nawarian\Raylib\Generated\Matrix
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Matrix::fromCData($raylib->GetCameraMatrix($camera->toCData()));
}

/**
 * Get camera 2d transform matrix
 */
function GetCameraMatrix2D(\Nawarian\Raylib\Generated\Camera2D $camera): \Nawarian\Raylib\Generated\Matrix
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Matrix::fromCData($raylib->GetCameraMatrix2D($camera->toCData()));
}

/**
 * Get the screen space position for a 3d world space position
 */
function GetWorldToScreen(\Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Camera3D $camera): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWorldToScreen($position->toCData(), $camera->toCData()));
}

/**
 * Get size position for a 3d world space position
 */
function GetWorldToScreenEx(\Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Camera3D $camera, int $width, int $height): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWorldToScreenEx($position->toCData(), $camera->toCData(), $width, $height));
}

/**
 * Get the screen space position for a 2d camera world space position
 */
function GetWorldToScreen2D(\Nawarian\Raylib\Generated\Vector2 $position, \Nawarian\Raylib\Generated\Camera2D $camera): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWorldToScreen2D($position->toCData(), $camera->toCData()));
}

/**
 * Get the world space position for a 2d camera screen space position
 */
function GetScreenToWorld2D(\Nawarian\Raylib\Generated\Vector2 $position, \Nawarian\Raylib\Generated\Camera2D $camera): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetScreenToWorld2D($position->toCData(), $camera->toCData()));
}

/**
 * Set target FPS (maximum)
 */
function SetTargetFPS(int $fps): void
{
    global $raylib;
    $raylib->SetTargetFPS($fps);
}

/**
 * Get current FPS
 */
function GetFPS(): int
{
    global $raylib;
    return $raylib->GetFPS();
}

/**
 * Get time in seconds for last frame drawn (delta time)
 */
function GetFrameTime(): float
{
    global $raylib;
    return $raylib->GetFrameTime();
}

/**
 * Get elapsed time in seconds since InitWindow()
 */
function GetTime(): float
{
    global $raylib;
    return $raylib->GetTime();
}

/**
 * Get a random value between min and max (both included)
 */
function GetRandomValue(int $min, int $max): int
{
    global $raylib;
    return $raylib->GetRandomValue($min, $max);
}

/**
 * Takes a screenshot of current screen (filename extension defines format)
 */
function TakeScreenshot(string $fileName): void
{
    global $raylib;
    $raylib->TakeScreenshot($fileName);
}

/**
 * Setup init configuration flags (view FLAGS)
 */
function SetConfigFlags(int $flags): void
{
    global $raylib;
    $raylib->SetConfigFlags($flags);
}

/**
 * Set the current threshold (minimum) log level
 */
function SetTraceLogLevel(int $logLevel): void
{
    global $raylib;
    $raylib->SetTraceLogLevel($logLevel);
}

/**
 * Internal memory allocator
 */
function MemAlloc(int $size): \FFI\CData
{
    global $raylib;
    return $raylib->MemAlloc($size);
}

/**
 * Internal memory reallocator
 */
function MemRealloc(\FFI\CData $ptr, int $size): \FFI\CData
{
    global $raylib;
    return $raylib->MemRealloc($ptr, $size);
}

/**
 * Internal memory free
 */
function MemFree(\FFI\CData $ptr): void
{
    global $raylib;
    $raylib->MemFree($ptr);
}

/**
 * Load file data as byte array (read)
 */
function LoadFileData(string $fileName, array $bytesRead): array
{
    global $raylib;
    return $raylib->LoadFileData($fileName, $bytesRead);
}

/**
 * Unload file data allocated by LoadFileData()
 */
function UnloadFileData(array $data): void
{
    global $raylib;
    $raylib->UnloadFileData($data);
}

/**
 * Save data to file from byte array (write), returns true on success
 */
function SaveFileData(string $fileName, \FFI\CData $data, int $bytesToWrite): bool
{
    global $raylib;
    return $raylib->SaveFileData($fileName, $data, $bytesToWrite);
}

/**
 * Load text data from file (read), returns a ' 0' terminated string
 */
function LoadFileText(string $fileName): string
{
    global $raylib;
    return $raylib->LoadFileText($fileName);
}

/**
 * Unload file text data allocated by LoadFileText()
 */
function UnloadFileText(string $text): void
{
    global $raylib;
    $raylib->UnloadFileText($text);
}

/**
 * Save text data to file (write), string must be ' 0' terminated, returns true on
 * success
 */
function SaveFileText(string $fileName, string $text): bool
{
    global $raylib;
    return $raylib->SaveFileText($fileName, $text);
}

/**
 * Check if file exists
 */
function FileExists(string $fileName): bool
{
    global $raylib;
    return $raylib->FileExists($fileName);
}

/**
 * Check if a directory path exists
 */
function DirectoryExists(string $dirPath): bool
{
    global $raylib;
    return $raylib->DirectoryExists($dirPath);
}

/**
 * Check file extension (including point: .png, .wav)
 */
function IsFileExtension(string $fileName, string $ext): bool
{
    global $raylib;
    return $raylib->IsFileExtension($fileName, $ext);
}

/**
 * Get pointer to extension for a filename string (includes dot: '.png')
 */
function GetFileExtension(string $fileName): string
{
    global $raylib;
    return $raylib->GetFileExtension($fileName);
}

/**
 * Get pointer to filename for a path string
 */
function GetFileName(string $filePath): string
{
    global $raylib;
    return $raylib->GetFileName($filePath);
}

/**
 * Get filename string without extension (uses static string)
 */
function GetFileNameWithoutExt(string $filePath): string
{
    global $raylib;
    return $raylib->GetFileNameWithoutExt($filePath);
}

/**
 * Get full path for a given fileName with path (uses static string)
 */
function GetDirectoryPath(string $filePath): string
{
    global $raylib;
    return $raylib->GetDirectoryPath($filePath);
}

/**
 * Get previous directory path for a given path (uses static string)
 */
function GetPrevDirectoryPath(string $dirPath): string
{
    global $raylib;
    return $raylib->GetPrevDirectoryPath($dirPath);
}

/**
 * Get current working directory (uses static string)
 */
function GetWorkingDirectory(): string
{
    global $raylib;
    return $raylib->GetWorkingDirectory();
}

/**
 * Get filenames in a directory path (memory should be freed)
 */
function GetDirectoryFiles(string $dirPath, array $count): array
{
    global $raylib;
    return $raylib->GetDirectoryFiles($dirPath, $count);
}

/**
 * Clear directory files paths buffers (free memory)
 */
function ClearDirectoryFiles(): void
{
    global $raylib;
    $raylib->ClearDirectoryFiles();
}

/**
 * Change working directory, return true on success
 */
function ChangeDirectory(string $dir): bool
{
    global $raylib;
    return $raylib->ChangeDirectory($dir);
}

/**
 * Check if a file has been dropped into window
 */
function IsFileDropped(): bool
{
    global $raylib;
    return $raylib->IsFileDropped();
}

/**
 * Get dropped files names (memory should be freed)
 */
function GetDroppedFiles(array $count): array
{
    global $raylib;
    return $raylib->GetDroppedFiles($count);
}

/**
 * Clear dropped files paths buffer (free memory)
 */
function ClearDroppedFiles(): void
{
    global $raylib;
    $raylib->ClearDroppedFiles();
}

/**
 * Get file modification time (last write time)
 */
function GetFileModTime(string $fileName): int
{
    global $raylib;
    return $raylib->GetFileModTime($fileName);
}

/**
 * Compress data (DEFLATE algorithm)
 */
function CompressData(array $data, int $dataLength, array $compDataLength): array
{
    global $raylib;
    return $raylib->CompressData($data, $dataLength, $compDataLength);
}

/**
 * Decompress data (DEFLATE algorithm)
 */
function DecompressData(array $compData, int $compDataLength, array $dataLength): array
{
    global $raylib;
    return $raylib->DecompressData($compData, $compDataLength, $dataLength);
}

/**
 * Save integer value to storage file (to defined position), returns true on
 * success
 */
function SaveStorageValue(int $position, int $value): bool
{
    global $raylib;
    return $raylib->SaveStorageValue($position, $value);
}

/**
 * Load integer value from storage file (from defined position)
 */
function LoadStorageValue(int $position): int
{
    global $raylib;
    return $raylib->LoadStorageValue($position);
}

/**
 * Open URL with default system browser (if available)
 */
function OpenURL(string $url): void
{
    global $raylib;
    $raylib->OpenURL($url);
}

/**
 * Check if a key has been pressed once
 */
function IsKeyPressed(int $key): bool
{
    global $raylib;
    return $raylib->IsKeyPressed($key);
}

/**
 * Check if a key is being pressed
 */
function IsKeyDown(int $key): bool
{
    global $raylib;
    return $raylib->IsKeyDown($key);
}

/**
 * Check if a key has been released once
 */
function IsKeyReleased(int $key): bool
{
    global $raylib;
    return $raylib->IsKeyReleased($key);
}

/**
 * Check if a key is NOT being pressed
 */
function IsKeyUp(int $key): bool
{
    global $raylib;
    return $raylib->IsKeyUp($key);
}

/**
 * Set a custom key to exit program (default is ESC)
 */
function SetExitKey(int $key): void
{
    global $raylib;
    $raylib->SetExitKey($key);
}

/**
 * Get key pressed (keycode), call it multiple times for keys queued
 */
function GetKeyPressed(): int
{
    global $raylib;
    return $raylib->GetKeyPressed();
}

/**
 * Get char pressed (unicode), call it multiple times for chars queued
 */
function GetCharPressed(): int
{
    global $raylib;
    return $raylib->GetCharPressed();
}

/**
 * Check if a gamepad is available
 */
function IsGamepadAvailable(int $gamepad): bool
{
    global $raylib;
    return $raylib->IsGamepadAvailable($gamepad);
}

/**
 * Check gamepad name (if available)
 */
function IsGamepadName(int $gamepad, string $name): bool
{
    global $raylib;
    return $raylib->IsGamepadName($gamepad, $name);
}

/**
 * Get gamepad internal name id
 */
function GetGamepadName(int $gamepad): string
{
    global $raylib;
    return $raylib->GetGamepadName($gamepad);
}

/**
 * Check if a gamepad button has been pressed once
 */
function IsGamepadButtonPressed(int $gamepad, int $button): bool
{
    global $raylib;
    return $raylib->IsGamepadButtonPressed($gamepad, $button);
}

/**
 * Check if a gamepad button is being pressed
 */
function IsGamepadButtonDown(int $gamepad, int $button): bool
{
    global $raylib;
    return $raylib->IsGamepadButtonDown($gamepad, $button);
}

/**
 * Check if a gamepad button has been released once
 */
function IsGamepadButtonReleased(int $gamepad, int $button): bool
{
    global $raylib;
    return $raylib->IsGamepadButtonReleased($gamepad, $button);
}

/**
 * Check if a gamepad button is NOT being pressed
 */
function IsGamepadButtonUp(int $gamepad, int $button): bool
{
    global $raylib;
    return $raylib->IsGamepadButtonUp($gamepad, $button);
}

/**
 * Get the last gamepad button pressed
 */
function GetGamepadButtonPressed(): int
{
    global $raylib;
    return $raylib->GetGamepadButtonPressed();
}

/**
 * Get gamepad axis count for a gamepad
 */
function GetGamepadAxisCount(int $gamepad): int
{
    global $raylib;
    return $raylib->GetGamepadAxisCount($gamepad);
}

/**
 * Get axis movement value for a gamepad axis
 */
function GetGamepadAxisMovement(int $gamepad, int $axis): float
{
    global $raylib;
    return $raylib->GetGamepadAxisMovement($gamepad, $axis);
}

/**
 * Set internal gamepad mappings (SDL_GameControllerDB)
 */
function SetGamepadMappings(string $mappings): int
{
    global $raylib;
    return $raylib->SetGamepadMappings($mappings);
}

/**
 * Check if a mouse button has been pressed once
 */
function IsMouseButtonPressed(int $button): bool
{
    global $raylib;
    return $raylib->IsMouseButtonPressed($button);
}

/**
 * Check if a mouse button is being pressed
 */
function IsMouseButtonDown(int $button): bool
{
    global $raylib;
    return $raylib->IsMouseButtonDown($button);
}

/**
 * Check if a mouse button has been released once
 */
function IsMouseButtonReleased(int $button): bool
{
    global $raylib;
    return $raylib->IsMouseButtonReleased($button);
}

/**
 * Check if a mouse button is NOT being pressed
 */
function IsMouseButtonUp(int $button): bool
{
    global $raylib;
    return $raylib->IsMouseButtonUp($button);
}

/**
 * Get mouse position X
 */
function GetMouseX(): int
{
    global $raylib;
    return $raylib->GetMouseX();
}

/**
 * Get mouse position Y
 */
function GetMouseY(): int
{
    global $raylib;
    return $raylib->GetMouseY();
}

/**
 * Get mouse position XY
 */
function GetMousePosition(): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetMousePosition());
}

/**
 * Set mouse position XY
 */
function SetMousePosition(int $x, int $y): void
{
    global $raylib;
    $raylib->SetMousePosition($x, $y);
}

/**
 * Set mouse offset
 */
function SetMouseOffset(int $offsetX, int $offsetY): void
{
    global $raylib;
    $raylib->SetMouseOffset($offsetX, $offsetY);
}

/**
 * Set mouse scaling
 */
function SetMouseScale(float $scaleX, float $scaleY): void
{
    global $raylib;
    $raylib->SetMouseScale($scaleX, $scaleY);
}

/**
 * Get mouse wheel movement Y
 */
function GetMouseWheelMove(): float
{
    global $raylib;
    return $raylib->GetMouseWheelMove();
}

/**
 * Set mouse cursor
 */
function SetMouseCursor(int $cursor): void
{
    global $raylib;
    $raylib->SetMouseCursor($cursor);
}

/**
 * Get touch position X for touch point 0 (relative to screen size)
 */
function GetTouchX(): int
{
    global $raylib;
    return $raylib->GetTouchX();
}

/**
 * Get touch position Y for touch point 0 (relative to screen size)
 */
function GetTouchY(): int
{
    global $raylib;
    return $raylib->GetTouchY();
}

/**
 * Get touch position XY for a touch point index (relative to screen size)
 */
function GetTouchPosition(int $index): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetTouchPosition($index));
}

/**
 * Enable a set of gestures using flags
 */
function SetGesturesEnabled(int $flags): void
{
    global $raylib;
    $raylib->SetGesturesEnabled($flags);
}

/**
 * Check if a gesture have been detected
 */
function IsGestureDetected(int $gesture): bool
{
    global $raylib;
    return $raylib->IsGestureDetected($gesture);
}

/**
 * Get latest detected gesture
 */
function GetGestureDetected(): int
{
    global $raylib;
    return $raylib->GetGestureDetected();
}

/**
 * Get touch points count
 */
function GetTouchPointsCount(): int
{
    global $raylib;
    return $raylib->GetTouchPointsCount();
}

/**
 * Get gesture hold time in milliseconds
 */
function GetGestureHoldDuration(): float
{
    global $raylib;
    return $raylib->GetGestureHoldDuration();
}

/**
 * Get gesture drag vector
 */
function GetGestureDragVector(): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetGestureDragVector());
}

/**
 * Get gesture drag angle
 */
function GetGestureDragAngle(): float
{
    global $raylib;
    return $raylib->GetGestureDragAngle();
}

/**
 * Get gesture pinch delta
 */
function GetGesturePinchVector(): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetGesturePinchVector());
}

/**
 * Get gesture pinch angle
 */
function GetGesturePinchAngle(): float
{
    global $raylib;
    return $raylib->GetGesturePinchAngle();
}

/**
 * Set camera mode (multiple camera modes available)
 */
function SetCameraMode(\Nawarian\Raylib\Generated\Camera3D $camera, int $mode): void
{
    global $raylib;
    $raylib->SetCameraMode($camera->toCData(), $mode);
}

/**
 * Update camera position for selected mode
 */
function UpdateCamera(\Nawarian\Raylib\Generated\Camera3D $camera): void
{
    global $raylib;
    $raylib->UpdateCamera($camera->toCData());
}

/**
 * Set camera pan key to combine with mouse movement (free camera)
 */
function SetCameraPanControl(int $keyPan): void
{
    global $raylib;
    $raylib->SetCameraPanControl($keyPan);
}

/**
 * Set camera alt key to combine with mouse movement (free camera)
 */
function SetCameraAltControl(int $keyAlt): void
{
    global $raylib;
    $raylib->SetCameraAltControl($keyAlt);
}

/**
 * Set camera smooth zoom key to combine with mouse (free camera)
 */
function SetCameraSmoothZoomControl(int $keySmoothZoom): void
{
    global $raylib;
    $raylib->SetCameraSmoothZoomControl($keySmoothZoom);
}

/**
 * Set camera move controls (1st person and 3rd person cameras)
 */
function SetCameraMoveControls(int $keyFront, int $keyBack, int $keyRight, int $keyLeft, int $keyUp, int $keyDown): void
{
    global $raylib;
    $raylib->SetCameraMoveControls($keyFront, $keyBack, $keyRight, $keyLeft, $keyUp, $keyDown);
}

/**
 * Set texture and rectangle to be used on shapes drawing
 */
function SetShapesTexture(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Rectangle $source): void
{
    global $raylib;
    $raylib->SetShapesTexture($texture->toCData(), $source->toCData());
}

/**
 * Draw a pixel
 */
function DrawPixel(int $posX, int $posY, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawPixel($posX, $posY, $color->toCData());
}

/**
 * Draw a pixel (Vector version)
 */
function DrawPixelV(\Nawarian\Raylib\Generated\Vector2 $position, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawPixelV($position->toCData(), $color->toCData());
}

/**
 * Draw a line
 */
function DrawLine(int $startPosX, int $startPosY, int $endPosX, int $endPosY, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawLine($startPosX, $startPosY, $endPosX, $endPosY, $color->toCData());
}

/**
 * Draw a line (Vector version)
 */
function DrawLineV(\Nawarian\Raylib\Generated\Vector2 $startPos, \Nawarian\Raylib\Generated\Vector2 $endPos, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawLineV($startPos->toCData(), $endPos->toCData(), $color->toCData());
}

/**
 * Draw a line defining thickness
 */
function DrawLineEx(\Nawarian\Raylib\Generated\Vector2 $startPos, \Nawarian\Raylib\Generated\Vector2 $endPos, float $thick, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawLineEx($startPos->toCData(), $endPos->toCData(), $thick, $color->toCData());
}

/**
 * Draw a line using cubic-bezier curves in-out
 */
function DrawLineBezier(\Nawarian\Raylib\Generated\Vector2 $startPos, \Nawarian\Raylib\Generated\Vector2 $endPos, float $thick, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawLineBezier($startPos->toCData(), $endPos->toCData(), $thick, $color->toCData());
}

/**
 * raw line using quadratic bezier curves with a control point
 */
function DrawLineBezierQuad(\Nawarian\Raylib\Generated\Vector2 $startPos, \Nawarian\Raylib\Generated\Vector2 $endPos, \Nawarian\Raylib\Generated\Vector2 $controlPos, float $thick, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawLineBezierQuad($startPos->toCData(), $endPos->toCData(), $controlPos->toCData(), $thick, $color->toCData());
}

/**
 * Draw lines sequence
 */
function DrawLineStrip(\Nawarian\Raylib\Generated\Vector2 $points, int $pointsCount, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawLineStrip($points->toCData(), $pointsCount, $color->toCData());
}

/**
 * Draw a color-filled circle
 */
function DrawCircle(int $centerX, int $centerY, float $radius, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCircle($centerX, $centerY, $radius, $color->toCData());
}

/**
 * Draw a piece of a circle
 */
function DrawCircleSector(\Nawarian\Raylib\Generated\Vector2 $center, float $radius, float $startAngle, float $endAngle, int $segments, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCircleSector($center->toCData(), $radius, $startAngle, $endAngle, $segments, $color->toCData());
}

/**
 * Draw circle sector outline
 */
function DrawCircleSectorLines(\Nawarian\Raylib\Generated\Vector2 $center, float $radius, float $startAngle, float $endAngle, int $segments, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCircleSectorLines($center->toCData(), $radius, $startAngle, $endAngle, $segments, $color->toCData());
}

/**
 * Draw a gradient-filled circle
 */
function DrawCircleGradient(int $centerX, int $centerY, float $radius, \Nawarian\Raylib\Generated\Color $color1, \Nawarian\Raylib\Generated\Color $color2): void
{
    global $raylib;
    $raylib->DrawCircleGradient($centerX, $centerY, $radius, $color1->toCData(), $color2->toCData());
}

/**
 * Draw a color-filled circle (Vector version)
 */
function DrawCircleV(\Nawarian\Raylib\Generated\Vector2 $center, float $radius, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCircleV($center->toCData(), $radius, $color->toCData());
}

/**
 * Draw circle outline
 */
function DrawCircleLines(int $centerX, int $centerY, float $radius, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCircleLines($centerX, $centerY, $radius, $color->toCData());
}

/**
 * Draw ellipse
 */
function DrawEllipse(int $centerX, int $centerY, float $radiusH, float $radiusV, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawEllipse($centerX, $centerY, $radiusH, $radiusV, $color->toCData());
}

/**
 * Draw ellipse outline
 */
function DrawEllipseLines(int $centerX, int $centerY, float $radiusH, float $radiusV, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawEllipseLines($centerX, $centerY, $radiusH, $radiusV, $color->toCData());
}

/**
 * Draw ring
 */
function DrawRing(\Nawarian\Raylib\Generated\Vector2 $center, float $innerRadius, float $outerRadius, float $startAngle, float $endAngle, int $segments, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRing($center->toCData(), $innerRadius, $outerRadius, $startAngle, $endAngle, $segments, $color->toCData());
}

/**
 * Draw ring outline
 */
function DrawRingLines(\Nawarian\Raylib\Generated\Vector2 $center, float $innerRadius, float $outerRadius, float $startAngle, float $endAngle, int $segments, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRingLines($center->toCData(), $innerRadius, $outerRadius, $startAngle, $endAngle, $segments, $color->toCData());
}

/**
 * Draw a color-filled rectangle
 */
function DrawRectangle(int $posX, int $posY, int $width, int $height, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRectangle($posX, $posY, $width, $height, $color->toCData());
}

/**
 * Draw a color-filled rectangle (Vector version)
 */
function DrawRectangleV(\Nawarian\Raylib\Generated\Vector2 $position, \Nawarian\Raylib\Generated\Vector2 $size, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRectangleV($position->toCData(), $size->toCData(), $color->toCData());
}

/**
 * Draw a color-filled rectangle
 */
function DrawRectangleRec(\Nawarian\Raylib\Generated\Rectangle $rec, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRectangleRec($rec->toCData(), $color->toCData());
}

/**
 * Draw a color-filled rectangle with pro parameters
 */
function DrawRectanglePro(\Nawarian\Raylib\Generated\Rectangle $rec, \Nawarian\Raylib\Generated\Vector2 $origin, float $rotation, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRectanglePro($rec->toCData(), $origin->toCData(), $rotation, $color->toCData());
}

/**
 * Draw a vertical-gradient-filled rectangle
 */
function DrawRectangleGradientV(int $posX, int $posY, int $width, int $height, \Nawarian\Raylib\Generated\Color $color1, \Nawarian\Raylib\Generated\Color $color2): void
{
    global $raylib;
    $raylib->DrawRectangleGradientV($posX, $posY, $width, $height, $color1->toCData(), $color2->toCData());
}

/**
 * Draw a horizontal-gradient-filled rectangle
 */
function DrawRectangleGradientH(int $posX, int $posY, int $width, int $height, \Nawarian\Raylib\Generated\Color $color1, \Nawarian\Raylib\Generated\Color $color2): void
{
    global $raylib;
    $raylib->DrawRectangleGradientH($posX, $posY, $width, $height, $color1->toCData(), $color2->toCData());
}

/**
 * Draw a gradient-filled rectangle with custom vertex colors
 */
function DrawRectangleGradientEx(\Nawarian\Raylib\Generated\Rectangle $rec, \Nawarian\Raylib\Generated\Color $col1, \Nawarian\Raylib\Generated\Color $col2, \Nawarian\Raylib\Generated\Color $col3, \Nawarian\Raylib\Generated\Color $col4): void
{
    global $raylib;
    $raylib->DrawRectangleGradientEx($rec->toCData(), $col1->toCData(), $col2->toCData(), $col3->toCData(), $col4->toCData());
}

/**
 * Draw rectangle outline
 */
function DrawRectangleLines(int $posX, int $posY, int $width, int $height, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRectangleLines($posX, $posY, $width, $height, $color->toCData());
}

/**
 * Draw rectangle outline with extended parameters
 */
function DrawRectangleLinesEx(\Nawarian\Raylib\Generated\Rectangle $rec, float $lineThick, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRectangleLinesEx($rec->toCData(), $lineThick, $color->toCData());
}

/**
 * Draw rectangle with rounded edges
 */
function DrawRectangleRounded(\Nawarian\Raylib\Generated\Rectangle $rec, float $roundness, int $segments, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRectangleRounded($rec->toCData(), $roundness, $segments, $color->toCData());
}

/**
 * Draw rectangle with rounded edges outline
 */
function DrawRectangleRoundedLines(\Nawarian\Raylib\Generated\Rectangle $rec, float $roundness, int $segments, float $lineThick, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRectangleRoundedLines($rec->toCData(), $roundness, $segments, $lineThick, $color->toCData());
}

/**
 * Draw a color-filled triangle (vertex in counter-clockwise order!)
 */
function DrawTriangle(\Nawarian\Raylib\Generated\Vector2 $v1, \Nawarian\Raylib\Generated\Vector2 $v2, \Nawarian\Raylib\Generated\Vector2 $v3, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawTriangle($v1->toCData(), $v2->toCData(), $v3->toCData(), $color->toCData());
}

/**
 * Draw triangle outline (vertex in counter-clockwise order!)
 */
function DrawTriangleLines(\Nawarian\Raylib\Generated\Vector2 $v1, \Nawarian\Raylib\Generated\Vector2 $v2, \Nawarian\Raylib\Generated\Vector2 $v3, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawTriangleLines($v1->toCData(), $v2->toCData(), $v3->toCData(), $color->toCData());
}

/**
 * Draw a triangle fan defined by points (first vertex is the center)
 */
function DrawTriangleFan(\Nawarian\Raylib\Generated\Vector2 $points, int $pointsCount, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawTriangleFan($points->toCData(), $pointsCount, $color->toCData());
}

/**
 * Draw a triangle strip defined by points
 */
function DrawTriangleStrip(\Nawarian\Raylib\Generated\Vector2 $points, int $pointsCount, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawTriangleStrip($points->toCData(), $pointsCount, $color->toCData());
}

/**
 * Draw a regular polygon (Vector version)
 */
function DrawPoly(\Nawarian\Raylib\Generated\Vector2 $center, int $sides, float $radius, float $rotation, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawPoly($center->toCData(), $sides, $radius, $rotation, $color->toCData());
}

/**
 * Draw a polygon outline of n sides
 */
function DrawPolyLines(\Nawarian\Raylib\Generated\Vector2 $center, int $sides, float $radius, float $rotation, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawPolyLines($center->toCData(), $sides, $radius, $rotation, $color->toCData());
}

/**
 * Draw a polygon outline of n sides with extended parameters
 */
function DrawPolyLinesEx(\Nawarian\Raylib\Generated\Vector2 $center, int $sides, float $radius, float $rotation, float $lineThick, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawPolyLinesEx($center->toCData(), $sides, $radius, $rotation, $lineThick, $color->toCData());
}

/**
 * Check collision between two rectangles
 */
function CheckCollisionRecs(\Nawarian\Raylib\Generated\Rectangle $rec1, \Nawarian\Raylib\Generated\Rectangle $rec2): bool
{
    global $raylib;
    return $raylib->CheckCollisionRecs($rec1->toCData(), $rec2->toCData());
}

/**
 * Check collision between two circles
 */
function CheckCollisionCircles(\Nawarian\Raylib\Generated\Vector2 $center1, float $radius1, \Nawarian\Raylib\Generated\Vector2 $center2, float $radius2): bool
{
    global $raylib;
    return $raylib->CheckCollisionCircles($center1->toCData(), $radius1, $center2->toCData(), $radius2);
}

/**
 * Check collision between circle and rectangle
 */
function CheckCollisionCircleRec(\Nawarian\Raylib\Generated\Vector2 $center, float $radius, \Nawarian\Raylib\Generated\Rectangle $rec): bool
{
    global $raylib;
    return $raylib->CheckCollisionCircleRec($center->toCData(), $radius, $rec->toCData());
}

/**
 * Check if point is inside rectangle
 */
function CheckCollisionPointRec(\Nawarian\Raylib\Generated\Vector2 $point, \Nawarian\Raylib\Generated\Rectangle $rec): bool
{
    global $raylib;
    return $raylib->CheckCollisionPointRec($point->toCData(), $rec->toCData());
}

/**
 * Check if point is inside circle
 */
function CheckCollisionPointCircle(\Nawarian\Raylib\Generated\Vector2 $point, \Nawarian\Raylib\Generated\Vector2 $center, float $radius): bool
{
    global $raylib;
    return $raylib->CheckCollisionPointCircle($point->toCData(), $center->toCData(), $radius);
}

/**
 * Check if point is inside a triangle
 */
function CheckCollisionPointTriangle(\Nawarian\Raylib\Generated\Vector2 $point, \Nawarian\Raylib\Generated\Vector2 $p1, \Nawarian\Raylib\Generated\Vector2 $p2, \Nawarian\Raylib\Generated\Vector2 $p3): bool
{
    global $raylib;
    return $raylib->CheckCollisionPointTriangle($point->toCData(), $p1->toCData(), $p2->toCData(), $p3->toCData());
}

/**
 * Check the collision between two lines defined by two points each, returns
 * collision point by reference
 */
function CheckCollisionLines(\Nawarian\Raylib\Generated\Vector2 $startPos1, \Nawarian\Raylib\Generated\Vector2 $endPos1, \Nawarian\Raylib\Generated\Vector2 $startPos2, \Nawarian\Raylib\Generated\Vector2 $endPos2, \Nawarian\Raylib\Generated\Vector2 $collisionPoint): bool
{
    global $raylib;
    return $raylib->CheckCollisionLines($startPos1->toCData(), $endPos1->toCData(), $startPos2->toCData(), $endPos2->toCData(), $collisionPoint->toCData());
}

/**
 * Get collision rectangle for two rectangles collision
 */
function GetCollisionRec(\Nawarian\Raylib\Generated\Rectangle $rec1, \Nawarian\Raylib\Generated\Rectangle $rec2): \Nawarian\Raylib\Generated\Rectangle
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Rectangle::fromCData($raylib->GetCollisionRec($rec1->toCData(), $rec2->toCData()));
}

/**
 * Load image from file into CPU memory (RAM)
 */
function LoadImage(string $fileName): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->LoadImage($fileName));
}

/**
 * Load image from RAW file data
 */
function LoadImageRaw(string $fileName, int $width, int $height, int $format, int $headerSize): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->LoadImageRaw($fileName, $width, $height, $format, $headerSize));
}

/**
 * Load image sequence from file (frames appended to image.data)
 */
function LoadImageAnim(string $fileName, array $frames): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->LoadImageAnim($fileName, $frames));
}

/**
 * Load image from memory buffer, fileType refers to extension: i.e. '.png'
 */
function LoadImageFromMemory(string $fileType, array $fileData, int $dataSize): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->LoadImageFromMemory($fileType, $fileData, $dataSize));
}

/**
 * Unload image from CPU memory (RAM)
 */
function UnloadImage(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->UnloadImage($image->toCData());
}

/**
 * Export image data to file, returns true on success
 */
function ExportImage(\Nawarian\Raylib\Generated\Image $image, string $fileName): bool
{
    global $raylib;
    return $raylib->ExportImage($image->toCData(), $fileName);
}

/**
 * Export image as code file defining an array of bytes, returns true on success
 */
function ExportImageAsCode(\Nawarian\Raylib\Generated\Image $image, string $fileName): bool
{
    global $raylib;
    return $raylib->ExportImageAsCode($image->toCData(), $fileName);
}

/**
 * Generate image: plain color
 */
function GenImageColor(int $width, int $height, \Nawarian\Raylib\Generated\Color $color): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageColor($width, $height, $color->toCData()));
}

/**
 * Generate image: vertical gradient
 */
function GenImageGradientV(int $width, int $height, \Nawarian\Raylib\Generated\Color $top, \Nawarian\Raylib\Generated\Color $bottom): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageGradientV($width, $height, $top->toCData(), $bottom->toCData()));
}

/**
 * Generate image: horizontal gradient
 */
function GenImageGradientH(int $width, int $height, \Nawarian\Raylib\Generated\Color $left, \Nawarian\Raylib\Generated\Color $right): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageGradientH($width, $height, $left->toCData(), $right->toCData()));
}

/**
 * Generate image: radial gradient
 */
function GenImageGradientRadial(int $width, int $height, float $density, \Nawarian\Raylib\Generated\Color $inner, \Nawarian\Raylib\Generated\Color $outer): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageGradientRadial($width, $height, $density, $inner->toCData(), $outer->toCData()));
}

/**
 * Generate image: checked
 */
function GenImageChecked(int $width, int $height, int $checksX, int $checksY, \Nawarian\Raylib\Generated\Color $col1, \Nawarian\Raylib\Generated\Color $col2): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageChecked($width, $height, $checksX, $checksY, $col1->toCData(), $col2->toCData()));
}

/**
 * Generate image: white noise
 */
function GenImageWhiteNoise(int $width, int $height, float $factor): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageWhiteNoise($width, $height, $factor));
}

/**
 * Generate image: perlin noise
 */
function GenImagePerlinNoise(int $width, int $height, int $offsetX, int $offsetY, float $scale): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImagePerlinNoise($width, $height, $offsetX, $offsetY, $scale));
}

/**
 * Generate image: cellular algorithm. Bigger tileSize means bigger cells
 */
function GenImageCellular(int $width, int $height, int $tileSize): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageCellular($width, $height, $tileSize));
}

/**
 * Create an image duplicate (useful for transformations)
 */
function ImageCopy(\Nawarian\Raylib\Generated\Image $image): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->ImageCopy($image->toCData()));
}

/**
 * Create an image from another image piece
 */
function ImageFromImage(\Nawarian\Raylib\Generated\Image $image, \Nawarian\Raylib\Generated\Rectangle $rec): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->ImageFromImage($image->toCData(), $rec->toCData()));
}

/**
 * Create an image from text (default font)
 */
function ImageText(string $text, int $fontSize, \Nawarian\Raylib\Generated\Color $color): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->ImageText($text, $fontSize, $color->toCData()));
}

/**
 * Create an image from text (custom sprite font)
 */
function ImageTextEx(\Nawarian\Raylib\Generated\Font $font, string $text, float $fontSize, float $spacing, \Nawarian\Raylib\Generated\Color $tint): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->ImageTextEx($font->toCData(), $text, $fontSize, $spacing, $tint->toCData()));
}

/**
 * Convert image data to desired format
 */
function ImageFormat(\Nawarian\Raylib\Generated\Image $image, int $newFormat): void
{
    global $raylib;
    $raylib->ImageFormat($image->toCData(), $newFormat);
}

/**
 * Convert image to POT (power-of-two)
 */
function ImageToPOT(\Nawarian\Raylib\Generated\Image $image, \Nawarian\Raylib\Generated\Color $fill): void
{
    global $raylib;
    $raylib->ImageToPOT($image->toCData(), $fill->toCData());
}

/**
 * Crop an image to a defined rectangle
 */
function ImageCrop(\Nawarian\Raylib\Generated\Image $image, \Nawarian\Raylib\Generated\Rectangle $crop): void
{
    global $raylib;
    $raylib->ImageCrop($image->toCData(), $crop->toCData());
}

/**
 * Crop image depending on alpha value
 */
function ImageAlphaCrop(\Nawarian\Raylib\Generated\Image $image, float $threshold): void
{
    global $raylib;
    $raylib->ImageAlphaCrop($image->toCData(), $threshold);
}

/**
 * Clear alpha channel to desired color
 */
function ImageAlphaClear(\Nawarian\Raylib\Generated\Image $image, \Nawarian\Raylib\Generated\Color $color, float $threshold): void
{
    global $raylib;
    $raylib->ImageAlphaClear($image->toCData(), $color->toCData(), $threshold);
}

/**
 * Apply alpha mask to image
 */
function ImageAlphaMask(\Nawarian\Raylib\Generated\Image $image, \Nawarian\Raylib\Generated\Image $alphaMask): void
{
    global $raylib;
    $raylib->ImageAlphaMask($image->toCData(), $alphaMask->toCData());
}

/**
 * Premultiply alpha channel
 */
function ImageAlphaPremultiply(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->ImageAlphaPremultiply($image->toCData());
}

/**
 * Resize image (Bicubic scaling algorithm)
 */
function ImageResize(\Nawarian\Raylib\Generated\Image $image, int $newWidth, int $newHeight): void
{
    global $raylib;
    $raylib->ImageResize($image->toCData(), $newWidth, $newHeight);
}

/**
 * Resize image (Nearest-Neighbor scaling algorithm)
 */
function ImageResizeNN(\Nawarian\Raylib\Generated\Image $image, int $newWidth, int $newHeight): void
{
    global $raylib;
    $raylib->ImageResizeNN($image->toCData(), $newWidth, $newHeight);
}

/**
 * Resize canvas and fill with color
 */
function ImageResizeCanvas(\Nawarian\Raylib\Generated\Image $image, int $newWidth, int $newHeight, int $offsetX, int $offsetY, \Nawarian\Raylib\Generated\Color $fill): void
{
    global $raylib;
    $raylib->ImageResizeCanvas($image->toCData(), $newWidth, $newHeight, $offsetX, $offsetY, $fill->toCData());
}

/**
 * Compute all mipmap levels for a provided image
 */
function ImageMipmaps(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->ImageMipmaps($image->toCData());
}

/**
 * Dither image data to 16bpp or lower (Floyd-Steinberg dithering)
 */
function ImageDither(\Nawarian\Raylib\Generated\Image $image, int $rBpp, int $gBpp, int $bBpp, int $aBpp): void
{
    global $raylib;
    $raylib->ImageDither($image->toCData(), $rBpp, $gBpp, $bBpp, $aBpp);
}

/**
 * Flip image vertically
 */
function ImageFlipVertical(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->ImageFlipVertical($image->toCData());
}

/**
 * Flip image horizontally
 */
function ImageFlipHorizontal(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->ImageFlipHorizontal($image->toCData());
}

/**
 * Rotate image clockwise 90deg
 */
function ImageRotateCW(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->ImageRotateCW($image->toCData());
}

/**
 * Rotate image counter-clockwise 90deg
 */
function ImageRotateCCW(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->ImageRotateCCW($image->toCData());
}

/**
 * Modify image color: tint
 */
function ImageColorTint(\Nawarian\Raylib\Generated\Image $image, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageColorTint($image->toCData(), $color->toCData());
}

/**
 * Modify image color: invert
 */
function ImageColorInvert(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->ImageColorInvert($image->toCData());
}

/**
 * Modify image color: grayscale
 */
function ImageColorGrayscale(\Nawarian\Raylib\Generated\Image $image): void
{
    global $raylib;
    $raylib->ImageColorGrayscale($image->toCData());
}

/**
 * Modify image color: contrast (-100 to 100)
 */
function ImageColorContrast(\Nawarian\Raylib\Generated\Image $image, float $contrast): void
{
    global $raylib;
    $raylib->ImageColorContrast($image->toCData(), $contrast);
}

/**
 * Modify image color: brightness (-255 to 255)
 */
function ImageColorBrightness(\Nawarian\Raylib\Generated\Image $image, int $brightness): void
{
    global $raylib;
    $raylib->ImageColorBrightness($image->toCData(), $brightness);
}

/**
 * Modify image color: replace color
 */
function ImageColorReplace(\Nawarian\Raylib\Generated\Image $image, \Nawarian\Raylib\Generated\Color $color, \Nawarian\Raylib\Generated\Color $replace): void
{
    global $raylib;
    $raylib->ImageColorReplace($image->toCData(), $color->toCData(), $replace->toCData());
}

/**
 * Load color data from image as a Color array (RGBA - 32bit)
 */
function LoadImageColors(\Nawarian\Raylib\Generated\Image $image): \Nawarian\Raylib\Generated\Color
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Color::fromCData($raylib->LoadImageColors($image->toCData()));
}

/**
 * Load colors palette from image as a Color array (RGBA - 32bit)
 */
function LoadImagePalette(\Nawarian\Raylib\Generated\Image $image, int $maxPaletteSize, array $colorsCount): \Nawarian\Raylib\Generated\Color
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Color::fromCData($raylib->LoadImagePalette($image->toCData(), $maxPaletteSize, $colorsCount));
}

/**
 * Unload color data loaded with LoadImageColors()
 */
function UnloadImageColors(\Nawarian\Raylib\Generated\Color $colors): void
{
    global $raylib;
    $raylib->UnloadImageColors($colors->toCData());
}

/**
 * Unload colors palette loaded with LoadImagePalette()
 */
function UnloadImagePalette(\Nawarian\Raylib\Generated\Color $colors): void
{
    global $raylib;
    $raylib->UnloadImagePalette($colors->toCData());
}

/**
 * Get image alpha border rectangle
 */
function GetImageAlphaBorder(\Nawarian\Raylib\Generated\Image $image, float $threshold): \Nawarian\Raylib\Generated\Rectangle
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Rectangle::fromCData($raylib->GetImageAlphaBorder($image->toCData(), $threshold));
}

/**
 * Clear image background with given color
 */
function ImageClearBackground(\Nawarian\Raylib\Generated\Image $dst, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageClearBackground($dst->toCData(), $color->toCData());
}

/**
 * Draw pixel within an image
 */
function ImageDrawPixel(\Nawarian\Raylib\Generated\Image $dst, int $posX, int $posY, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawPixel($dst->toCData(), $posX, $posY, $color->toCData());
}

/**
 * Draw pixel within an image (Vector version)
 */
function ImageDrawPixelV(\Nawarian\Raylib\Generated\Image $dst, \Nawarian\Raylib\Generated\Vector2 $position, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawPixelV($dst->toCData(), $position->toCData(), $color->toCData());
}

/**
 * Draw line within an image
 */
function ImageDrawLine(\Nawarian\Raylib\Generated\Image $dst, int $startPosX, int $startPosY, int $endPosX, int $endPosY, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawLine($dst->toCData(), $startPosX, $startPosY, $endPosX, $endPosY, $color->toCData());
}

/**
 * Draw line within an image (Vector version)
 */
function ImageDrawLineV(\Nawarian\Raylib\Generated\Image $dst, \Nawarian\Raylib\Generated\Vector2 $start, \Nawarian\Raylib\Generated\Vector2 $end, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawLineV($dst->toCData(), $start->toCData(), $end->toCData(), $color->toCData());
}

/**
 * Draw circle within an image
 */
function ImageDrawCircle(\Nawarian\Raylib\Generated\Image $dst, int $centerX, int $centerY, int $radius, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawCircle($dst->toCData(), $centerX, $centerY, $radius, $color->toCData());
}

/**
 * Draw circle within an image (Vector version)
 */
function ImageDrawCircleV(\Nawarian\Raylib\Generated\Image $dst, \Nawarian\Raylib\Generated\Vector2 $center, int $radius, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawCircleV($dst->toCData(), $center->toCData(), $radius, $color->toCData());
}

/**
 * Draw rectangle within an image
 */
function ImageDrawRectangle(\Nawarian\Raylib\Generated\Image $dst, int $posX, int $posY, int $width, int $height, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawRectangle($dst->toCData(), $posX, $posY, $width, $height, $color->toCData());
}

/**
 * Draw rectangle within an image (Vector version)
 */
function ImageDrawRectangleV(\Nawarian\Raylib\Generated\Image $dst, \Nawarian\Raylib\Generated\Vector2 $position, \Nawarian\Raylib\Generated\Vector2 $size, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawRectangleV($dst->toCData(), $position->toCData(), $size->toCData(), $color->toCData());
}

/**
 * Draw rectangle within an image
 */
function ImageDrawRectangleRec(\Nawarian\Raylib\Generated\Image $dst, \Nawarian\Raylib\Generated\Rectangle $rec, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawRectangleRec($dst->toCData(), $rec->toCData(), $color->toCData());
}

/**
 * Draw rectangle lines within an image
 */
function ImageDrawRectangleLines(\Nawarian\Raylib\Generated\Image $dst, \Nawarian\Raylib\Generated\Rectangle $rec, int $thick, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawRectangleLines($dst->toCData(), $rec->toCData(), $thick, $color->toCData());
}

/**
 * Draw a source image within a destination image (tint applied to source)
 */
function ImageDraw(\Nawarian\Raylib\Generated\Image $dst, \Nawarian\Raylib\Generated\Image $src, \Nawarian\Raylib\Generated\Rectangle $srcRec, \Nawarian\Raylib\Generated\Rectangle $dstRec, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->ImageDraw($dst->toCData(), $src->toCData(), $srcRec->toCData(), $dstRec->toCData(), $tint->toCData());
}

/**
 * Draw text (using default font) within an image (destination)
 */
function ImageDrawText(\Nawarian\Raylib\Generated\Image $dst, string $text, int $posX, int $posY, int $fontSize, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->ImageDrawText($dst->toCData(), $text, $posX, $posY, $fontSize, $color->toCData());
}

/**
 * Draw text (custom sprite font) within an image (destination)
 */
function ImageDrawTextEx(\Nawarian\Raylib\Generated\Image $dst, \Nawarian\Raylib\Generated\Font $font, string $text, \Nawarian\Raylib\Generated\Vector2 $position, float $fontSize, float $spacing, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->ImageDrawTextEx($dst->toCData(), $font->toCData(), $text, $position->toCData(), $fontSize, $spacing, $tint->toCData());
}

/**
 * Load texture from file into GPU memory (VRAM)
 */
function LoadTexture(string $fileName): \Nawarian\Raylib\Generated\Texture
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Texture::fromCData($raylib->LoadTexture($fileName));
}

/**
 * Load texture from image data
 */
function LoadTextureFromImage(\Nawarian\Raylib\Generated\Image $image): \Nawarian\Raylib\Generated\Texture
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Texture::fromCData($raylib->LoadTextureFromImage($image->toCData()));
}

/**
 * Load cubemap from image, multiple image cubemap layouts supported
 */
function LoadTextureCubemap(\Nawarian\Raylib\Generated\Image $image, int $layout): \Nawarian\Raylib\Generated\Texture
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Texture::fromCData($raylib->LoadTextureCubemap($image->toCData(), $layout));
}

/**
 * Load texture for rendering (framebuffer)
 */
function LoadRenderTexture(int $width, int $height): \Nawarian\Raylib\Generated\RenderTexture
{
    global $raylib;
    return \Nawarian\Raylib\Generated\RenderTexture::fromCData($raylib->LoadRenderTexture($width, $height));
}

/**
 * Unload texture from GPU memory (VRAM)
 */
function UnloadTexture(\Nawarian\Raylib\Generated\Texture $texture): void
{
    global $raylib;
    $raylib->UnloadTexture($texture->toCData());
}

/**
 * Unload render texture from GPU memory (VRAM)
 */
function UnloadRenderTexture(\Nawarian\Raylib\Generated\RenderTexture $target): void
{
    global $raylib;
    $raylib->UnloadRenderTexture($target->toCData());
}

/**
 * Update GPU texture with new data
 */
function UpdateTexture(\Nawarian\Raylib\Generated\Texture $texture, \FFI\CData $pixels): void
{
    global $raylib;
    $raylib->UpdateTexture($texture->toCData(), $pixels);
}

/**
 * Update GPU texture rectangle with new data
 */
function UpdateTextureRec(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Rectangle $rec, \FFI\CData $pixels): void
{
    global $raylib;
    $raylib->UpdateTextureRec($texture->toCData(), $rec->toCData(), $pixels);
}

/**
 * Get pixel data from GPU texture and return an Image
 */
function GetTextureData(\Nawarian\Raylib\Generated\Texture $texture): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GetTextureData($texture->toCData()));
}

/**
 * Get pixel data from screen buffer and return an Image (screenshot)
 */
function GetScreenData(): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GetScreenData());
}

/**
 * Generate GPU mipmaps for a texture
 */
function GenTextureMipmaps(\Nawarian\Raylib\Generated\Texture $texture): void
{
    global $raylib;
    $raylib->GenTextureMipmaps($texture->toCData());
}

/**
 * Set texture scaling filter mode
 */
function SetTextureFilter(\Nawarian\Raylib\Generated\Texture $texture, int $filter): void
{
    global $raylib;
    $raylib->SetTextureFilter($texture->toCData(), $filter);
}

/**
 * Set texture wrapping mode
 */
function SetTextureWrap(\Nawarian\Raylib\Generated\Texture $texture, int $wrap): void
{
    global $raylib;
    $raylib->SetTextureWrap($texture->toCData(), $wrap);
}

/**
 * Draw a Texture2D
 */
function DrawTexture(\Nawarian\Raylib\Generated\Texture $texture, int $posX, int $posY, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTexture($texture->toCData(), $posX, $posY, $tint->toCData());
}

/**
 * Draw a Texture2D with position defined as Vector2
 */
function DrawTextureV(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Vector2 $position, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTextureV($texture->toCData(), $position->toCData(), $tint->toCData());
}

/**
 * Draw a Texture2D with extended parameters
 */
function DrawTextureEx(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Vector2 $position, float $rotation, float $scale, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTextureEx($texture->toCData(), $position->toCData(), $rotation, $scale, $tint->toCData());
}

/**
 * Draw a part of a texture defined by a rectangle
 */
function DrawTextureRec(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Rectangle $source, \Nawarian\Raylib\Generated\Vector2 $position, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTextureRec($texture->toCData(), $source->toCData(), $position->toCData(), $tint->toCData());
}

/**
 * Draw texture quad with tiling and offset parameters
 */
function DrawTextureQuad(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Vector2 $tiling, \Nawarian\Raylib\Generated\Vector2 $offset, \Nawarian\Raylib\Generated\Rectangle $quad, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTextureQuad($texture->toCData(), $tiling->toCData(), $offset->toCData(), $quad->toCData(), $tint->toCData());
}

/**
 * Draw part of a texture (defined by a rectangle) with rotation and scale tiled
 * into dest.
 */
function DrawTextureTiled(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Rectangle $source, \Nawarian\Raylib\Generated\Rectangle $dest, \Nawarian\Raylib\Generated\Vector2 $origin, float $rotation, float $scale, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTextureTiled($texture->toCData(), $source->toCData(), $dest->toCData(), $origin->toCData(), $rotation, $scale, $tint->toCData());
}

/**
 * Draw a part of a texture defined by a rectangle with 'pro' parameters
 */
function DrawTexturePro(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Rectangle $source, \Nawarian\Raylib\Generated\Rectangle $dest, \Nawarian\Raylib\Generated\Vector2 $origin, float $rotation, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTexturePro($texture->toCData(), $source->toCData(), $dest->toCData(), $origin->toCData(), $rotation, $tint->toCData());
}

/**
 * Draws a texture (or part of it) that stretches or shrinks nicely
 */
function DrawTextureNPatch(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\NPatchInfo $nPatchInfo, \Nawarian\Raylib\Generated\Rectangle $dest, \Nawarian\Raylib\Generated\Vector2 $origin, float $rotation, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTextureNPatch($texture->toCData(), $nPatchInfo->toCData(), $dest->toCData(), $origin->toCData(), $rotation, $tint->toCData());
}

/**
 * Draw a textured polygon
 */
function DrawTexturePoly(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Vector2 $center, \Nawarian\Raylib\Generated\Vector2 $points, \Nawarian\Raylib\Generated\Vector2 $texcoords, int $pointsCount, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTexturePoly($texture->toCData(), $center->toCData(), $points->toCData(), $texcoords->toCData(), $pointsCount, $tint->toCData());
}

/**
 * Get color with alpha applied, alpha goes from 0.0f to 1.0f
 */
function Fade(\Nawarian\Raylib\Generated\Color $color, float $alpha): \Nawarian\Raylib\Generated\Color
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Color::fromCData($raylib->Fade($color->toCData(), $alpha));
}

/**
 * Get hexadecimal value for a Color
 */
function ColorToInt(\Nawarian\Raylib\Generated\Color $color): int
{
    global $raylib;
    return $raylib->ColorToInt($color->toCData());
}

/**
 * Get Color normalized as float [0..1]
 */
function ColorNormalize(\Nawarian\Raylib\Generated\Color $color): \Nawarian\Raylib\Generated\Vector4
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector4::fromCData($raylib->ColorNormalize($color->toCData()));
}

/**
 * Get Color from normalized values [0..1]
 */
function ColorFromNormalized(\Nawarian\Raylib\Generated\Vector4 $normalized): \Nawarian\Raylib\Generated\Color
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Color::fromCData($raylib->ColorFromNormalized($normalized->toCData()));
}

/**
 * Get HSV values for a Color, hue [0..360], saturation/value [0..1]
 */
function ColorToHSV(\Nawarian\Raylib\Generated\Color $color): \Nawarian\Raylib\Generated\Vector3
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector3::fromCData($raylib->ColorToHSV($color->toCData()));
}

/**
 * Get a Color from HSV values, hue [0..360], saturation/value [0..1]
 */
function ColorFromHSV(float $hue, float $saturation, float $value): \Nawarian\Raylib\Generated\Color
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Color::fromCData($raylib->ColorFromHSV($hue, $saturation, $value));
}

/**
 * Get color with alpha applied, alpha goes from 0.0f to 1.0f
 */
function ColorAlpha(\Nawarian\Raylib\Generated\Color $color, float $alpha): \Nawarian\Raylib\Generated\Color
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Color::fromCData($raylib->ColorAlpha($color->toCData(), $alpha));
}

/**
 * Get src alpha-blended into dst color with tint
 */
function ColorAlphaBlend(\Nawarian\Raylib\Generated\Color $dst, \Nawarian\Raylib\Generated\Color $src, \Nawarian\Raylib\Generated\Color $tint): \Nawarian\Raylib\Generated\Color
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Color::fromCData($raylib->ColorAlphaBlend($dst->toCData(), $src->toCData(), $tint->toCData()));
}

/**
 * Get Color structure from hexadecimal value
 */
function GetColor(int $hexValue): \Nawarian\Raylib\Generated\Color
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Color::fromCData($raylib->GetColor($hexValue));
}

/**
 * Get Color from a source pixel pointer of certain format
 */
function GetPixelColor(\FFI\CData $srcPtr, int $format): \Nawarian\Raylib\Generated\Color
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Color::fromCData($raylib->GetPixelColor($srcPtr, $format));
}

/**
 * Set color formatted into destination pixel pointer
 */
function SetPixelColor(\FFI\CData $dstPtr, \Nawarian\Raylib\Generated\Color $color, int $format): void
{
    global $raylib;
    $raylib->SetPixelColor($dstPtr, $color->toCData(), $format);
}

/**
 * Get pixel data size in bytes for certain format
 */
function GetPixelDataSize(int $width, int $height, int $format): int
{
    global $raylib;
    return $raylib->GetPixelDataSize($width, $height, $format);
}

/**
 * Get the default Font
 */
function GetFontDefault(): \Nawarian\Raylib\Generated\Font
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Font::fromCData($raylib->GetFontDefault());
}

/**
 * Load font from file into GPU memory (VRAM)
 */
function LoadFont(string $fileName): \Nawarian\Raylib\Generated\Font
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Font::fromCData($raylib->LoadFont($fileName));
}

/**
 * Load font from file with extended parameters
 */
function LoadFontEx(string $fileName, int $fontSize, array $fontChars, int $charsCount): \Nawarian\Raylib\Generated\Font
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Font::fromCData($raylib->LoadFontEx($fileName, $fontSize, $fontChars, $charsCount));
}

/**
 * Load font from Image (XNA style)
 */
function LoadFontFromImage(\Nawarian\Raylib\Generated\Image $image, \Nawarian\Raylib\Generated\Color $key, int $firstChar): \Nawarian\Raylib\Generated\Font
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Font::fromCData($raylib->LoadFontFromImage($image->toCData(), $key->toCData(), $firstChar));
}

/**
 * Load font from memory buffer, fileType refers to extension: i.e. '.ttf'
 */
function LoadFontFromMemory(string $fileType, array $fileData, int $dataSize, int $fontSize, array $fontChars, int $charsCount): \Nawarian\Raylib\Generated\Font
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Font::fromCData($raylib->LoadFontFromMemory($fileType, $fileData, $dataSize, $fontSize, $fontChars, $charsCount));
}

/**
 * Load font data for further use
 */
function LoadFontData(array $fileData, int $dataSize, int $fontSize, array $fontChars, int $charsCount, int $type): \Nawarian\Raylib\Generated\CharInfo
{
    global $raylib;
    return \Nawarian\Raylib\Generated\CharInfo::fromCData($raylib->LoadFontData($fileData, $dataSize, $fontSize, $fontChars, $charsCount, $type));
}

/**
 * Generate image font atlas using chars info
 */
function GenImageFontAtlas(\Nawarian\Raylib\Generated\CharInfo $chars, array $recs, int $charsCount, int $fontSize, int $padding, int $packMethod): \Nawarian\Raylib\Generated\Image
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageFontAtlas($chars->toCData(), $recs, $charsCount, $fontSize, $padding, $packMethod));
}

/**
 * Unload font chars info data (RAM)
 */
function UnloadFontData(\Nawarian\Raylib\Generated\CharInfo $chars, int $charsCount): void
{
    global $raylib;
    $raylib->UnloadFontData($chars->toCData(), $charsCount);
}

/**
 * Unload Font from GPU memory (VRAM)
 */
function UnloadFont(\Nawarian\Raylib\Generated\Font $font): void
{
    global $raylib;
    $raylib->UnloadFont($font->toCData());
}

/**
 * Draw current FPS
 */
function DrawFPS(int $posX, int $posY): void
{
    global $raylib;
    $raylib->DrawFPS($posX, $posY);
}

/**
 * Draw text (using default font)
 */
function DrawText(string $text, int $posX, int $posY, int $fontSize, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawText($text, $posX, $posY, $fontSize, $color->toCData());
}

/**
 * Draw text using font and additional parameters
 */
function DrawTextEx(\Nawarian\Raylib\Generated\Font $font, string $text, \Nawarian\Raylib\Generated\Vector2 $position, float $fontSize, float $spacing, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTextEx($font->toCData(), $text, $position->toCData(), $fontSize, $spacing, $tint->toCData());
}

/**
 * Draw text using font inside rectangle limits
 */
function DrawTextRec(\Nawarian\Raylib\Generated\Font $font, string $text, \Nawarian\Raylib\Generated\Rectangle $rec, float $fontSize, float $spacing, bool $wordWrap, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTextRec($font->toCData(), $text, $rec->toCData(), $fontSize, $spacing, $wordWrap->toCData(), $tint->toCData());
}

/**
 * Draw text using font inside rectangle limits with support for text selection
 */
function DrawTextRecEx(\Nawarian\Raylib\Generated\Font $font, string $text, \Nawarian\Raylib\Generated\Rectangle $rec, float $fontSize, float $spacing, bool $wordWrap, \Nawarian\Raylib\Generated\Color $tint, int $selectStart, int $selectLength, \Nawarian\Raylib\Generated\Color $selectTint, \Nawarian\Raylib\Generated\Color $selectBackTint): void
{
    global $raylib;
    $raylib->DrawTextRecEx($font->toCData(), $text, $rec->toCData(), $fontSize, $spacing, $wordWrap->toCData(), $tint->toCData(), $selectStart, $selectLength, $selectTint->toCData(), $selectBackTint->toCData());
}

/**
 * Draw one character (codepoint)
 */
function DrawTextCodepoint(\Nawarian\Raylib\Generated\Font $font, int $codepoint, \Nawarian\Raylib\Generated\Vector2 $position, float $fontSize, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawTextCodepoint($font->toCData(), $codepoint, $position->toCData(), $fontSize, $tint->toCData());
}

/**
 * Measure string width for default font
 */
function MeasureText(string $text, int $fontSize): int
{
    global $raylib;
    return $raylib->MeasureText($text, $fontSize);
}

/**
 * Measure string size for Font
 */
function MeasureTextEx(\Nawarian\Raylib\Generated\Font $font, string $text, float $fontSize, float $spacing): \Nawarian\Raylib\Generated\Vector2
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->MeasureTextEx($font->toCData(), $text, $fontSize, $spacing));
}

/**
 * Get index position for a unicode character on font
 */
function GetGlyphIndex(\Nawarian\Raylib\Generated\Font $font, int $codepoint): int
{
    global $raylib;
    return $raylib->GetGlyphIndex($font->toCData(), $codepoint);
}

/**
 * Copy one string to another, returns bytes copied
 */
function TextCopy(string $dst, string $src): int
{
    global $raylib;
    return $raylib->TextCopy($dst, $src);
}

/**
 * Check if two text string are equal
 */
function TextIsEqual(string $text1, string $text2): bool
{
    global $raylib;
    return $raylib->TextIsEqual($text1, $text2);
}

/**
 * Get text length, checks for ' 0' ending
 */
function TextLength(string $text): int
{
    global $raylib;
    return $raylib->TextLength($text);
}

/**
 * Get a piece of a text string
 */
function TextSubtext(string $text, int $position, int $length): string
{
    global $raylib;
    return $raylib->TextSubtext($text, $position, $length);
}

/**
 * Replace text string (memory must be freed!)
 */
function TextReplace(string $text, string $replace, string $by): string
{
    global $raylib;
    return $raylib->TextReplace($text, $replace, $by);
}

/**
 * Insert text in a position (memory must be freed!)
 */
function TextInsert(string $text, string $insert, int $position): string
{
    global $raylib;
    return $raylib->TextInsert($text, $insert, $position);
}

/**
 * Split text into multiple strings
 */
function TextSplit(string $text, string $delimiter, array $count): array
{
    global $raylib;
    return $raylib->TextSplit($text, $delimiter, $count);
}

/**
 * Append text at specific position and move cursor!
 */
function TextAppend(string $text, string $append, array $position): void
{
    global $raylib;
    $raylib->TextAppend($text, $append, $position);
}

/**
 * Find first text occurrence within a string
 */
function TextFindIndex(string $text, string $find): int
{
    global $raylib;
    return $raylib->TextFindIndex($text, $find);
}

/**
 * Get upper case version of provided string
 */
function TextToUpper(string $text): string
{
    global $raylib;
    return $raylib->TextToUpper($text);
}

/**
 * Get lower case version of provided string
 */
function TextToLower(string $text): string
{
    global $raylib;
    return $raylib->TextToLower($text);
}

/**
 * Get Pascal case notation version of provided string
 */
function TextToPascal(string $text): string
{
    global $raylib;
    return $raylib->TextToPascal($text);
}

/**
 * Get integer value from text (negative values not supported)
 */
function TextToInteger(string $text): int
{
    global $raylib;
    return $raylib->TextToInteger($text);
}

/**
 * Encode text codepoint into utf8 text (memory must be freed!)
 */
function TextToUtf8(array $codepoints, int $length): string
{
    global $raylib;
    return $raylib->TextToUtf8($codepoints, $length);
}

/**
 * Get all codepoints in a string, codepoints count returned by parameters
 */
function GetCodepoints(string $text, array $count): array
{
    global $raylib;
    return $raylib->GetCodepoints($text, $count);
}

/**
 * Get total number of characters (codepoints) in a UTF8 encoded string
 */
function GetCodepointsCount(string $text): int
{
    global $raylib;
    return $raylib->GetCodepointsCount($text);
}

/**
 * Get next codepoint in a UTF8 encoded string; 0x3f('?') is returned on failure
 */
function GetNextCodepoint(string $text, array $bytesProcessed): int
{
    global $raylib;
    return $raylib->GetNextCodepoint($text, $bytesProcessed);
}

/**
 * Encode codepoint into utf8 text (char array length returned as parameter)
 */
function CodepointToUtf8(int $codepoint, array $byteLength): string
{
    global $raylib;
    return $raylib->CodepointToUtf8($codepoint, $byteLength);
}

/**
 * Draw a line in 3D world space
 */
function DrawLine3D(\Nawarian\Raylib\Generated\Vector3 $startPos, \Nawarian\Raylib\Generated\Vector3 $endPos, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawLine3D($startPos->toCData(), $endPos->toCData(), $color->toCData());
}

/**
 * Draw a point in 3D space, actually a small line
 */
function DrawPoint3D(\Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawPoint3D($position->toCData(), $color->toCData());
}

/**
 * Draw a circle in 3D world space
 */
function DrawCircle3D(\Nawarian\Raylib\Generated\Vector3 $center, float $radius, \Nawarian\Raylib\Generated\Vector3 $rotationAxis, float $rotationAngle, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCircle3D($center->toCData(), $radius, $rotationAxis->toCData(), $rotationAngle, $color->toCData());
}

/**
 * Draw a color-filled triangle (vertex in counter-clockwise order!)
 */
function DrawTriangle3D(\Nawarian\Raylib\Generated\Vector3 $v1, \Nawarian\Raylib\Generated\Vector3 $v2, \Nawarian\Raylib\Generated\Vector3 $v3, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawTriangle3D($v1->toCData(), $v2->toCData(), $v3->toCData(), $color->toCData());
}

/**
 * Draw a triangle strip defined by points
 */
function DrawTriangleStrip3D(array $points, int $pointsCount, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawTriangleStrip3D($points, $pointsCount, $color->toCData());
}

/**
 * Draw cube
 */
function DrawCube(\Nawarian\Raylib\Generated\Vector3 $position, float $width, float $height, float $length, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCube($position->toCData(), $width, $height, $length, $color->toCData());
}

/**
 * Draw cube (Vector version)
 */
function DrawCubeV(\Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Vector3 $size, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCubeV($position->toCData(), $size->toCData(), $color->toCData());
}

/**
 * Draw cube wires
 */
function DrawCubeWires(\Nawarian\Raylib\Generated\Vector3 $position, float $width, float $height, float $length, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCubeWires($position->toCData(), $width, $height, $length, $color->toCData());
}

/**
 * Draw cube wires (Vector version)
 */
function DrawCubeWiresV(\Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Vector3 $size, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCubeWiresV($position->toCData(), $size->toCData(), $color->toCData());
}

/**
 * Draw cube textured
 */
function DrawCubeTexture(\Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Vector3 $position, float $width, float $height, float $length, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCubeTexture($texture->toCData(), $position->toCData(), $width, $height, $length, $color->toCData());
}

/**
 * Draw sphere
 */
function DrawSphere(\Nawarian\Raylib\Generated\Vector3 $centerPos, float $radius, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawSphere($centerPos->toCData(), $radius, $color->toCData());
}

/**
 * Draw sphere with extended parameters
 */
function DrawSphereEx(\Nawarian\Raylib\Generated\Vector3 $centerPos, float $radius, int $rings, int $slices, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawSphereEx($centerPos->toCData(), $radius, $rings, $slices, $color->toCData());
}

/**
 * Draw sphere wires
 */
function DrawSphereWires(\Nawarian\Raylib\Generated\Vector3 $centerPos, float $radius, int $rings, int $slices, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawSphereWires($centerPos->toCData(), $radius, $rings, $slices, $color->toCData());
}

/**
 * Draw a cylinder/cone
 */
function DrawCylinder(\Nawarian\Raylib\Generated\Vector3 $position, float $radiusTop, float $radiusBottom, float $height, int $slices, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCylinder($position->toCData(), $radiusTop, $radiusBottom, $height, $slices, $color->toCData());
}

/**
 * Draw a cylinder/cone wires
 */
function DrawCylinderWires(\Nawarian\Raylib\Generated\Vector3 $position, float $radiusTop, float $radiusBottom, float $height, int $slices, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawCylinderWires($position->toCData(), $radiusTop, $radiusBottom, $height, $slices, $color->toCData());
}

/**
 * Draw a plane XZ
 */
function DrawPlane(\Nawarian\Raylib\Generated\Vector3 $centerPos, \Nawarian\Raylib\Generated\Vector2 $size, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawPlane($centerPos->toCData(), $size->toCData(), $color->toCData());
}

/**
 * Draw a ray line
 */
function DrawRay(\Nawarian\Raylib\Generated\Ray $ray, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawRay($ray->toCData(), $color->toCData());
}

/**
 * Draw a grid (centered at (0, 0, 0))
 */
function DrawGrid(int $slices, float $spacing): void
{
    global $raylib;
    $raylib->DrawGrid($slices, $spacing);
}

/**
 * Load model from files (meshes and materials)
 */
function LoadModel(string $fileName): \Nawarian\Raylib\Generated\Model
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Model::fromCData($raylib->LoadModel($fileName));
}

/**
 * Load model from generated mesh (default material)
 */
function LoadModelFromMesh(\Nawarian\Raylib\Generated\Mesh $mesh): \Nawarian\Raylib\Generated\Model
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Model::fromCData($raylib->LoadModelFromMesh($mesh->toCData()));
}

/**
 * Unload model (including meshes) from memory (RAM and/or VRAM)
 */
function UnloadModel(\Nawarian\Raylib\Generated\Model $model): void
{
    global $raylib;
    $raylib->UnloadModel($model->toCData());
}

/**
 * Unload model (but not meshes) from memory (RAM and/or VRAM)
 */
function UnloadModelKeepMeshes(\Nawarian\Raylib\Generated\Model $model): void
{
    global $raylib;
    $raylib->UnloadModelKeepMeshes($model->toCData());
}

/**
 * Upload mesh vertex data in GPU and provide VAO/VBO ids
 */
function UploadMesh(array $mesh, bool $dynamic): void
{
    global $raylib;
    $raylib->UploadMesh($mesh, $dynamic->toCData());
}

/**
 * Update mesh vertex data in GPU for a specific buffer index
 */
function UpdateMeshBuffer(\Nawarian\Raylib\Generated\Mesh $mesh, int $index, \FFI\CData $data, int $dataSize, int $offset): void
{
    global $raylib;
    $raylib->UpdateMeshBuffer($mesh->toCData(), $index, $data, $dataSize, $offset);
}

/**
 * Draw a 3d mesh with material and transform
 */
function DrawMesh(\Nawarian\Raylib\Generated\Mesh $mesh, \Nawarian\Raylib\Generated\Material $material, \Nawarian\Raylib\Generated\Matrix $transform): void
{
    global $raylib;
    $raylib->DrawMesh($mesh->toCData(), $material->toCData(), $transform->toCData());
}

/**
 * Draw multiple mesh instances with material and different transforms
 */
function DrawMeshInstanced(\Nawarian\Raylib\Generated\Mesh $mesh, \Nawarian\Raylib\Generated\Material $material, array $transforms, int $instances): void
{
    global $raylib;
    $raylib->DrawMeshInstanced($mesh->toCData(), $material->toCData(), $transforms, $instances);
}

/**
 * Unload mesh data from CPU and GPU
 */
function UnloadMesh(\Nawarian\Raylib\Generated\Mesh $mesh): void
{
    global $raylib;
    $raylib->UnloadMesh($mesh->toCData());
}

/**
 * Export mesh data to file, returns true on success
 */
function ExportMesh(\Nawarian\Raylib\Generated\Mesh $mesh, string $fileName): bool
{
    global $raylib;
    return $raylib->ExportMesh($mesh->toCData(), $fileName);
}

/**
 * Load materials from model file
 */
function LoadMaterials(string $fileName, array $materialCount): array
{
    global $raylib;
    return $raylib->LoadMaterials($fileName, $materialCount);
}

/**
 * Load default material (Supports: DIFFUSE, SPECULAR, NORMAL maps)
 */
function LoadMaterialDefault(): \Nawarian\Raylib\Generated\Material
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Material::fromCData($raylib->LoadMaterialDefault());
}

/**
 * Unload material from GPU memory (VRAM)
 */
function UnloadMaterial(\Nawarian\Raylib\Generated\Material $material): void
{
    global $raylib;
    $raylib->UnloadMaterial($material->toCData());
}

/**
 * Set texture for a material map type (MATERIAL_MAP_DIFFUSE,
 * MATERIAL_MAP_SPECULAR...)
 */
function SetMaterialTexture(array $material, int $mapType, \Nawarian\Raylib\Generated\Texture $texture): void
{
    global $raylib;
    $raylib->SetMaterialTexture($material, $mapType, $texture->toCData());
}

/**
 * Set material for a mesh
 */
function SetModelMeshMaterial(\Nawarian\Raylib\Generated\Model $model, int $meshId, int $materialId): void
{
    global $raylib;
    $raylib->SetModelMeshMaterial($model->toCData(), $meshId, $materialId);
}

/**
 * Load model animations from file
 */
function LoadModelAnimations(string $fileName, array $animsCount): array
{
    global $raylib;
    return $raylib->LoadModelAnimations($fileName, $animsCount);
}

/**
 * Update model animation pose
 */
function UpdateModelAnimation(\Nawarian\Raylib\Generated\Model $model, \Nawarian\Raylib\Generated\ModelAnimation $anim, int $frame): void
{
    global $raylib;
    $raylib->UpdateModelAnimation($model->toCData(), $anim->toCData(), $frame);
}

/**
 * Unload animation data
 */
function UnloadModelAnimation(\Nawarian\Raylib\Generated\ModelAnimation $anim): void
{
    global $raylib;
    $raylib->UnloadModelAnimation($anim->toCData());
}

/**
 * Unload animation array data
 */
function UnloadModelAnimations(array $animations, int $count): void
{
    global $raylib;
    $raylib->UnloadModelAnimations($animations, $count);
}

/**
 * Check model animation skeleton match
 */
function IsModelAnimationValid(\Nawarian\Raylib\Generated\Model $model, \Nawarian\Raylib\Generated\ModelAnimation $anim): bool
{
    global $raylib;
    return $raylib->IsModelAnimationValid($model->toCData(), $anim->toCData());
}

/**
 * Generate polygonal mesh
 */
function GenMeshPoly(int $sides, float $radius): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshPoly($sides, $radius));
}

/**
 * Generate plane mesh (with subdivisions)
 */
function GenMeshPlane(float $width, float $length, int $resX, int $resZ): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshPlane($width, $length, $resX, $resZ));
}

/**
 * Generate cuboid mesh
 */
function GenMeshCube(float $width, float $height, float $length): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshCube($width, $height, $length));
}

/**
 * Generate sphere mesh (standard sphere)
 */
function GenMeshSphere(float $radius, int $rings, int $slices): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshSphere($radius, $rings, $slices));
}

/**
 * Generate half-sphere mesh (no bottom cap)
 */
function GenMeshHemiSphere(float $radius, int $rings, int $slices): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshHemiSphere($radius, $rings, $slices));
}

/**
 * Generate cylinder mesh
 */
function GenMeshCylinder(float $radius, float $height, int $slices): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshCylinder($radius, $height, $slices));
}

/**
 * Generate torus mesh
 */
function GenMeshTorus(float $radius, float $size, int $radSeg, int $sides): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshTorus($radius, $size, $radSeg, $sides));
}

/**
 * Generate trefoil knot mesh
 */
function GenMeshKnot(float $radius, float $size, int $radSeg, int $sides): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshKnot($radius, $size, $radSeg, $sides));
}

/**
 * Generate heightmap mesh from image data
 */
function GenMeshHeightmap(\Nawarian\Raylib\Generated\Image $heightmap, \Nawarian\Raylib\Generated\Vector3 $size): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshHeightmap($heightmap->toCData(), $size->toCData()));
}

/**
 * Generate cubes-based map mesh from image data
 */
function GenMeshCubicmap(\Nawarian\Raylib\Generated\Image $cubicmap, \Nawarian\Raylib\Generated\Vector3 $cubeSize): \Nawarian\Raylib\Generated\Mesh
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshCubicmap($cubicmap->toCData(), $cubeSize->toCData()));
}

/**
 * Compute mesh bounding box limits
 */
function GetMeshBoundingBox(\Nawarian\Raylib\Generated\Mesh $mesh): \Nawarian\Raylib\Generated\BoundingBox
{
    global $raylib;
    return \Nawarian\Raylib\Generated\BoundingBox::fromCData($raylib->GetMeshBoundingBox($mesh->toCData()));
}

/**
 * Compute mesh tangents
 */
function MeshTangents(array $mesh): void
{
    global $raylib;
    $raylib->MeshTangents($mesh);
}

/**
 * Compute mesh binormals
 */
function MeshBinormals(array $mesh): void
{
    global $raylib;
    $raylib->MeshBinormals($mesh);
}

/**
 * Draw a model (with texture if set)
 */
function DrawModel(\Nawarian\Raylib\Generated\Model $model, \Nawarian\Raylib\Generated\Vector3 $position, float $scale, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawModel($model->toCData(), $position->toCData(), $scale, $tint->toCData());
}

/**
 * Draw a model with extended parameters
 */
function DrawModelEx(\Nawarian\Raylib\Generated\Model $model, \Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Vector3 $rotationAxis, float $rotationAngle, \Nawarian\Raylib\Generated\Vector3 $scale, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawModelEx($model->toCData(), $position->toCData(), $rotationAxis->toCData(), $rotationAngle, $scale->toCData(), $tint->toCData());
}

/**
 * Draw a model wires (with texture if set)
 */
function DrawModelWires(\Nawarian\Raylib\Generated\Model $model, \Nawarian\Raylib\Generated\Vector3 $position, float $scale, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawModelWires($model->toCData(), $position->toCData(), $scale, $tint->toCData());
}

/**
 * Draw a model wires (with texture if set) with extended parameters
 */
function DrawModelWiresEx(\Nawarian\Raylib\Generated\Model $model, \Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Vector3 $rotationAxis, float $rotationAngle, \Nawarian\Raylib\Generated\Vector3 $scale, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawModelWiresEx($model->toCData(), $position->toCData(), $rotationAxis->toCData(), $rotationAngle, $scale->toCData(), $tint->toCData());
}

/**
 * Draw bounding box (wires)
 */
function DrawBoundingBox(\Nawarian\Raylib\Generated\BoundingBox $box, \Nawarian\Raylib\Generated\Color $color): void
{
    global $raylib;
    $raylib->DrawBoundingBox($box->toCData(), $color->toCData());
}

/**
 * Draw a billboard texture
 */
function DrawBillboard(\Nawarian\Raylib\Generated\Camera3D $camera, \Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Vector3 $position, float $size, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawBillboard($camera->toCData(), $texture->toCData(), $position->toCData(), $size, $tint->toCData());
}

/**
 * Draw a billboard texture defined by source
 */
function DrawBillboardRec(\Nawarian\Raylib\Generated\Camera3D $camera, \Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Rectangle $source, \Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Vector2 $size, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawBillboardRec($camera->toCData(), $texture->toCData(), $source->toCData(), $position->toCData(), $size->toCData(), $tint->toCData());
}

/**
 * Draw a billboard texture defined by source and rotation
 */
function DrawBillboardPro(\Nawarian\Raylib\Generated\Camera3D $camera, \Nawarian\Raylib\Generated\Texture $texture, \Nawarian\Raylib\Generated\Rectangle $source, \Nawarian\Raylib\Generated\Vector3 $position, \Nawarian\Raylib\Generated\Vector2 $size, \Nawarian\Raylib\Generated\Vector2 $origin, float $rotation, \Nawarian\Raylib\Generated\Color $tint): void
{
    global $raylib;
    $raylib->DrawBillboardPro($camera->toCData(), $texture->toCData(), $source->toCData(), $position->toCData(), $size->toCData(), $origin->toCData(), $rotation, $tint->toCData());
}

/**
 * Check collision between two spheres
 */
function CheckCollisionSpheres(\Nawarian\Raylib\Generated\Vector3 $center1, float $radius1, \Nawarian\Raylib\Generated\Vector3 $center2, float $radius2): bool
{
    global $raylib;
    return $raylib->CheckCollisionSpheres($center1->toCData(), $radius1, $center2->toCData(), $radius2);
}

/**
 * Check collision between two bounding boxes
 */
function CheckCollisionBoxes(\Nawarian\Raylib\Generated\BoundingBox $box1, \Nawarian\Raylib\Generated\BoundingBox $box2): bool
{
    global $raylib;
    return $raylib->CheckCollisionBoxes($box1->toCData(), $box2->toCData());
}

/**
 * Check collision between box and sphere
 */
function CheckCollisionBoxSphere(\Nawarian\Raylib\Generated\BoundingBox $box, \Nawarian\Raylib\Generated\Vector3 $center, float $radius): bool
{
    global $raylib;
    return $raylib->CheckCollisionBoxSphere($box->toCData(), $center->toCData(), $radius);
}

/**
 * Get collision info between ray and sphere
 */
function GetRayCollisionSphere(\Nawarian\Raylib\Generated\Ray $ray, \Nawarian\Raylib\Generated\Vector3 $center, float $radius): \Nawarian\Raylib\Generated\RayCollision
{
    global $raylib;
    return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionSphere($ray->toCData(), $center->toCData(), $radius));
}

/**
 * Get collision info between ray and box
 */
function GetRayCollisionBox(\Nawarian\Raylib\Generated\Ray $ray, \Nawarian\Raylib\Generated\BoundingBox $box): \Nawarian\Raylib\Generated\RayCollision
{
    global $raylib;
    return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionBox($ray->toCData(), $box->toCData()));
}

/**
 * Get collision info between ray and model
 */
function GetRayCollisionModel(\Nawarian\Raylib\Generated\Ray $ray, \Nawarian\Raylib\Generated\Model $model): \Nawarian\Raylib\Generated\RayCollision
{
    global $raylib;
    return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionModel($ray->toCData(), $model->toCData()));
}

/**
 * Get collision info between ray and mesh
 */
function GetRayCollisionMesh(\Nawarian\Raylib\Generated\Ray $ray, \Nawarian\Raylib\Generated\Mesh $mesh, \Nawarian\Raylib\Generated\Matrix $transform): \Nawarian\Raylib\Generated\RayCollision
{
    global $raylib;
    return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionMesh($ray->toCData(), $mesh->toCData(), $transform->toCData()));
}

/**
 * Get collision info between ray and triangle
 */
function GetRayCollisionTriangle(\Nawarian\Raylib\Generated\Ray $ray, \Nawarian\Raylib\Generated\Vector3 $p1, \Nawarian\Raylib\Generated\Vector3 $p2, \Nawarian\Raylib\Generated\Vector3 $p3): \Nawarian\Raylib\Generated\RayCollision
{
    global $raylib;
    return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionTriangle($ray->toCData(), $p1->toCData(), $p2->toCData(), $p3->toCData()));
}

/**
 * Get collision info between ray and quad
 */
function GetRayCollisionQuad(\Nawarian\Raylib\Generated\Ray $ray, \Nawarian\Raylib\Generated\Vector3 $p1, \Nawarian\Raylib\Generated\Vector3 $p2, \Nawarian\Raylib\Generated\Vector3 $p3, \Nawarian\Raylib\Generated\Vector3 $p4): \Nawarian\Raylib\Generated\RayCollision
{
    global $raylib;
    return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionQuad($ray->toCData(), $p1->toCData(), $p2->toCData(), $p3->toCData(), $p4->toCData()));
}

/**
 * Initialize audio device and context
 */
function InitAudioDevice(): void
{
    global $raylib;
    $raylib->InitAudioDevice();
}

/**
 * Close the audio device and context
 */
function CloseAudioDevice(): void
{
    global $raylib;
    $raylib->CloseAudioDevice();
}

/**
 * Check if audio device has been initialized successfully
 */
function IsAudioDeviceReady(): bool
{
    global $raylib;
    return $raylib->IsAudioDeviceReady();
}

/**
 * Set master volume (listener)
 */
function SetMasterVolume(float $volume): void
{
    global $raylib;
    $raylib->SetMasterVolume($volume);
}

/**
 * Load wave data from file
 */
function LoadWave(string $fileName): \Nawarian\Raylib\Generated\Wave
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Wave::fromCData($raylib->LoadWave($fileName));
}

/**
 * Load wave from memory buffer, fileType refers to extension: i.e. '.wav'
 */
function LoadWaveFromMemory(string $fileType, array $fileData, int $dataSize): \Nawarian\Raylib\Generated\Wave
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Wave::fromCData($raylib->LoadWaveFromMemory($fileType, $fileData, $dataSize));
}

/**
 * Load sound from file
 */
function LoadSound(string $fileName): \Nawarian\Raylib\Generated\Sound
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Sound::fromCData($raylib->LoadSound($fileName));
}

/**
 * Load sound from wave data
 */
function LoadSoundFromWave(\Nawarian\Raylib\Generated\Wave $wave): \Nawarian\Raylib\Generated\Sound
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Sound::fromCData($raylib->LoadSoundFromWave($wave->toCData()));
}

/**
 * Update sound buffer with new data
 */
function UpdateSound(\Nawarian\Raylib\Generated\Sound $sound, \FFI\CData $data, int $samplesCount): void
{
    global $raylib;
    $raylib->UpdateSound($sound->toCData(), $data, $samplesCount);
}

/**
 * Unload wave data
 */
function UnloadWave(\Nawarian\Raylib\Generated\Wave $wave): void
{
    global $raylib;
    $raylib->UnloadWave($wave->toCData());
}

/**
 * Unload sound
 */
function UnloadSound(\Nawarian\Raylib\Generated\Sound $sound): void
{
    global $raylib;
    $raylib->UnloadSound($sound->toCData());
}

/**
 * Export wave data to file, returns true on success
 */
function ExportWave(\Nawarian\Raylib\Generated\Wave $wave, string $fileName): bool
{
    global $raylib;
    return $raylib->ExportWave($wave->toCData(), $fileName);
}

/**
 * Export wave sample data to code (.h), returns true on success
 */
function ExportWaveAsCode(\Nawarian\Raylib\Generated\Wave $wave, string $fileName): bool
{
    global $raylib;
    return $raylib->ExportWaveAsCode($wave->toCData(), $fileName);
}

/**
 * Play a sound
 */
function PlaySound(\Nawarian\Raylib\Generated\Sound $sound): void
{
    global $raylib;
    $raylib->PlaySound($sound->toCData());
}

/**
 * Stop playing a sound
 */
function StopSound(\Nawarian\Raylib\Generated\Sound $sound): void
{
    global $raylib;
    $raylib->StopSound($sound->toCData());
}

/**
 * Pause a sound
 */
function PauseSound(\Nawarian\Raylib\Generated\Sound $sound): void
{
    global $raylib;
    $raylib->PauseSound($sound->toCData());
}

/**
 * Resume a paused sound
 */
function ResumeSound(\Nawarian\Raylib\Generated\Sound $sound): void
{
    global $raylib;
    $raylib->ResumeSound($sound->toCData());
}

/**
 * Play a sound (using multichannel buffer pool)
 */
function PlaySoundMulti(\Nawarian\Raylib\Generated\Sound $sound): void
{
    global $raylib;
    $raylib->PlaySoundMulti($sound->toCData());
}

/**
 * Stop any sound playing (using multichannel buffer pool)
 */
function StopSoundMulti(): void
{
    global $raylib;
    $raylib->StopSoundMulti();
}

/**
 * Get number of sounds playing in the multichannel
 */
function GetSoundsPlaying(): int
{
    global $raylib;
    return $raylib->GetSoundsPlaying();
}

/**
 * Check if a sound is currently playing
 */
function IsSoundPlaying(\Nawarian\Raylib\Generated\Sound $sound): bool
{
    global $raylib;
    return $raylib->IsSoundPlaying($sound->toCData());
}

/**
 * Set volume for a sound (1.0 is max level)
 */
function SetSoundVolume(\Nawarian\Raylib\Generated\Sound $sound, float $volume): void
{
    global $raylib;
    $raylib->SetSoundVolume($sound->toCData(), $volume);
}

/**
 * Set pitch for a sound (1.0 is base level)
 */
function SetSoundPitch(\Nawarian\Raylib\Generated\Sound $sound, float $pitch): void
{
    global $raylib;
    $raylib->SetSoundPitch($sound->toCData(), $pitch);
}

/**
 * Convert wave data to desired format
 */
function WaveFormat(\Nawarian\Raylib\Generated\Wave $wave, int $sampleRate, int $sampleSize, int $channels): void
{
    global $raylib;
    $raylib->WaveFormat($wave->toCData(), $sampleRate, $sampleSize, $channels);
}

/**
 * Copy a wave to a new wave
 */
function WaveCopy(\Nawarian\Raylib\Generated\Wave $wave): \Nawarian\Raylib\Generated\Wave
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Wave::fromCData($raylib->WaveCopy($wave->toCData()));
}

/**
 * Crop a wave to defined samples range
 */
function WaveCrop(\Nawarian\Raylib\Generated\Wave $wave, int $initSample, int $finalSample): void
{
    global $raylib;
    $raylib->WaveCrop($wave->toCData(), $initSample, $finalSample);
}

/**
 * Load samples data from wave as a floats array
 */
function LoadWaveSamples(\Nawarian\Raylib\Generated\Wave $wave): array
{
    global $raylib;
    return $raylib->LoadWaveSamples($wave->toCData());
}

/**
 * Unload samples data loaded with LoadWaveSamples()
 */
function UnloadWaveSamples(array $samples): void
{
    global $raylib;
    $raylib->UnloadWaveSamples($samples);
}

/**
 * Load music stream from file
 */
function LoadMusicStream(string $fileName): \Nawarian\Raylib\Generated\Music
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Music::fromCData($raylib->LoadMusicStream($fileName));
}

/**
 * Load music stream from data
 */
function LoadMusicStreamFromMemory(string $fileType, array $data, int $dataSize): \Nawarian\Raylib\Generated\Music
{
    global $raylib;
    return \Nawarian\Raylib\Generated\Music::fromCData($raylib->LoadMusicStreamFromMemory($fileType, $data, $dataSize));
}

/**
 * Unload music stream
 */
function UnloadMusicStream(\Nawarian\Raylib\Generated\Music $music): void
{
    global $raylib;
    $raylib->UnloadMusicStream($music->toCData());
}

/**
 * Start music playing
 */
function PlayMusicStream(\Nawarian\Raylib\Generated\Music $music): void
{
    global $raylib;
    $raylib->PlayMusicStream($music->toCData());
}

/**
 * Check if music is playing
 */
function IsMusicStreamPlaying(\Nawarian\Raylib\Generated\Music $music): bool
{
    global $raylib;
    return $raylib->IsMusicStreamPlaying($music->toCData());
}

/**
 * Updates buffers for music streaming
 */
function UpdateMusicStream(\Nawarian\Raylib\Generated\Music $music): void
{
    global $raylib;
    $raylib->UpdateMusicStream($music->toCData());
}

/**
 * Stop music playing
 */
function StopMusicStream(\Nawarian\Raylib\Generated\Music $music): void
{
    global $raylib;
    $raylib->StopMusicStream($music->toCData());
}

/**
 * Pause music playing
 */
function PauseMusicStream(\Nawarian\Raylib\Generated\Music $music): void
{
    global $raylib;
    $raylib->PauseMusicStream($music->toCData());
}

/**
 * Resume playing paused music
 */
function ResumeMusicStream(\Nawarian\Raylib\Generated\Music $music): void
{
    global $raylib;
    $raylib->ResumeMusicStream($music->toCData());
}

/**
 * Set volume for music (1.0 is max level)
 */
function SetMusicVolume(\Nawarian\Raylib\Generated\Music $music, float $volume): void
{
    global $raylib;
    $raylib->SetMusicVolume($music->toCData(), $volume);
}

/**
 * Set pitch for a music (1.0 is base level)
 */
function SetMusicPitch(\Nawarian\Raylib\Generated\Music $music, float $pitch): void
{
    global $raylib;
    $raylib->SetMusicPitch($music->toCData(), $pitch);
}

/**
 * Get music time length (in seconds)
 */
function GetMusicTimeLength(\Nawarian\Raylib\Generated\Music $music): float
{
    global $raylib;
    return $raylib->GetMusicTimeLength($music->toCData());
}

/**
 * Get current music time played (in seconds)
 */
function GetMusicTimePlayed(\Nawarian\Raylib\Generated\Music $music): float
{
    global $raylib;
    return $raylib->GetMusicTimePlayed($music->toCData());
}

/**
 * Load audio stream (to stream raw audio pcm data)
 */
function LoadAudioStream(int $sampleRate, int $sampleSize, int $channels): \Nawarian\Raylib\Generated\AudioStream
{
    global $raylib;
    return \Nawarian\Raylib\Generated\AudioStream::fromCData($raylib->LoadAudioStream($sampleRate, $sampleSize, $channels));
}

/**
 * Unload audio stream and free memory
 */
function UnloadAudioStream(\Nawarian\Raylib\Generated\AudioStream $stream): void
{
    global $raylib;
    $raylib->UnloadAudioStream($stream->toCData());
}

/**
 * Update audio stream buffers with data
 */
function UpdateAudioStream(\Nawarian\Raylib\Generated\AudioStream $stream, \FFI\CData $data, int $samplesCount): void
{
    global $raylib;
    $raylib->UpdateAudioStream($stream->toCData(), $data, $samplesCount);
}

/**
 * Check if any audio stream buffers requires refill
 */
function IsAudioStreamProcessed(\Nawarian\Raylib\Generated\AudioStream $stream): bool
{
    global $raylib;
    return $raylib->IsAudioStreamProcessed($stream->toCData());
}

/**
 * Play audio stream
 */
function PlayAudioStream(\Nawarian\Raylib\Generated\AudioStream $stream): void
{
    global $raylib;
    $raylib->PlayAudioStream($stream->toCData());
}

/**
 * Pause audio stream
 */
function PauseAudioStream(\Nawarian\Raylib\Generated\AudioStream $stream): void
{
    global $raylib;
    $raylib->PauseAudioStream($stream->toCData());
}

/**
 * Resume audio stream
 */
function ResumeAudioStream(\Nawarian\Raylib\Generated\AudioStream $stream): void
{
    global $raylib;
    $raylib->ResumeAudioStream($stream->toCData());
}

/**
 * Check if audio stream is playing
 */
function IsAudioStreamPlaying(\Nawarian\Raylib\Generated\AudioStream $stream): bool
{
    global $raylib;
    return $raylib->IsAudioStreamPlaying($stream->toCData());
}

/**
 * Stop audio stream
 */
function StopAudioStream(\Nawarian\Raylib\Generated\AudioStream $stream): void
{
    global $raylib;
    $raylib->StopAudioStream($stream->toCData());
}

/**
 * Set volume for audio stream (1.0 is max level)
 */
function SetAudioStreamVolume(\Nawarian\Raylib\Generated\AudioStream $stream, float $volume): void
{
    global $raylib;
    $raylib->SetAudioStreamVolume($stream->toCData(), $volume);
}

/**
 * Set pitch for audio stream (1.0 is base level)
 */
function SetAudioStreamPitch(\Nawarian\Raylib\Generated\AudioStream $stream, float $pitch): void
{
    global $raylib;
    $raylib->SetAudioStreamPitch($stream->toCData(), $pitch);
}

/**
 * Default size for new audio streams
 */
function SetAudioStreamBufferSizeDefault(int $size): void
{
    global $raylib;
    $raylib->SetAudioStreamBufferSizeDefault($size);
}
