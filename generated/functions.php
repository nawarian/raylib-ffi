<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

/**
 * Initialize window and OpenGL context
 */
 function InitWindow(int $paramwidth, int $paramheight, string $paramtitle) : void
{
global $raylib;
$raylib->InitWindow($paramwidth, $paramheight, $paramtitle);
}

/**
 * Check if KEY_ESCAPE pressed or Close icon pressed
 */
 function WindowShouldClose() : bool
{
global $raylib;
return $raylib->WindowShouldClose();
}

/**
 * Close window and unload OpenGL context
 */
 function CloseWindow() : void
{
global $raylib;
$raylib->CloseWindow();
}

/**
 * Check if window has been initialized successfully
 */
 function IsWindowReady() : bool
{
global $raylib;
return $raylib->IsWindowReady();
}

/**
 * Check if window is currently fullscreen
 */
 function IsWindowFullscreen() : bool
{
global $raylib;
return $raylib->IsWindowFullscreen();
}

/**
 * Check if window is currently hidden (only PLATFORM_DESKTOP)
 */
 function IsWindowHidden() : bool
{
global $raylib;
return $raylib->IsWindowHidden();
}

/**
 * Check if window is currently minimized (only PLATFORM_DESKTOP)
 */
 function IsWindowMinimized() : bool
{
global $raylib;
return $raylib->IsWindowMinimized();
}

/**
 * Check if window is currently maximized (only PLATFORM_DESKTOP)
 */
 function IsWindowMaximized() : bool
{
global $raylib;
return $raylib->IsWindowMaximized();
}

/**
 * Check if window is currently focused (only PLATFORM_DESKTOP)
 */
 function IsWindowFocused() : bool
{
global $raylib;
return $raylib->IsWindowFocused();
}

/**
 * Check if window has been resized last frame
 */
 function IsWindowResized() : bool
{
global $raylib;
return $raylib->IsWindowResized();
}

/**
 * Check if one specific window flag is enabled
 */
 function IsWindowState(int $paramflag) : bool
{
global $raylib;
return $raylib->IsWindowState($paramflag);
}

/**
 * Set window configuration state using flags
 */
 function SetWindowState(int $paramflags) : void
{
global $raylib;
$raylib->SetWindowState($paramflags);
}

/**
 * Clear window configuration state flags
 */
 function ClearWindowState(int $paramflags) : void
{
global $raylib;
$raylib->ClearWindowState($paramflags);
}

/**
 * Toggle window state: fullscreen/windowed (only PLATFORM_DESKTOP)
 */
 function ToggleFullscreen() : void
{
global $raylib;
$raylib->ToggleFullscreen();
}

/**
 * Set window state: maximized, if resizable (only PLATFORM_DESKTOP)
 */
 function MaximizeWindow() : void
{
global $raylib;
$raylib->MaximizeWindow();
}

/**
 * Set window state: minimized, if resizable (only PLATFORM_DESKTOP)
 */
 function MinimizeWindow() : void
{
global $raylib;
$raylib->MinimizeWindow();
}

/**
 * Set window state: not minimized/maximized (only PLATFORM_DESKTOP)
 */
 function RestoreWindow() : void
{
global $raylib;
$raylib->RestoreWindow();
}

/**
 * Set icon for window (only PLATFORM_DESKTOP)
 */
 function SetWindowIcon(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->SetWindowIcon($paramimage->toCData());
}

/**
 * Set title for window (only PLATFORM_DESKTOP)
 */
 function SetWindowTitle(string $paramtitle) : void
{
global $raylib;
$raylib->SetWindowTitle($paramtitle);
}

/**
 * Set window position on screen (only PLATFORM_DESKTOP)
 */
 function SetWindowPosition(int $paramx, int $paramy) : void
{
global $raylib;
$raylib->SetWindowPosition($paramx, $paramy);
}

/**
 * Set monitor for the current window (fullscreen mode)
 */
 function SetWindowMonitor(int $parammonitor) : void
{
global $raylib;
$raylib->SetWindowMonitor($parammonitor);
}

/**
 * Set window minimum dimensions (for FLAG_WINDOW_RESIZABLE)
 */
 function SetWindowMinSize(int $paramwidth, int $paramheight) : void
{
global $raylib;
$raylib->SetWindowMinSize($paramwidth, $paramheight);
}

/**
 * Set window dimensions
 */
 function SetWindowSize(int $paramwidth, int $paramheight) : void
{
global $raylib;
$raylib->SetWindowSize($paramwidth, $paramheight);
}

/**
 * Get native window handle
 */
 function GetWindowHandle() : \FFI\CData
{
global $raylib;
return $raylib->GetWindowHandle();
}

/**
 * Get current screen width
 */
 function GetScreenWidth() : int
{
global $raylib;
return $raylib->GetScreenWidth();
}

/**
 * Get current screen height
 */
 function GetScreenHeight() : int
{
global $raylib;
return $raylib->GetScreenHeight();
}

/**
 * Get number of connected monitors
 */
 function GetMonitorCount() : int
{
global $raylib;
return $raylib->GetMonitorCount();
}

/**
 * Get current connected monitor
 */
 function GetCurrentMonitor() : int
{
global $raylib;
return $raylib->GetCurrentMonitor();
}

/**
 * Get specified monitor position
 */
 function GetMonitorPosition(int $parammonitor) : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetMonitorPosition($parammonitor));
}

/**
 * Get specified monitor width (max available by monitor)
 */
 function GetMonitorWidth(int $parammonitor) : int
{
global $raylib;
return $raylib->GetMonitorWidth($parammonitor);
}

/**
 * Get specified monitor height (max available by monitor)
 */
 function GetMonitorHeight(int $parammonitor) : int
{
global $raylib;
return $raylib->GetMonitorHeight($parammonitor);
}

/**
 * Get specified monitor physical width in millimetres
 */
 function GetMonitorPhysicalWidth(int $parammonitor) : int
{
global $raylib;
return $raylib->GetMonitorPhysicalWidth($parammonitor);
}

/**
 * Get specified monitor physical height in millimetres
 */
 function GetMonitorPhysicalHeight(int $parammonitor) : int
{
global $raylib;
return $raylib->GetMonitorPhysicalHeight($parammonitor);
}

/**
 * Get specified monitor refresh rate
 */
 function GetMonitorRefreshRate(int $parammonitor) : int
{
global $raylib;
return $raylib->GetMonitorRefreshRate($parammonitor);
}

/**
 * Get window position XY on monitor
 */
 function GetWindowPosition() : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWindowPosition());
}

/**
 * Get window scale DPI factor
 */
 function GetWindowScaleDPI() : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWindowScaleDPI());
}

/**
 * Get the human-readable, UTF-8 encoded name of the primary monitor
 */
 function GetMonitorName(int $parammonitor) : string
{
global $raylib;
return $raylib->GetMonitorName($parammonitor);
}

/**
 * Set clipboard text content
 */
 function SetClipboardText(string $paramtext) : void
{
global $raylib;
$raylib->SetClipboardText($paramtext);
}

/**
 * Get clipboard text content
 */
 function GetClipboardText() : string
{
global $raylib;
return $raylib->GetClipboardText();
}

/**
 * Shows cursor
 */
 function ShowCursor() : void
{
global $raylib;
$raylib->ShowCursor();
}

/**
 * Hides cursor
 */
 function HideCursor() : void
{
global $raylib;
$raylib->HideCursor();
}

/**
 * Check if cursor is not visible
 */
 function IsCursorHidden() : bool
{
global $raylib;
return $raylib->IsCursorHidden();
}

/**
 * Enables cursor (unlock cursor)
 */
 function EnableCursor() : void
{
global $raylib;
$raylib->EnableCursor();
}

/**
 * Disables cursor (lock cursor)
 */
 function DisableCursor() : void
{
global $raylib;
$raylib->DisableCursor();
}

/**
 * Check if cursor is on the screen
 */
 function IsCursorOnScreen() : bool
{
global $raylib;
return $raylib->IsCursorOnScreen();
}

/**
 * Set background color (framebuffer clear color)
 */
 function ClearBackground(\Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ClearBackground($paramcolor->toCData());
}

/**
 * Setup canvas (framebuffer) to start drawing
 */
 function BeginDrawing() : void
{
global $raylib;
$raylib->BeginDrawing();
}

/**
 * End canvas drawing and swap buffers (double buffering)
 */
 function EndDrawing() : void
{
global $raylib;
$raylib->EndDrawing();
}

/**
 * Begin 2D mode with custom camera (2D)
 */
 function BeginMode2D(\Nawarian\Raylib\Generated\Camera2D $paramcamera) : void
{
global $raylib;
$raylib->BeginMode2D($paramcamera->toCData());
}

/**
 * Ends 2D mode with custom camera
 */
 function EndMode2D() : void
{
global $raylib;
$raylib->EndMode2D();
}

/**
 * Begin 3D mode with custom camera (3D)
 */
 function BeginMode3D(\Nawarian\Raylib\Generated\Camera3D $paramcamera) : void
{
global $raylib;
$raylib->BeginMode3D($paramcamera->toCData());
}

/**
 * Ends 3D mode and returns to default 2D orthographic mode
 */
 function EndMode3D() : void
{
global $raylib;
$raylib->EndMode3D();
}

/**
 * Begin drawing to render texture
 */
 function BeginTextureMode(\Nawarian\Raylib\Generated\RenderTexture $paramtarget) : void
{
global $raylib;
$raylib->BeginTextureMode($paramtarget->toCData());
}

/**
 * Ends drawing to render texture
 */
 function EndTextureMode() : void
{
global $raylib;
$raylib->EndTextureMode();
}

/**
 * Begin custom shader drawing
 */
 function BeginShaderMode(\Nawarian\Raylib\Generated\Shader $paramshader) : void
{
global $raylib;
$raylib->BeginShaderMode($paramshader->toCData());
}

/**
 * End custom shader drawing (use default shader)
 */
 function EndShaderMode() : void
{
global $raylib;
$raylib->EndShaderMode();
}

/**
 * Begin blending mode (alpha, additive, multiplied, subtract, custom)
 */
 function BeginBlendMode(int $parammode) : void
{
global $raylib;
$raylib->BeginBlendMode($parammode);
}

/**
 * End blending mode (reset to default: alpha blending)
 */
 function EndBlendMode() : void
{
global $raylib;
$raylib->EndBlendMode();
}

/**
 * Begin scissor mode (define screen area for following drawing)
 */
 function BeginScissorMode(int $paramx, int $paramy, int $paramwidth, int $paramheight) : void
{
global $raylib;
$raylib->BeginScissorMode($paramx, $paramy, $paramwidth, $paramheight);
}

/**
 * End scissor mode
 */
 function EndScissorMode() : void
{
global $raylib;
$raylib->EndScissorMode();
}

/**
 * Begin stereo rendering (requires VR simulator)
 */
 function BeginVrStereoMode(\Nawarian\Raylib\Generated\VrStereoConfig $paramconfig) : void
{
global $raylib;
$raylib->BeginVrStereoMode($paramconfig->toCData());
}

/**
 * End stereo rendering (requires VR simulator)
 */
 function EndVrStereoMode() : void
{
global $raylib;
$raylib->EndVrStereoMode();
}

/**
 * Load VR stereo config for VR simulator device parameters
 */
 function LoadVrStereoConfig(\Nawarian\Raylib\Generated\VrDeviceInfo $paramdevice) : \Nawarian\Raylib\Generated\VrStereoConfig
{
global $raylib;
return \Nawarian\Raylib\Generated\VrStereoConfig::fromCData($raylib->LoadVrStereoConfig($paramdevice->toCData()));
}

/**
 * Unload VR stereo config
 */
 function UnloadVrStereoConfig(\Nawarian\Raylib\Generated\VrStereoConfig $paramconfig) : void
{
global $raylib;
$raylib->UnloadVrStereoConfig($paramconfig->toCData());
}

/**
 * Load shader from files and bind default locations
 */
 function LoadShader(string $paramvsFileName, string $paramfsFileName) : \Nawarian\Raylib\Generated\Shader
{
global $raylib;
return \Nawarian\Raylib\Generated\Shader::fromCData($raylib->LoadShader($paramvsFileName, $paramfsFileName));
}

/**
 * Load shader from code strings and bind default locations
 */
 function LoadShaderFromMemory(string $paramvsCode, string $paramfsCode) : \Nawarian\Raylib\Generated\Shader
{
global $raylib;
return \Nawarian\Raylib\Generated\Shader::fromCData($raylib->LoadShaderFromMemory($paramvsCode, $paramfsCode));
}

/**
 * Get shader uniform location
 */
 function GetShaderLocation(\Nawarian\Raylib\Generated\Shader $paramshader, string $paramuniformName) : int
{
global $raylib;
return $raylib->GetShaderLocation($paramshader->toCData(), $paramuniformName);
}

/**
 * Get shader attribute location
 */
 function GetShaderLocationAttrib(\Nawarian\Raylib\Generated\Shader $paramshader, string $paramattribName) : int
{
global $raylib;
return $raylib->GetShaderLocationAttrib($paramshader->toCData(), $paramattribName);
}

/**
 * Set shader uniform value
 */
 function SetShaderValue(\Nawarian\Raylib\Generated\Shader $paramshader, int $paramlocIndex, \FFI\CData $paramvalue, int $paramuniformType) : void
{
global $raylib;
$raylib->SetShaderValue($paramshader->toCData(), $paramlocIndex, $paramvalue, $paramuniformType);
}

/**
 * Set shader uniform value vector
 */
 function SetShaderValueV(\Nawarian\Raylib\Generated\Shader $paramshader, int $paramlocIndex, \FFI\CData $paramvalue, int $paramuniformType, int $paramcount) : void
{
global $raylib;
$raylib->SetShaderValueV($paramshader->toCData(), $paramlocIndex, $paramvalue, $paramuniformType, $paramcount);
}

/**
 * Set shader uniform value (matrix 4x4)
 */
 function SetShaderValueMatrix(\Nawarian\Raylib\Generated\Shader $paramshader, int $paramlocIndex, \Nawarian\Raylib\Generated\Matrix $parammat) : void
{
global $raylib;
$raylib->SetShaderValueMatrix($paramshader->toCData(), $paramlocIndex, $parammat->toCData());
}

/**
 * Set shader uniform value for texture (sampler2d)
 */
 function SetShaderValueTexture(\Nawarian\Raylib\Generated\Shader $paramshader, int $paramlocIndex, \Nawarian\Raylib\Generated\Texture $paramtexture) : void
{
global $raylib;
$raylib->SetShaderValueTexture($paramshader->toCData(), $paramlocIndex, $paramtexture->toCData());
}

/**
 * Unload shader from GPU memory (VRAM)
 */
 function UnloadShader(\Nawarian\Raylib\Generated\Shader $paramshader) : void
{
global $raylib;
$raylib->UnloadShader($paramshader->toCData());
}

/**
 * Get a ray trace from mouse position
 */
 function GetMouseRay(\Nawarian\Raylib\Generated\Vector2 $parammousePosition, \Nawarian\Raylib\Generated\Camera3D $paramcamera) : \Nawarian\Raylib\Generated\Ray
{
global $raylib;
return \Nawarian\Raylib\Generated\Ray::fromCData($raylib->GetMouseRay($parammousePosition->toCData(), $paramcamera->toCData()));
}

/**
 * Get camera transform matrix (view matrix)
 */
 function GetCameraMatrix(\Nawarian\Raylib\Generated\Camera3D $paramcamera) : \Nawarian\Raylib\Generated\Matrix
{
global $raylib;
return \Nawarian\Raylib\Generated\Matrix::fromCData($raylib->GetCameraMatrix($paramcamera->toCData()));
}

/**
 * Get camera 2d transform matrix
 */
 function GetCameraMatrix2D(\Nawarian\Raylib\Generated\Camera2D $paramcamera) : \Nawarian\Raylib\Generated\Matrix
{
global $raylib;
return \Nawarian\Raylib\Generated\Matrix::fromCData($raylib->GetCameraMatrix2D($paramcamera->toCData()));
}

/**
 * Get the screen space position for a 3d world space position
 */
 function GetWorldToScreen(\Nawarian\Raylib\Generated\Vector3 $paramposition, \Nawarian\Raylib\Generated\Camera3D $paramcamera) : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWorldToScreen($paramposition->toCData(), $paramcamera->toCData()));
}

/**
 * Get size position for a 3d world space position
 */
 function GetWorldToScreenEx(\Nawarian\Raylib\Generated\Vector3 $paramposition, \Nawarian\Raylib\Generated\Camera3D $paramcamera, int $paramwidth, int $paramheight) : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWorldToScreenEx($paramposition->toCData(), $paramcamera->toCData(), $paramwidth, $paramheight));
}

/**
 * Get the screen space position for a 2d camera world space position
 */
 function GetWorldToScreen2D(\Nawarian\Raylib\Generated\Vector2 $paramposition, \Nawarian\Raylib\Generated\Camera2D $paramcamera) : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetWorldToScreen2D($paramposition->toCData(), $paramcamera->toCData()));
}

/**
 * Get the world space position for a 2d camera screen space position
 */
 function GetScreenToWorld2D(\Nawarian\Raylib\Generated\Vector2 $paramposition, \Nawarian\Raylib\Generated\Camera2D $paramcamera) : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetScreenToWorld2D($paramposition->toCData(), $paramcamera->toCData()));
}

/**
 * Set target FPS (maximum)
 */
 function SetTargetFPS(int $paramfps) : void
{
global $raylib;
$raylib->SetTargetFPS($paramfps);
}

/**
 * Get current FPS
 */
 function GetFPS() : int
{
global $raylib;
return $raylib->GetFPS();
}

/**
 * Get time in seconds for last frame drawn (delta time)
 */
 function GetFrameTime() : float
{
global $raylib;
return $raylib->GetFrameTime();
}

/**
 * Get elapsed time in seconds since InitWindow()
 */
 function GetTime() : float
{
global $raylib;
return $raylib->GetTime();
}

/**
 * Get a random value between min and max (both included)
 */
 function GetRandomValue(int $parammin, int $parammax) : int
{
global $raylib;
return $raylib->GetRandomValue($parammin, $parammax);
}

/**
 * Takes a screenshot of current screen (filename extension defines format)
 */
 function TakeScreenshot(string $paramfileName) : void
{
global $raylib;
$raylib->TakeScreenshot($paramfileName);
}

/**
 * Setup init configuration flags (view FLAGS)
 */
 function SetConfigFlags(int $paramflags) : void
{
global $raylib;
$raylib->SetConfigFlags($paramflags);
}

/**
 * Set the current threshold (minimum) log level
 */
 function SetTraceLogLevel(int $paramlogLevel) : void
{
global $raylib;
$raylib->SetTraceLogLevel($paramlogLevel);
}

/**
 * Internal memory allocator
 */
 function MemAlloc(int $paramsize) : \FFI\CData
{
global $raylib;
return $raylib->MemAlloc($paramsize);
}

/**
 * Internal memory reallocator
 */
 function MemRealloc(\FFI\CData $paramptr, int $paramsize) : \FFI\CData
{
global $raylib;
return $raylib->MemRealloc($paramptr, $paramsize);
}

/**
 * Internal memory free
 */
 function MemFree(\FFI\CData $paramptr) : void
{
global $raylib;
$raylib->MemFree($paramptr);
}

/**
 * Load file data as byte array (read)
 */
 function LoadFileData(string $paramfileName, array $parambytesRead) : array
{
global $raylib;
return $raylib->LoadFileData($paramfileName, $parambytesRead);
}

/**
 * Unload file data allocated by LoadFileData()
 */
 function UnloadFileData(array $paramdata) : void
{
global $raylib;
$raylib->UnloadFileData($paramdata);
}

/**
 * Save data to file from byte array (write), returns true on success
 */
 function SaveFileData(string $paramfileName, \FFI\CData $paramdata, int $parambytesToWrite) : bool
{
global $raylib;
return $raylib->SaveFileData($paramfileName, $paramdata, $parambytesToWrite);
}

/**
 * Load text data from file (read), returns a ' 0' terminated string
 */
 function LoadFileText(string $paramfileName) : string
{
global $raylib;
return $raylib->LoadFileText($paramfileName);
}

/**
 * Unload file text data allocated by LoadFileText()
 */
 function UnloadFileText(string $paramtext) : void
{
global $raylib;
$raylib->UnloadFileText($paramtext);
}

/**
 * Save text data to file (write), string must be ' 0' terminated, returns true on
 * success
 */
 function SaveFileText(string $paramfileName, string $paramtext) : bool
{
global $raylib;
return $raylib->SaveFileText($paramfileName, $paramtext);
}

/**
 * Check if file exists
 */
 function FileExists(string $paramfileName) : bool
{
global $raylib;
return $raylib->FileExists($paramfileName);
}

/**
 * Check if a directory path exists
 */
 function DirectoryExists(string $paramdirPath) : bool
{
global $raylib;
return $raylib->DirectoryExists($paramdirPath);
}

/**
 * Check file extension (including point: .png, .wav)
 */
 function IsFileExtension(string $paramfileName, string $paramext) : bool
{
global $raylib;
return $raylib->IsFileExtension($paramfileName, $paramext);
}

/**
 * Get pointer to extension for a filename string (includes dot: '.png')
 */
 function GetFileExtension(string $paramfileName) : string
{
global $raylib;
return $raylib->GetFileExtension($paramfileName);
}

/**
 * Get pointer to filename for a path string
 */
 function GetFileName(string $paramfilePath) : string
{
global $raylib;
return $raylib->GetFileName($paramfilePath);
}

/**
 * Get filename string without extension (uses static string)
 */
 function GetFileNameWithoutExt(string $paramfilePath) : string
{
global $raylib;
return $raylib->GetFileNameWithoutExt($paramfilePath);
}

/**
 * Get full path for a given fileName with path (uses static string)
 */
 function GetDirectoryPath(string $paramfilePath) : string
{
global $raylib;
return $raylib->GetDirectoryPath($paramfilePath);
}

/**
 * Get previous directory path for a given path (uses static string)
 */
 function GetPrevDirectoryPath(string $paramdirPath) : string
{
global $raylib;
return $raylib->GetPrevDirectoryPath($paramdirPath);
}

/**
 * Get current working directory (uses static string)
 */
 function GetWorkingDirectory() : string
{
global $raylib;
return $raylib->GetWorkingDirectory();
}

/**
 * Get filenames in a directory path (memory should be freed)
 */
 function GetDirectoryFiles(string $paramdirPath, array $paramcount) : array
{
global $raylib;
return $raylib->GetDirectoryFiles($paramdirPath, $paramcount);
}

/**
 * Clear directory files paths buffers (free memory)
 */
 function ClearDirectoryFiles() : void
{
global $raylib;
$raylib->ClearDirectoryFiles();
}

/**
 * Change working directory, return true on success
 */
 function ChangeDirectory(string $paramdir) : bool
{
global $raylib;
return $raylib->ChangeDirectory($paramdir);
}

/**
 * Check if a file has been dropped into window
 */
 function IsFileDropped() : bool
{
global $raylib;
return $raylib->IsFileDropped();
}

/**
 * Get dropped files names (memory should be freed)
 */
 function GetDroppedFiles(array $paramcount) : array
{
global $raylib;
return $raylib->GetDroppedFiles($paramcount);
}

/**
 * Clear dropped files paths buffer (free memory)
 */
 function ClearDroppedFiles() : void
{
global $raylib;
$raylib->ClearDroppedFiles();
}

/**
 * Get file modification time (last write time)
 */
 function GetFileModTime(string $paramfileName) : int
{
global $raylib;
return $raylib->GetFileModTime($paramfileName);
}

/**
 * Compress data (DEFLATE algorithm)
 */
 function CompressData(array $paramdata, int $paramdataLength, array $paramcompDataLength) : array
{
global $raylib;
return $raylib->CompressData($paramdata, $paramdataLength, $paramcompDataLength);
}

/**
 * Decompress data (DEFLATE algorithm)
 */
 function DecompressData(array $paramcompData, int $paramcompDataLength, array $paramdataLength) : array
{
global $raylib;
return $raylib->DecompressData($paramcompData, $paramcompDataLength, $paramdataLength);
}

/**
 * Save integer value to storage file (to defined position), returns true on
 * success
 */
 function SaveStorageValue(int $paramposition, int $paramvalue) : bool
{
global $raylib;
return $raylib->SaveStorageValue($paramposition, $paramvalue);
}

/**
 * Load integer value from storage file (from defined position)
 */
 function LoadStorageValue(int $paramposition) : int
{
global $raylib;
return $raylib->LoadStorageValue($paramposition);
}

/**
 * Open URL with default system browser (if available)
 */
 function OpenURL(string $paramurl) : void
{
global $raylib;
$raylib->OpenURL($paramurl);
}

/**
 * Check if a key has been pressed once
 */
 function IsKeyPressed(int $paramkey) : bool
{
global $raylib;
return $raylib->IsKeyPressed($paramkey);
}

/**
 * Check if a key is being pressed
 */
 function IsKeyDown(int $paramkey) : bool
{
global $raylib;
return $raylib->IsKeyDown($paramkey);
}

/**
 * Check if a key has been released once
 */
 function IsKeyReleased(int $paramkey) : bool
{
global $raylib;
return $raylib->IsKeyReleased($paramkey);
}

/**
 * Check if a key is NOT being pressed
 */
 function IsKeyUp(int $paramkey) : bool
{
global $raylib;
return $raylib->IsKeyUp($paramkey);
}

/**
 * Set a custom key to exit program (default is ESC)
 */
 function SetExitKey(int $paramkey) : void
{
global $raylib;
$raylib->SetExitKey($paramkey);
}

/**
 * Get key pressed (keycode), call it multiple times for keys queued
 */
 function GetKeyPressed() : int
{
global $raylib;
return $raylib->GetKeyPressed();
}

/**
 * Get char pressed (unicode), call it multiple times for chars queued
 */
 function GetCharPressed() : int
{
global $raylib;
return $raylib->GetCharPressed();
}

/**
 * Check if a gamepad is available
 */
 function IsGamepadAvailable(int $paramgamepad) : bool
{
global $raylib;
return $raylib->IsGamepadAvailable($paramgamepad);
}

/**
 * Check gamepad name (if available)
 */
 function IsGamepadName(int $paramgamepad, string $paramname) : bool
{
global $raylib;
return $raylib->IsGamepadName($paramgamepad, $paramname);
}

/**
 * Get gamepad internal name id
 */
 function GetGamepadName(int $paramgamepad) : string
{
global $raylib;
return $raylib->GetGamepadName($paramgamepad);
}

/**
 * Check if a gamepad button has been pressed once
 */
 function IsGamepadButtonPressed(int $paramgamepad, int $parambutton) : bool
{
global $raylib;
return $raylib->IsGamepadButtonPressed($paramgamepad, $parambutton);
}

/**
 * Check if a gamepad button is being pressed
 */
 function IsGamepadButtonDown(int $paramgamepad, int $parambutton) : bool
{
global $raylib;
return $raylib->IsGamepadButtonDown($paramgamepad, $parambutton);
}

/**
 * Check if a gamepad button has been released once
 */
 function IsGamepadButtonReleased(int $paramgamepad, int $parambutton) : bool
{
global $raylib;
return $raylib->IsGamepadButtonReleased($paramgamepad, $parambutton);
}

/**
 * Check if a gamepad button is NOT being pressed
 */
 function IsGamepadButtonUp(int $paramgamepad, int $parambutton) : bool
{
global $raylib;
return $raylib->IsGamepadButtonUp($paramgamepad, $parambutton);
}

/**
 * Get the last gamepad button pressed
 */
 function GetGamepadButtonPressed() : int
{
global $raylib;
return $raylib->GetGamepadButtonPressed();
}

/**
 * Get gamepad axis count for a gamepad
 */
 function GetGamepadAxisCount(int $paramgamepad) : int
{
global $raylib;
return $raylib->GetGamepadAxisCount($paramgamepad);
}

/**
 * Get axis movement value for a gamepad axis
 */
 function GetGamepadAxisMovement(int $paramgamepad, int $paramaxis) : float
{
global $raylib;
return $raylib->GetGamepadAxisMovement($paramgamepad, $paramaxis);
}

/**
 * Set internal gamepad mappings (SDL_GameControllerDB)
 */
 function SetGamepadMappings(string $parammappings) : int
{
global $raylib;
return $raylib->SetGamepadMappings($parammappings);
}

/**
 * Check if a mouse button has been pressed once
 */
 function IsMouseButtonPressed(int $parambutton) : bool
{
global $raylib;
return $raylib->IsMouseButtonPressed($parambutton);
}

/**
 * Check if a mouse button is being pressed
 */
 function IsMouseButtonDown(int $parambutton) : bool
{
global $raylib;
return $raylib->IsMouseButtonDown($parambutton);
}

/**
 * Check if a mouse button has been released once
 */
 function IsMouseButtonReleased(int $parambutton) : bool
{
global $raylib;
return $raylib->IsMouseButtonReleased($parambutton);
}

/**
 * Check if a mouse button is NOT being pressed
 */
 function IsMouseButtonUp(int $parambutton) : bool
{
global $raylib;
return $raylib->IsMouseButtonUp($parambutton);
}

/**
 * Get mouse position X
 */
 function GetMouseX() : int
{
global $raylib;
return $raylib->GetMouseX();
}

/**
 * Get mouse position Y
 */
 function GetMouseY() : int
{
global $raylib;
return $raylib->GetMouseY();
}

/**
 * Get mouse position XY
 */
 function GetMousePosition() : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetMousePosition());
}

/**
 * Set mouse position XY
 */
 function SetMousePosition(int $paramx, int $paramy) : void
{
global $raylib;
$raylib->SetMousePosition($paramx, $paramy);
}

/**
 * Set mouse offset
 */
 function SetMouseOffset(int $paramoffsetX, int $paramoffsetY) : void
{
global $raylib;
$raylib->SetMouseOffset($paramoffsetX, $paramoffsetY);
}

/**
 * Set mouse scaling
 */
 function SetMouseScale(float $paramscaleX, float $paramscaleY) : void
{
global $raylib;
$raylib->SetMouseScale($paramscaleX, $paramscaleY);
}

/**
 * Get mouse wheel movement Y
 */
 function GetMouseWheelMove() : float
{
global $raylib;
return $raylib->GetMouseWheelMove();
}

/**
 * Set mouse cursor
 */
 function SetMouseCursor(int $paramcursor) : void
{
global $raylib;
$raylib->SetMouseCursor($paramcursor);
}

/**
 * Get touch position X for touch point 0 (relative to screen size)
 */
 function GetTouchX() : int
{
global $raylib;
return $raylib->GetTouchX();
}

/**
 * Get touch position Y for touch point 0 (relative to screen size)
 */
 function GetTouchY() : int
{
global $raylib;
return $raylib->GetTouchY();
}

/**
 * Get touch position XY for a touch point index (relative to screen size)
 */
 function GetTouchPosition(int $paramindex) : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetTouchPosition($paramindex));
}

/**
 * Enable a set of gestures using flags
 */
 function SetGesturesEnabled(int $paramflags) : void
{
global $raylib;
$raylib->SetGesturesEnabled($paramflags);
}

/**
 * Check if a gesture have been detected
 */
 function IsGestureDetected(int $paramgesture) : bool
{
global $raylib;
return $raylib->IsGestureDetected($paramgesture);
}

/**
 * Get latest detected gesture
 */
 function GetGestureDetected() : int
{
global $raylib;
return $raylib->GetGestureDetected();
}

/**
 * Get touch points count
 */
 function GetTouchPointsCount() : int
{
global $raylib;
return $raylib->GetTouchPointsCount();
}

/**
 * Get gesture hold time in milliseconds
 */
 function GetGestureHoldDuration() : float
{
global $raylib;
return $raylib->GetGestureHoldDuration();
}

/**
 * Get gesture drag vector
 */
 function GetGestureDragVector() : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetGestureDragVector());
}

/**
 * Get gesture drag angle
 */
 function GetGestureDragAngle() : float
{
global $raylib;
return $raylib->GetGestureDragAngle();
}

/**
 * Get gesture pinch delta
 */
 function GetGesturePinchVector() : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->GetGesturePinchVector());
}

/**
 * Get gesture pinch angle
 */
 function GetGesturePinchAngle() : float
{
global $raylib;
return $raylib->GetGesturePinchAngle();
}

/**
 * Set camera mode (multiple camera modes available)
 */
 function SetCameraMode(\Nawarian\Raylib\Generated\Camera3D $paramcamera, int $parammode) : void
{
global $raylib;
$raylib->SetCameraMode($paramcamera->toCData(), $parammode);
}

/**
 * Update camera position for selected mode
 */
 function UpdateCamera(\Nawarian\Raylib\Generated\Camera3D $paramcamera) : void
{
global $raylib;
$raylib->UpdateCamera($paramcamera->toCData());
}

/**
 * Set camera pan key to combine with mouse movement (free camera)
 */
 function SetCameraPanControl(int $paramkeyPan) : void
{
global $raylib;
$raylib->SetCameraPanControl($paramkeyPan);
}

/**
 * Set camera alt key to combine with mouse movement (free camera)
 */
 function SetCameraAltControl(int $paramkeyAlt) : void
{
global $raylib;
$raylib->SetCameraAltControl($paramkeyAlt);
}

/**
 * Set camera smooth zoom key to combine with mouse (free camera)
 */
 function SetCameraSmoothZoomControl(int $paramkeySmoothZoom) : void
{
global $raylib;
$raylib->SetCameraSmoothZoomControl($paramkeySmoothZoom);
}

/**
 * Set camera move controls (1st person and 3rd person cameras)
 */
 function SetCameraMoveControls(int $paramkeyFront, int $paramkeyBack, int $paramkeyRight, int $paramkeyLeft, int $paramkeyUp, int $paramkeyDown) : void
{
global $raylib;
$raylib->SetCameraMoveControls($paramkeyFront, $paramkeyBack, $paramkeyRight, $paramkeyLeft, $paramkeyUp, $paramkeyDown);
}

/**
 * Set texture and rectangle to be used on shapes drawing
 */
 function SetShapesTexture(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Rectangle $paramsource) : void
{
global $raylib;
$raylib->SetShapesTexture($paramtexture->toCData(), $paramsource->toCData());
}

/**
 * Draw a pixel
 */
 function DrawPixel(int $paramposX, int $paramposY, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawPixel($paramposX, $paramposY, $paramcolor->toCData());
}

/**
 * Draw a pixel (Vector version)
 */
 function DrawPixelV(\Nawarian\Raylib\Generated\Vector2 $paramposition, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawPixelV($paramposition->toCData(), $paramcolor->toCData());
}

/**
 * Draw a line
 */
 function DrawLine(int $paramstartPosX, int $paramstartPosY, int $paramendPosX, int $paramendPosY, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawLine($paramstartPosX, $paramstartPosY, $paramendPosX, $paramendPosY, $paramcolor->toCData());
}

/**
 * Draw a line (Vector version)
 */
 function DrawLineV(\Nawarian\Raylib\Generated\Vector2 $paramstartPos, \Nawarian\Raylib\Generated\Vector2 $paramendPos, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawLineV($paramstartPos->toCData(), $paramendPos->toCData(), $paramcolor->toCData());
}

/**
 * Draw a line defining thickness
 */
 function DrawLineEx(\Nawarian\Raylib\Generated\Vector2 $paramstartPos, \Nawarian\Raylib\Generated\Vector2 $paramendPos, float $paramthick, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawLineEx($paramstartPos->toCData(), $paramendPos->toCData(), $paramthick, $paramcolor->toCData());
}

/**
 * Draw a line using cubic-bezier curves in-out
 */
 function DrawLineBezier(\Nawarian\Raylib\Generated\Vector2 $paramstartPos, \Nawarian\Raylib\Generated\Vector2 $paramendPos, float $paramthick, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawLineBezier($paramstartPos->toCData(), $paramendPos->toCData(), $paramthick, $paramcolor->toCData());
}

/**
 * raw line using quadratic bezier curves with a control point
 */
 function DrawLineBezierQuad(\Nawarian\Raylib\Generated\Vector2 $paramstartPos, \Nawarian\Raylib\Generated\Vector2 $paramendPos, \Nawarian\Raylib\Generated\Vector2 $paramcontrolPos, float $paramthick, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawLineBezierQuad($paramstartPos->toCData(), $paramendPos->toCData(), $paramcontrolPos->toCData(), $paramthick, $paramcolor->toCData());
}

/**
 * Draw lines sequence
 */
 function DrawLineStrip(\Nawarian\Raylib\Generated\Vector2 $parampoints, int $parampointsCount, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawLineStrip($parampoints->toCData(), $parampointsCount, $paramcolor->toCData());
}

/**
 * Draw a color-filled circle
 */
 function DrawCircle(int $paramcenterX, int $paramcenterY, float $paramradius, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCircle($paramcenterX, $paramcenterY, $paramradius, $paramcolor->toCData());
}

/**
 * Draw a piece of a circle
 */
 function DrawCircleSector(\Nawarian\Raylib\Generated\Vector2 $paramcenter, float $paramradius, float $paramstartAngle, float $paramendAngle, int $paramsegments, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCircleSector($paramcenter->toCData(), $paramradius, $paramstartAngle, $paramendAngle, $paramsegments, $paramcolor->toCData());
}

/**
 * Draw circle sector outline
 */
 function DrawCircleSectorLines(\Nawarian\Raylib\Generated\Vector2 $paramcenter, float $paramradius, float $paramstartAngle, float $paramendAngle, int $paramsegments, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCircleSectorLines($paramcenter->toCData(), $paramradius, $paramstartAngle, $paramendAngle, $paramsegments, $paramcolor->toCData());
}

/**
 * Draw a gradient-filled circle
 */
 function DrawCircleGradient(int $paramcenterX, int $paramcenterY, float $paramradius, \Nawarian\Raylib\Generated\Color $paramcolor1, \Nawarian\Raylib\Generated\Color $paramcolor2) : void
{
global $raylib;
$raylib->DrawCircleGradient($paramcenterX, $paramcenterY, $paramradius, $paramcolor1->toCData(), $paramcolor2->toCData());
}

/**
 * Draw a color-filled circle (Vector version)
 */
 function DrawCircleV(\Nawarian\Raylib\Generated\Vector2 $paramcenter, float $paramradius, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCircleV($paramcenter->toCData(), $paramradius, $paramcolor->toCData());
}

/**
 * Draw circle outline
 */
 function DrawCircleLines(int $paramcenterX, int $paramcenterY, float $paramradius, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCircleLines($paramcenterX, $paramcenterY, $paramradius, $paramcolor->toCData());
}

/**
 * Draw ellipse
 */
 function DrawEllipse(int $paramcenterX, int $paramcenterY, float $paramradiusH, float $paramradiusV, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawEllipse($paramcenterX, $paramcenterY, $paramradiusH, $paramradiusV, $paramcolor->toCData());
}

/**
 * Draw ellipse outline
 */
 function DrawEllipseLines(int $paramcenterX, int $paramcenterY, float $paramradiusH, float $paramradiusV, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawEllipseLines($paramcenterX, $paramcenterY, $paramradiusH, $paramradiusV, $paramcolor->toCData());
}

/**
 * Draw ring
 */
 function DrawRing(\Nawarian\Raylib\Generated\Vector2 $paramcenter, float $paraminnerRadius, float $paramouterRadius, float $paramstartAngle, float $paramendAngle, int $paramsegments, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRing($paramcenter->toCData(), $paraminnerRadius, $paramouterRadius, $paramstartAngle, $paramendAngle, $paramsegments, $paramcolor->toCData());
}

/**
 * Draw ring outline
 */
 function DrawRingLines(\Nawarian\Raylib\Generated\Vector2 $paramcenter, float $paraminnerRadius, float $paramouterRadius, float $paramstartAngle, float $paramendAngle, int $paramsegments, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRingLines($paramcenter->toCData(), $paraminnerRadius, $paramouterRadius, $paramstartAngle, $paramendAngle, $paramsegments, $paramcolor->toCData());
}

/**
 * Draw a color-filled rectangle
 */
 function DrawRectangle(int $paramposX, int $paramposY, int $paramwidth, int $paramheight, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRectangle($paramposX, $paramposY, $paramwidth, $paramheight, $paramcolor->toCData());
}

/**
 * Draw a color-filled rectangle (Vector version)
 */
 function DrawRectangleV(\Nawarian\Raylib\Generated\Vector2 $paramposition, \Nawarian\Raylib\Generated\Vector2 $paramsize, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRectangleV($paramposition->toCData(), $paramsize->toCData(), $paramcolor->toCData());
}

/**
 * Draw a color-filled rectangle
 */
 function DrawRectangleRec(\Nawarian\Raylib\Generated\Rectangle $paramrec, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRectangleRec($paramrec->toCData(), $paramcolor->toCData());
}

/**
 * Draw a color-filled rectangle with pro parameters
 */
 function DrawRectanglePro(\Nawarian\Raylib\Generated\Rectangle $paramrec, \Nawarian\Raylib\Generated\Vector2 $paramorigin, float $paramrotation, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRectanglePro($paramrec->toCData(), $paramorigin->toCData(), $paramrotation, $paramcolor->toCData());
}

/**
 * Draw a vertical-gradient-filled rectangle
 */
 function DrawRectangleGradientV(int $paramposX, int $paramposY, int $paramwidth, int $paramheight, \Nawarian\Raylib\Generated\Color $paramcolor1, \Nawarian\Raylib\Generated\Color $paramcolor2) : void
{
global $raylib;
$raylib->DrawRectangleGradientV($paramposX, $paramposY, $paramwidth, $paramheight, $paramcolor1->toCData(), $paramcolor2->toCData());
}

/**
 * Draw a horizontal-gradient-filled rectangle
 */
 function DrawRectangleGradientH(int $paramposX, int $paramposY, int $paramwidth, int $paramheight, \Nawarian\Raylib\Generated\Color $paramcolor1, \Nawarian\Raylib\Generated\Color $paramcolor2) : void
{
global $raylib;
$raylib->DrawRectangleGradientH($paramposX, $paramposY, $paramwidth, $paramheight, $paramcolor1->toCData(), $paramcolor2->toCData());
}

/**
 * Draw a gradient-filled rectangle with custom vertex colors
 */
 function DrawRectangleGradientEx(\Nawarian\Raylib\Generated\Rectangle $paramrec, \Nawarian\Raylib\Generated\Color $paramcol1, \Nawarian\Raylib\Generated\Color $paramcol2, \Nawarian\Raylib\Generated\Color $paramcol3, \Nawarian\Raylib\Generated\Color $paramcol4) : void
{
global $raylib;
$raylib->DrawRectangleGradientEx($paramrec->toCData(), $paramcol1->toCData(), $paramcol2->toCData(), $paramcol3->toCData(), $paramcol4->toCData());
}

/**
 * Draw rectangle outline
 */
 function DrawRectangleLines(int $paramposX, int $paramposY, int $paramwidth, int $paramheight, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRectangleLines($paramposX, $paramposY, $paramwidth, $paramheight, $paramcolor->toCData());
}

/**
 * Draw rectangle outline with extended parameters
 */
 function DrawRectangleLinesEx(\Nawarian\Raylib\Generated\Rectangle $paramrec, float $paramlineThick, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRectangleLinesEx($paramrec->toCData(), $paramlineThick, $paramcolor->toCData());
}

/**
 * Draw rectangle with rounded edges
 */
 function DrawRectangleRounded(\Nawarian\Raylib\Generated\Rectangle $paramrec, float $paramroundness, int $paramsegments, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRectangleRounded($paramrec->toCData(), $paramroundness, $paramsegments, $paramcolor->toCData());
}

/**
 * Draw rectangle with rounded edges outline
 */
 function DrawRectangleRoundedLines(\Nawarian\Raylib\Generated\Rectangle $paramrec, float $paramroundness, int $paramsegments, float $paramlineThick, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRectangleRoundedLines($paramrec->toCData(), $paramroundness, $paramsegments, $paramlineThick, $paramcolor->toCData());
}

/**
 * Draw a color-filled triangle (vertex in counter-clockwise order!)
 */
 function DrawTriangle(\Nawarian\Raylib\Generated\Vector2 $paramv1, \Nawarian\Raylib\Generated\Vector2 $paramv2, \Nawarian\Raylib\Generated\Vector2 $paramv3, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawTriangle($paramv1->toCData(), $paramv2->toCData(), $paramv3->toCData(), $paramcolor->toCData());
}

/**
 * Draw triangle outline (vertex in counter-clockwise order!)
 */
 function DrawTriangleLines(\Nawarian\Raylib\Generated\Vector2 $paramv1, \Nawarian\Raylib\Generated\Vector2 $paramv2, \Nawarian\Raylib\Generated\Vector2 $paramv3, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawTriangleLines($paramv1->toCData(), $paramv2->toCData(), $paramv3->toCData(), $paramcolor->toCData());
}

/**
 * Draw a triangle fan defined by points (first vertex is the center)
 */
 function DrawTriangleFan(\Nawarian\Raylib\Generated\Vector2 $parampoints, int $parampointsCount, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawTriangleFan($parampoints->toCData(), $parampointsCount, $paramcolor->toCData());
}

/**
 * Draw a triangle strip defined by points
 */
 function DrawTriangleStrip(\Nawarian\Raylib\Generated\Vector2 $parampoints, int $parampointsCount, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawTriangleStrip($parampoints->toCData(), $parampointsCount, $paramcolor->toCData());
}

/**
 * Draw a regular polygon (Vector version)
 */
 function DrawPoly(\Nawarian\Raylib\Generated\Vector2 $paramcenter, int $paramsides, float $paramradius, float $paramrotation, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawPoly($paramcenter->toCData(), $paramsides, $paramradius, $paramrotation, $paramcolor->toCData());
}

/**
 * Draw a polygon outline of n sides
 */
 function DrawPolyLines(\Nawarian\Raylib\Generated\Vector2 $paramcenter, int $paramsides, float $paramradius, float $paramrotation, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawPolyLines($paramcenter->toCData(), $paramsides, $paramradius, $paramrotation, $paramcolor->toCData());
}

/**
 * Draw a polygon outline of n sides with extended parameters
 */
 function DrawPolyLinesEx(\Nawarian\Raylib\Generated\Vector2 $paramcenter, int $paramsides, float $paramradius, float $paramrotation, float $paramlineThick, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawPolyLinesEx($paramcenter->toCData(), $paramsides, $paramradius, $paramrotation, $paramlineThick, $paramcolor->toCData());
}

/**
 * Check collision between two rectangles
 */
 function CheckCollisionRecs(\Nawarian\Raylib\Generated\Rectangle $paramrec1, \Nawarian\Raylib\Generated\Rectangle $paramrec2) : bool
{
global $raylib;
return $raylib->CheckCollisionRecs($paramrec1->toCData(), $paramrec2->toCData());
}

/**
 * Check collision between two circles
 */
 function CheckCollisionCircles(\Nawarian\Raylib\Generated\Vector2 $paramcenter1, float $paramradius1, \Nawarian\Raylib\Generated\Vector2 $paramcenter2, float $paramradius2) : bool
{
global $raylib;
return $raylib->CheckCollisionCircles($paramcenter1->toCData(), $paramradius1, $paramcenter2->toCData(), $paramradius2);
}

/**
 * Check collision between circle and rectangle
 */
 function CheckCollisionCircleRec(\Nawarian\Raylib\Generated\Vector2 $paramcenter, float $paramradius, \Nawarian\Raylib\Generated\Rectangle $paramrec) : bool
{
global $raylib;
return $raylib->CheckCollisionCircleRec($paramcenter->toCData(), $paramradius, $paramrec->toCData());
}

/**
 * Check if point is inside rectangle
 */
 function CheckCollisionPointRec(\Nawarian\Raylib\Generated\Vector2 $parampoint, \Nawarian\Raylib\Generated\Rectangle $paramrec) : bool
{
global $raylib;
return $raylib->CheckCollisionPointRec($parampoint->toCData(), $paramrec->toCData());
}

/**
 * Check if point is inside circle
 */
 function CheckCollisionPointCircle(\Nawarian\Raylib\Generated\Vector2 $parampoint, \Nawarian\Raylib\Generated\Vector2 $paramcenter, float $paramradius) : bool
{
global $raylib;
return $raylib->CheckCollisionPointCircle($parampoint->toCData(), $paramcenter->toCData(), $paramradius);
}

/**
 * Check if point is inside a triangle
 */
 function CheckCollisionPointTriangle(\Nawarian\Raylib\Generated\Vector2 $parampoint, \Nawarian\Raylib\Generated\Vector2 $paramp1, \Nawarian\Raylib\Generated\Vector2 $paramp2, \Nawarian\Raylib\Generated\Vector2 $paramp3) : bool
{
global $raylib;
return $raylib->CheckCollisionPointTriangle($parampoint->toCData(), $paramp1->toCData(), $paramp2->toCData(), $paramp3->toCData());
}

/**
 * Check the collision between two lines defined by two points each, returns
 * collision point by reference
 */
 function CheckCollisionLines(\Nawarian\Raylib\Generated\Vector2 $paramstartPos1, \Nawarian\Raylib\Generated\Vector2 $paramendPos1, \Nawarian\Raylib\Generated\Vector2 $paramstartPos2, \Nawarian\Raylib\Generated\Vector2 $paramendPos2, \Nawarian\Raylib\Generated\Vector2 $paramcollisionPoint) : bool
{
global $raylib;
return $raylib->CheckCollisionLines($paramstartPos1->toCData(), $paramendPos1->toCData(), $paramstartPos2->toCData(), $paramendPos2->toCData(), $paramcollisionPoint->toCData());
}

/**
 * Get collision rectangle for two rectangles collision
 */
 function GetCollisionRec(\Nawarian\Raylib\Generated\Rectangle $paramrec1, \Nawarian\Raylib\Generated\Rectangle $paramrec2) : \Nawarian\Raylib\Generated\Rectangle
{
global $raylib;
return \Nawarian\Raylib\Generated\Rectangle::fromCData($raylib->GetCollisionRec($paramrec1->toCData(), $paramrec2->toCData()));
}

/**
 * Load image from file into CPU memory (RAM)
 */
 function LoadImage(string $paramfileName) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->LoadImage($paramfileName));
}

/**
 * Load image from RAW file data
 */
 function LoadImageRaw(string $paramfileName, int $paramwidth, int $paramheight, int $paramformat, int $paramheaderSize) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->LoadImageRaw($paramfileName, $paramwidth, $paramheight, $paramformat, $paramheaderSize));
}

/**
 * Load image sequence from file (frames appended to image.data)
 */
 function LoadImageAnim(string $paramfileName, array $paramframes) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->LoadImageAnim($paramfileName, $paramframes));
}

/**
 * Load image from memory buffer, fileType refers to extension: i.e. '.png'
 */
 function LoadImageFromMemory(string $paramfileType, array $paramfileData, int $paramdataSize) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->LoadImageFromMemory($paramfileType, $paramfileData, $paramdataSize));
}

/**
 * Unload image from CPU memory (RAM)
 */
 function UnloadImage(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->UnloadImage($paramimage->toCData());
}

/**
 * Export image data to file, returns true on success
 */
 function ExportImage(\Nawarian\Raylib\Generated\Image $paramimage, string $paramfileName) : bool
{
global $raylib;
return $raylib->ExportImage($paramimage->toCData(), $paramfileName);
}

/**
 * Export image as code file defining an array of bytes, returns true on success
 */
 function ExportImageAsCode(\Nawarian\Raylib\Generated\Image $paramimage, string $paramfileName) : bool
{
global $raylib;
return $raylib->ExportImageAsCode($paramimage->toCData(), $paramfileName);
}

/**
 * Generate image: plain color
 */
 function GenImageColor(int $paramwidth, int $paramheight, \Nawarian\Raylib\Generated\Color $paramcolor) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageColor($paramwidth, $paramheight, $paramcolor->toCData()));
}

/**
 * Generate image: vertical gradient
 */
 function GenImageGradientV(int $paramwidth, int $paramheight, \Nawarian\Raylib\Generated\Color $paramtop, \Nawarian\Raylib\Generated\Color $parambottom) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageGradientV($paramwidth, $paramheight, $paramtop->toCData(), $parambottom->toCData()));
}

/**
 * Generate image: horizontal gradient
 */
 function GenImageGradientH(int $paramwidth, int $paramheight, \Nawarian\Raylib\Generated\Color $paramleft, \Nawarian\Raylib\Generated\Color $paramright) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageGradientH($paramwidth, $paramheight, $paramleft->toCData(), $paramright->toCData()));
}

/**
 * Generate image: radial gradient
 */
 function GenImageGradientRadial(int $paramwidth, int $paramheight, float $paramdensity, \Nawarian\Raylib\Generated\Color $paraminner, \Nawarian\Raylib\Generated\Color $paramouter) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageGradientRadial($paramwidth, $paramheight, $paramdensity, $paraminner->toCData(), $paramouter->toCData()));
}

/**
 * Generate image: checked
 */
 function GenImageChecked(int $paramwidth, int $paramheight, int $paramchecksX, int $paramchecksY, \Nawarian\Raylib\Generated\Color $paramcol1, \Nawarian\Raylib\Generated\Color $paramcol2) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageChecked($paramwidth, $paramheight, $paramchecksX, $paramchecksY, $paramcol1->toCData(), $paramcol2->toCData()));
}

/**
 * Generate image: white noise
 */
 function GenImageWhiteNoise(int $paramwidth, int $paramheight, float $paramfactor) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageWhiteNoise($paramwidth, $paramheight, $paramfactor));
}

/**
 * Generate image: perlin noise
 */
 function GenImagePerlinNoise(int $paramwidth, int $paramheight, int $paramoffsetX, int $paramoffsetY, float $paramscale) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImagePerlinNoise($paramwidth, $paramheight, $paramoffsetX, $paramoffsetY, $paramscale));
}

/**
 * Generate image: cellular algorithm. Bigger tileSize means bigger cells
 */
 function GenImageCellular(int $paramwidth, int $paramheight, int $paramtileSize) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageCellular($paramwidth, $paramheight, $paramtileSize));
}

/**
 * Create an image duplicate (useful for transformations)
 */
 function ImageCopy(\Nawarian\Raylib\Generated\Image $paramimage) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->ImageCopy($paramimage->toCData()));
}

/**
 * Create an image from another image piece
 */
 function ImageFromImage(\Nawarian\Raylib\Generated\Image $paramimage, \Nawarian\Raylib\Generated\Rectangle $paramrec) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->ImageFromImage($paramimage->toCData(), $paramrec->toCData()));
}

/**
 * Create an image from text (default font)
 */
 function ImageText(string $paramtext, int $paramfontSize, \Nawarian\Raylib\Generated\Color $paramcolor) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->ImageText($paramtext, $paramfontSize, $paramcolor->toCData()));
}

/**
 * Create an image from text (custom sprite font)
 */
 function ImageTextEx(\Nawarian\Raylib\Generated\Font $paramfont, string $paramtext, float $paramfontSize, float $paramspacing, \Nawarian\Raylib\Generated\Color $paramtint) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->ImageTextEx($paramfont->toCData(), $paramtext, $paramfontSize, $paramspacing, $paramtint->toCData()));
}

/**
 * Convert image data to desired format
 */
 function ImageFormat(\Nawarian\Raylib\Generated\Image $paramimage, int $paramnewFormat) : void
{
global $raylib;
$raylib->ImageFormat($paramimage->toCData(), $paramnewFormat);
}

/**
 * Convert image to POT (power-of-two)
 */
 function ImageToPOT(\Nawarian\Raylib\Generated\Image $paramimage, \Nawarian\Raylib\Generated\Color $paramfill) : void
{
global $raylib;
$raylib->ImageToPOT($paramimage->toCData(), $paramfill->toCData());
}

/**
 * Crop an image to a defined rectangle
 */
 function ImageCrop(\Nawarian\Raylib\Generated\Image $paramimage, \Nawarian\Raylib\Generated\Rectangle $paramcrop) : void
{
global $raylib;
$raylib->ImageCrop($paramimage->toCData(), $paramcrop->toCData());
}

/**
 * Crop image depending on alpha value
 */
 function ImageAlphaCrop(\Nawarian\Raylib\Generated\Image $paramimage, float $paramthreshold) : void
{
global $raylib;
$raylib->ImageAlphaCrop($paramimage->toCData(), $paramthreshold);
}

/**
 * Clear alpha channel to desired color
 */
 function ImageAlphaClear(\Nawarian\Raylib\Generated\Image $paramimage, \Nawarian\Raylib\Generated\Color $paramcolor, float $paramthreshold) : void
{
global $raylib;
$raylib->ImageAlphaClear($paramimage->toCData(), $paramcolor->toCData(), $paramthreshold);
}

/**
 * Apply alpha mask to image
 */
 function ImageAlphaMask(\Nawarian\Raylib\Generated\Image $paramimage, \Nawarian\Raylib\Generated\Image $paramalphaMask) : void
{
global $raylib;
$raylib->ImageAlphaMask($paramimage->toCData(), $paramalphaMask->toCData());
}

/**
 * Premultiply alpha channel
 */
 function ImageAlphaPremultiply(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->ImageAlphaPremultiply($paramimage->toCData());
}

/**
 * Resize image (Bicubic scaling algorithm)
 */
 function ImageResize(\Nawarian\Raylib\Generated\Image $paramimage, int $paramnewWidth, int $paramnewHeight) : void
{
global $raylib;
$raylib->ImageResize($paramimage->toCData(), $paramnewWidth, $paramnewHeight);
}

/**
 * Resize image (Nearest-Neighbor scaling algorithm)
 */
 function ImageResizeNN(\Nawarian\Raylib\Generated\Image $paramimage, int $paramnewWidth, int $paramnewHeight) : void
{
global $raylib;
$raylib->ImageResizeNN($paramimage->toCData(), $paramnewWidth, $paramnewHeight);
}

/**
 * Resize canvas and fill with color
 */
 function ImageResizeCanvas(\Nawarian\Raylib\Generated\Image $paramimage, int $paramnewWidth, int $paramnewHeight, int $paramoffsetX, int $paramoffsetY, \Nawarian\Raylib\Generated\Color $paramfill) : void
{
global $raylib;
$raylib->ImageResizeCanvas($paramimage->toCData(), $paramnewWidth, $paramnewHeight, $paramoffsetX, $paramoffsetY, $paramfill->toCData());
}

/**
 * Compute all mipmap levels for a provided image
 */
 function ImageMipmaps(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->ImageMipmaps($paramimage->toCData());
}

/**
 * Dither image data to 16bpp or lower (Floyd-Steinberg dithering)
 */
 function ImageDither(\Nawarian\Raylib\Generated\Image $paramimage, int $paramrBpp, int $paramgBpp, int $parambBpp, int $paramaBpp) : void
{
global $raylib;
$raylib->ImageDither($paramimage->toCData(), $paramrBpp, $paramgBpp, $parambBpp, $paramaBpp);
}

/**
 * Flip image vertically
 */
 function ImageFlipVertical(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->ImageFlipVertical($paramimage->toCData());
}

/**
 * Flip image horizontally
 */
 function ImageFlipHorizontal(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->ImageFlipHorizontal($paramimage->toCData());
}

/**
 * Rotate image clockwise 90deg
 */
 function ImageRotateCW(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->ImageRotateCW($paramimage->toCData());
}

/**
 * Rotate image counter-clockwise 90deg
 */
 function ImageRotateCCW(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->ImageRotateCCW($paramimage->toCData());
}

/**
 * Modify image color: tint
 */
 function ImageColorTint(\Nawarian\Raylib\Generated\Image $paramimage, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageColorTint($paramimage->toCData(), $paramcolor->toCData());
}

/**
 * Modify image color: invert
 */
 function ImageColorInvert(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->ImageColorInvert($paramimage->toCData());
}

/**
 * Modify image color: grayscale
 */
 function ImageColorGrayscale(\Nawarian\Raylib\Generated\Image $paramimage) : void
{
global $raylib;
$raylib->ImageColorGrayscale($paramimage->toCData());
}

/**
 * Modify image color: contrast (-100 to 100)
 */
 function ImageColorContrast(\Nawarian\Raylib\Generated\Image $paramimage, float $paramcontrast) : void
{
global $raylib;
$raylib->ImageColorContrast($paramimage->toCData(), $paramcontrast);
}

/**
 * Modify image color: brightness (-255 to 255)
 */
 function ImageColorBrightness(\Nawarian\Raylib\Generated\Image $paramimage, int $parambrightness) : void
{
global $raylib;
$raylib->ImageColorBrightness($paramimage->toCData(), $parambrightness);
}

/**
 * Modify image color: replace color
 */
 function ImageColorReplace(\Nawarian\Raylib\Generated\Image $paramimage, \Nawarian\Raylib\Generated\Color $paramcolor, \Nawarian\Raylib\Generated\Color $paramreplace) : void
{
global $raylib;
$raylib->ImageColorReplace($paramimage->toCData(), $paramcolor->toCData(), $paramreplace->toCData());
}

/**
 * Load color data from image as a Color array (RGBA - 32bit)
 */
 function LoadImageColors(\Nawarian\Raylib\Generated\Image $paramimage) : \Nawarian\Raylib\Generated\Color
{
global $raylib;
return \Nawarian\Raylib\Generated\Color::fromCData($raylib->LoadImageColors($paramimage->toCData()));
}

/**
 * Load colors palette from image as a Color array (RGBA - 32bit)
 */
 function LoadImagePalette(\Nawarian\Raylib\Generated\Image $paramimage, int $parammaxPaletteSize, array $paramcolorsCount) : \Nawarian\Raylib\Generated\Color
{
global $raylib;
return \Nawarian\Raylib\Generated\Color::fromCData($raylib->LoadImagePalette($paramimage->toCData(), $parammaxPaletteSize, $paramcolorsCount));
}

/**
 * Unload color data loaded with LoadImageColors()
 */
 function UnloadImageColors(\Nawarian\Raylib\Generated\Color $paramcolors) : void
{
global $raylib;
$raylib->UnloadImageColors($paramcolors->toCData());
}

/**
 * Unload colors palette loaded with LoadImagePalette()
 */
 function UnloadImagePalette(\Nawarian\Raylib\Generated\Color $paramcolors) : void
{
global $raylib;
$raylib->UnloadImagePalette($paramcolors->toCData());
}

/**
 * Get image alpha border rectangle
 */
 function GetImageAlphaBorder(\Nawarian\Raylib\Generated\Image $paramimage, float $paramthreshold) : \Nawarian\Raylib\Generated\Rectangle
{
global $raylib;
return \Nawarian\Raylib\Generated\Rectangle::fromCData($raylib->GetImageAlphaBorder($paramimage->toCData(), $paramthreshold));
}

/**
 * Clear image background with given color
 */
 function ImageClearBackground(\Nawarian\Raylib\Generated\Image $paramdst, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageClearBackground($paramdst->toCData(), $paramcolor->toCData());
}

/**
 * Draw pixel within an image
 */
 function ImageDrawPixel(\Nawarian\Raylib\Generated\Image $paramdst, int $paramposX, int $paramposY, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawPixel($paramdst->toCData(), $paramposX, $paramposY, $paramcolor->toCData());
}

/**
 * Draw pixel within an image (Vector version)
 */
 function ImageDrawPixelV(\Nawarian\Raylib\Generated\Image $paramdst, \Nawarian\Raylib\Generated\Vector2 $paramposition, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawPixelV($paramdst->toCData(), $paramposition->toCData(), $paramcolor->toCData());
}

/**
 * Draw line within an image
 */
 function ImageDrawLine(\Nawarian\Raylib\Generated\Image $paramdst, int $paramstartPosX, int $paramstartPosY, int $paramendPosX, int $paramendPosY, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawLine($paramdst->toCData(), $paramstartPosX, $paramstartPosY, $paramendPosX, $paramendPosY, $paramcolor->toCData());
}

/**
 * Draw line within an image (Vector version)
 */
 function ImageDrawLineV(\Nawarian\Raylib\Generated\Image $paramdst, \Nawarian\Raylib\Generated\Vector2 $paramstart, \Nawarian\Raylib\Generated\Vector2 $paramend, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawLineV($paramdst->toCData(), $paramstart->toCData(), $paramend->toCData(), $paramcolor->toCData());
}

/**
 * Draw circle within an image
 */
 function ImageDrawCircle(\Nawarian\Raylib\Generated\Image $paramdst, int $paramcenterX, int $paramcenterY, int $paramradius, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawCircle($paramdst->toCData(), $paramcenterX, $paramcenterY, $paramradius, $paramcolor->toCData());
}

/**
 * Draw circle within an image (Vector version)
 */
 function ImageDrawCircleV(\Nawarian\Raylib\Generated\Image $paramdst, \Nawarian\Raylib\Generated\Vector2 $paramcenter, int $paramradius, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawCircleV($paramdst->toCData(), $paramcenter->toCData(), $paramradius, $paramcolor->toCData());
}

/**
 * Draw rectangle within an image
 */
 function ImageDrawRectangle(\Nawarian\Raylib\Generated\Image $paramdst, int $paramposX, int $paramposY, int $paramwidth, int $paramheight, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawRectangle($paramdst->toCData(), $paramposX, $paramposY, $paramwidth, $paramheight, $paramcolor->toCData());
}

/**
 * Draw rectangle within an image (Vector version)
 */
 function ImageDrawRectangleV(\Nawarian\Raylib\Generated\Image $paramdst, \Nawarian\Raylib\Generated\Vector2 $paramposition, \Nawarian\Raylib\Generated\Vector2 $paramsize, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawRectangleV($paramdst->toCData(), $paramposition->toCData(), $paramsize->toCData(), $paramcolor->toCData());
}

/**
 * Draw rectangle within an image
 */
 function ImageDrawRectangleRec(\Nawarian\Raylib\Generated\Image $paramdst, \Nawarian\Raylib\Generated\Rectangle $paramrec, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawRectangleRec($paramdst->toCData(), $paramrec->toCData(), $paramcolor->toCData());
}

/**
 * Draw rectangle lines within an image
 */
 function ImageDrawRectangleLines(\Nawarian\Raylib\Generated\Image $paramdst, \Nawarian\Raylib\Generated\Rectangle $paramrec, int $paramthick, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawRectangleLines($paramdst->toCData(), $paramrec->toCData(), $paramthick, $paramcolor->toCData());
}

/**
 * Draw a source image within a destination image (tint applied to source)
 */
 function ImageDraw(\Nawarian\Raylib\Generated\Image $paramdst, \Nawarian\Raylib\Generated\Image $paramsrc, \Nawarian\Raylib\Generated\Rectangle $paramsrcRec, \Nawarian\Raylib\Generated\Rectangle $paramdstRec, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->ImageDraw($paramdst->toCData(), $paramsrc->toCData(), $paramsrcRec->toCData(), $paramdstRec->toCData(), $paramtint->toCData());
}

/**
 * Draw text (using default font) within an image (destination)
 */
 function ImageDrawText(\Nawarian\Raylib\Generated\Image $paramdst, string $paramtext, int $paramposX, int $paramposY, int $paramfontSize, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->ImageDrawText($paramdst->toCData(), $paramtext, $paramposX, $paramposY, $paramfontSize, $paramcolor->toCData());
}

/**
 * Draw text (custom sprite font) within an image (destination)
 */
 function ImageDrawTextEx(\Nawarian\Raylib\Generated\Image $paramdst, \Nawarian\Raylib\Generated\Font $paramfont, string $paramtext, \Nawarian\Raylib\Generated\Vector2 $paramposition, float $paramfontSize, float $paramspacing, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->ImageDrawTextEx($paramdst->toCData(), $paramfont->toCData(), $paramtext, $paramposition->toCData(), $paramfontSize, $paramspacing, $paramtint->toCData());
}

/**
 * Load texture from file into GPU memory (VRAM)
 */
 function LoadTexture(string $paramfileName) : \Nawarian\Raylib\Generated\Texture
{
global $raylib;
return \Nawarian\Raylib\Generated\Texture::fromCData($raylib->LoadTexture($paramfileName));
}

/**
 * Load texture from image data
 */
 function LoadTextureFromImage(\Nawarian\Raylib\Generated\Image $paramimage) : \Nawarian\Raylib\Generated\Texture
{
global $raylib;
return \Nawarian\Raylib\Generated\Texture::fromCData($raylib->LoadTextureFromImage($paramimage->toCData()));
}

/**
 * Load cubemap from image, multiple image cubemap layouts supported
 */
 function LoadTextureCubemap(\Nawarian\Raylib\Generated\Image $paramimage, int $paramlayout) : \Nawarian\Raylib\Generated\Texture
{
global $raylib;
return \Nawarian\Raylib\Generated\Texture::fromCData($raylib->LoadTextureCubemap($paramimage->toCData(), $paramlayout));
}

/**
 * Load texture for rendering (framebuffer)
 */
 function LoadRenderTexture(int $paramwidth, int $paramheight) : \Nawarian\Raylib\Generated\RenderTexture
{
global $raylib;
return \Nawarian\Raylib\Generated\RenderTexture::fromCData($raylib->LoadRenderTexture($paramwidth, $paramheight));
}

/**
 * Unload texture from GPU memory (VRAM)
 */
 function UnloadTexture(\Nawarian\Raylib\Generated\Texture $paramtexture) : void
{
global $raylib;
$raylib->UnloadTexture($paramtexture->toCData());
}

/**
 * Unload render texture from GPU memory (VRAM)
 */
 function UnloadRenderTexture(\Nawarian\Raylib\Generated\RenderTexture $paramtarget) : void
{
global $raylib;
$raylib->UnloadRenderTexture($paramtarget->toCData());
}

/**
 * Update GPU texture with new data
 */
 function UpdateTexture(\Nawarian\Raylib\Generated\Texture $paramtexture, \FFI\CData $parampixels) : void
{
global $raylib;
$raylib->UpdateTexture($paramtexture->toCData(), $parampixels);
}

/**
 * Update GPU texture rectangle with new data
 */
 function UpdateTextureRec(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Rectangle $paramrec, \FFI\CData $parampixels) : void
{
global $raylib;
$raylib->UpdateTextureRec($paramtexture->toCData(), $paramrec->toCData(), $parampixels);
}

/**
 * Get pixel data from GPU texture and return an Image
 */
 function GetTextureData(\Nawarian\Raylib\Generated\Texture $paramtexture) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GetTextureData($paramtexture->toCData()));
}

/**
 * Get pixel data from screen buffer and return an Image (screenshot)
 */
 function GetScreenData() : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GetScreenData());
}

/**
 * Generate GPU mipmaps for a texture
 */
 function GenTextureMipmaps(\Nawarian\Raylib\Generated\Texture $paramtexture) : void
{
global $raylib;
$raylib->GenTextureMipmaps($paramtexture->toCData());
}

/**
 * Set texture scaling filter mode
 */
 function SetTextureFilter(\Nawarian\Raylib\Generated\Texture $paramtexture, int $paramfilter) : void
{
global $raylib;
$raylib->SetTextureFilter($paramtexture->toCData(), $paramfilter);
}

/**
 * Set texture wrapping mode
 */
 function SetTextureWrap(\Nawarian\Raylib\Generated\Texture $paramtexture, int $paramwrap) : void
{
global $raylib;
$raylib->SetTextureWrap($paramtexture->toCData(), $paramwrap);
}

/**
 * Draw a Texture2D
 */
 function DrawTexture(\Nawarian\Raylib\Generated\Texture $paramtexture, int $paramposX, int $paramposY, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTexture($paramtexture->toCData(), $paramposX, $paramposY, $paramtint->toCData());
}

/**
 * Draw a Texture2D with position defined as Vector2
 */
 function DrawTextureV(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Vector2 $paramposition, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTextureV($paramtexture->toCData(), $paramposition->toCData(), $paramtint->toCData());
}

/**
 * Draw a Texture2D with extended parameters
 */
 function DrawTextureEx(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Vector2 $paramposition, float $paramrotation, float $paramscale, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTextureEx($paramtexture->toCData(), $paramposition->toCData(), $paramrotation, $paramscale, $paramtint->toCData());
}

/**
 * Draw a part of a texture defined by a rectangle
 */
 function DrawTextureRec(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Rectangle $paramsource, \Nawarian\Raylib\Generated\Vector2 $paramposition, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTextureRec($paramtexture->toCData(), $paramsource->toCData(), $paramposition->toCData(), $paramtint->toCData());
}

/**
 * Draw texture quad with tiling and offset parameters
 */
 function DrawTextureQuad(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Vector2 $paramtiling, \Nawarian\Raylib\Generated\Vector2 $paramoffset, \Nawarian\Raylib\Generated\Rectangle $paramquad, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTextureQuad($paramtexture->toCData(), $paramtiling->toCData(), $paramoffset->toCData(), $paramquad->toCData(), $paramtint->toCData());
}

/**
 * Draw part of a texture (defined by a rectangle) with rotation and scale tiled
 * into dest.
 */
 function DrawTextureTiled(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Rectangle $paramsource, \Nawarian\Raylib\Generated\Rectangle $paramdest, \Nawarian\Raylib\Generated\Vector2 $paramorigin, float $paramrotation, float $paramscale, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTextureTiled($paramtexture->toCData(), $paramsource->toCData(), $paramdest->toCData(), $paramorigin->toCData(), $paramrotation, $paramscale, $paramtint->toCData());
}

/**
 * Draw a part of a texture defined by a rectangle with 'pro' parameters
 */
 function DrawTexturePro(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Rectangle $paramsource, \Nawarian\Raylib\Generated\Rectangle $paramdest, \Nawarian\Raylib\Generated\Vector2 $paramorigin, float $paramrotation, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTexturePro($paramtexture->toCData(), $paramsource->toCData(), $paramdest->toCData(), $paramorigin->toCData(), $paramrotation, $paramtint->toCData());
}

/**
 * Draws a texture (or part of it) that stretches or shrinks nicely
 */
 function DrawTextureNPatch(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\NPatchInfo $paramnPatchInfo, \Nawarian\Raylib\Generated\Rectangle $paramdest, \Nawarian\Raylib\Generated\Vector2 $paramorigin, float $paramrotation, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTextureNPatch($paramtexture->toCData(), $paramnPatchInfo->toCData(), $paramdest->toCData(), $paramorigin->toCData(), $paramrotation, $paramtint->toCData());
}

/**
 * Draw a textured polygon
 */
 function DrawTexturePoly(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Vector2 $paramcenter, \Nawarian\Raylib\Generated\Vector2 $parampoints, \Nawarian\Raylib\Generated\Vector2 $paramtexcoords, int $parampointsCount, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTexturePoly($paramtexture->toCData(), $paramcenter->toCData(), $parampoints->toCData(), $paramtexcoords->toCData(), $parampointsCount, $paramtint->toCData());
}

/**
 * Get color with alpha applied, alpha goes from 0.0f to 1.0f
 */
 function Fade(\Nawarian\Raylib\Generated\Color $paramcolor, float $paramalpha) : \Nawarian\Raylib\Generated\Color
{
global $raylib;
return \Nawarian\Raylib\Generated\Color::fromCData($raylib->Fade($paramcolor->toCData(), $paramalpha));
}

/**
 * Get hexadecimal value for a Color
 */
 function ColorToInt(\Nawarian\Raylib\Generated\Color $paramcolor) : int
{
global $raylib;
return $raylib->ColorToInt($paramcolor->toCData());
}

/**
 * Get Color normalized as float [0..1]
 */
 function ColorNormalize(\Nawarian\Raylib\Generated\Color $paramcolor) : \Nawarian\Raylib\Generated\Vector4
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector4::fromCData($raylib->ColorNormalize($paramcolor->toCData()));
}

/**
 * Get Color from normalized values [0..1]
 */
 function ColorFromNormalized(\Nawarian\Raylib\Generated\Vector4 $paramnormalized) : \Nawarian\Raylib\Generated\Color
{
global $raylib;
return \Nawarian\Raylib\Generated\Color::fromCData($raylib->ColorFromNormalized($paramnormalized->toCData()));
}

/**
 * Get HSV values for a Color, hue [0..360], saturation/value [0..1]
 */
 function ColorToHSV(\Nawarian\Raylib\Generated\Color $paramcolor) : \Nawarian\Raylib\Generated\Vector3
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector3::fromCData($raylib->ColorToHSV($paramcolor->toCData()));
}

/**
 * Get a Color from HSV values, hue [0..360], saturation/value [0..1]
 */
 function ColorFromHSV(float $paramhue, float $paramsaturation, float $paramvalue) : \Nawarian\Raylib\Generated\Color
{
global $raylib;
return \Nawarian\Raylib\Generated\Color::fromCData($raylib->ColorFromHSV($paramhue, $paramsaturation, $paramvalue));
}

/**
 * Get color with alpha applied, alpha goes from 0.0f to 1.0f
 */
 function ColorAlpha(\Nawarian\Raylib\Generated\Color $paramcolor, float $paramalpha) : \Nawarian\Raylib\Generated\Color
{
global $raylib;
return \Nawarian\Raylib\Generated\Color::fromCData($raylib->ColorAlpha($paramcolor->toCData(), $paramalpha));
}

/**
 * Get src alpha-blended into dst color with tint
 */
 function ColorAlphaBlend(\Nawarian\Raylib\Generated\Color $paramdst, \Nawarian\Raylib\Generated\Color $paramsrc, \Nawarian\Raylib\Generated\Color $paramtint) : \Nawarian\Raylib\Generated\Color
{
global $raylib;
return \Nawarian\Raylib\Generated\Color::fromCData($raylib->ColorAlphaBlend($paramdst->toCData(), $paramsrc->toCData(), $paramtint->toCData()));
}

/**
 * Get Color structure from hexadecimal value
 */
 function GetColor(int $paramhexValue) : \Nawarian\Raylib\Generated\Color
{
global $raylib;
return \Nawarian\Raylib\Generated\Color::fromCData($raylib->GetColor($paramhexValue));
}

/**
 * Get Color from a source pixel pointer of certain format
 */
 function GetPixelColor(\FFI\CData $paramsrcPtr, int $paramformat) : \Nawarian\Raylib\Generated\Color
{
global $raylib;
return \Nawarian\Raylib\Generated\Color::fromCData($raylib->GetPixelColor($paramsrcPtr, $paramformat));
}

/**
 * Set color formatted into destination pixel pointer
 */
 function SetPixelColor(\FFI\CData $paramdstPtr, \Nawarian\Raylib\Generated\Color $paramcolor, int $paramformat) : void
{
global $raylib;
$raylib->SetPixelColor($paramdstPtr, $paramcolor->toCData(), $paramformat);
}

/**
 * Get pixel data size in bytes for certain format
 */
 function GetPixelDataSize(int $paramwidth, int $paramheight, int $paramformat) : int
{
global $raylib;
return $raylib->GetPixelDataSize($paramwidth, $paramheight, $paramformat);
}

/**
 * Get the default Font
 */
 function GetFontDefault() : \Nawarian\Raylib\Generated\Font
{
global $raylib;
return \Nawarian\Raylib\Generated\Font::fromCData($raylib->GetFontDefault());
}

/**
 * Load font from file into GPU memory (VRAM)
 */
 function LoadFont(string $paramfileName) : \Nawarian\Raylib\Generated\Font
{
global $raylib;
return \Nawarian\Raylib\Generated\Font::fromCData($raylib->LoadFont($paramfileName));
}

/**
 * Load font from file with extended parameters
 */
 function LoadFontEx(string $paramfileName, int $paramfontSize, array $paramfontChars, int $paramcharsCount) : \Nawarian\Raylib\Generated\Font
{
global $raylib;
return \Nawarian\Raylib\Generated\Font::fromCData($raylib->LoadFontEx($paramfileName, $paramfontSize, $paramfontChars, $paramcharsCount));
}

/**
 * Load font from Image (XNA style)
 */
 function LoadFontFromImage(\Nawarian\Raylib\Generated\Image $paramimage, \Nawarian\Raylib\Generated\Color $paramkey, int $paramfirstChar) : \Nawarian\Raylib\Generated\Font
{
global $raylib;
return \Nawarian\Raylib\Generated\Font::fromCData($raylib->LoadFontFromImage($paramimage->toCData(), $paramkey->toCData(), $paramfirstChar));
}

/**
 * Load font from memory buffer, fileType refers to extension: i.e. '.ttf'
 */
 function LoadFontFromMemory(string $paramfileType, array $paramfileData, int $paramdataSize, int $paramfontSize, array $paramfontChars, int $paramcharsCount) : \Nawarian\Raylib\Generated\Font
{
global $raylib;
return \Nawarian\Raylib\Generated\Font::fromCData($raylib->LoadFontFromMemory($paramfileType, $paramfileData, $paramdataSize, $paramfontSize, $paramfontChars, $paramcharsCount));
}

/**
 * Load font data for further use
 */
 function LoadFontData(array $paramfileData, int $paramdataSize, int $paramfontSize, array $paramfontChars, int $paramcharsCount, int $paramtype) : \Nawarian\Raylib\Generated\CharInfo
{
global $raylib;
return \Nawarian\Raylib\Generated\CharInfo::fromCData($raylib->LoadFontData($paramfileData, $paramdataSize, $paramfontSize, $paramfontChars, $paramcharsCount, $paramtype));
}

/**
 * Generate image font atlas using chars info
 */
 function GenImageFontAtlas(\Nawarian\Raylib\Generated\CharInfo $paramchars, array $paramrecs, int $paramcharsCount, int $paramfontSize, int $parampadding, int $parampackMethod) : \Nawarian\Raylib\Generated\Image
{
global $raylib;
return \Nawarian\Raylib\Generated\Image::fromCData($raylib->GenImageFontAtlas($paramchars->toCData(), $paramrecs, $paramcharsCount, $paramfontSize, $parampadding, $parampackMethod));
}

/**
 * Unload font chars info data (RAM)
 */
 function UnloadFontData(\Nawarian\Raylib\Generated\CharInfo $paramchars, int $paramcharsCount) : void
{
global $raylib;
$raylib->UnloadFontData($paramchars->toCData(), $paramcharsCount);
}

/**
 * Unload Font from GPU memory (VRAM)
 */
 function UnloadFont(\Nawarian\Raylib\Generated\Font $paramfont) : void
{
global $raylib;
$raylib->UnloadFont($paramfont->toCData());
}

/**
 * Draw current FPS
 */
 function DrawFPS(int $paramposX, int $paramposY) : void
{
global $raylib;
$raylib->DrawFPS($paramposX, $paramposY);
}

/**
 * Draw text (using default font)
 */
 function DrawText(string $paramtext, int $paramposX, int $paramposY, int $paramfontSize, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawText($paramtext, $paramposX, $paramposY, $paramfontSize, $paramcolor->toCData());
}

/**
 * Draw text using font and additional parameters
 */
 function DrawTextEx(\Nawarian\Raylib\Generated\Font $paramfont, string $paramtext, \Nawarian\Raylib\Generated\Vector2 $paramposition, float $paramfontSize, float $paramspacing, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTextEx($paramfont->toCData(), $paramtext, $paramposition->toCData(), $paramfontSize, $paramspacing, $paramtint->toCData());
}

/**
 * Draw text using font inside rectangle limits
 */
 function DrawTextRec(\Nawarian\Raylib\Generated\Font $paramfont, string $paramtext, \Nawarian\Raylib\Generated\Rectangle $paramrec, float $paramfontSize, float $paramspacing, bool $paramwordWrap, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTextRec($paramfont->toCData(), $paramtext, $paramrec->toCData(), $paramfontSize, $paramspacing, $paramwordWrap->toCData(), $paramtint->toCData());
}

/**
 * Draw text using font inside rectangle limits with support for text selection
 */
 function DrawTextRecEx(\Nawarian\Raylib\Generated\Font $paramfont, string $paramtext, \Nawarian\Raylib\Generated\Rectangle $paramrec, float $paramfontSize, float $paramspacing, bool $paramwordWrap, \Nawarian\Raylib\Generated\Color $paramtint, int $paramselectStart, int $paramselectLength, \Nawarian\Raylib\Generated\Color $paramselectTint, \Nawarian\Raylib\Generated\Color $paramselectBackTint) : void
{
global $raylib;
$raylib->DrawTextRecEx($paramfont->toCData(), $paramtext, $paramrec->toCData(), $paramfontSize, $paramspacing, $paramwordWrap->toCData(), $paramtint->toCData(), $paramselectStart, $paramselectLength, $paramselectTint->toCData(), $paramselectBackTint->toCData());
}

/**
 * Draw one character (codepoint)
 */
 function DrawTextCodepoint(\Nawarian\Raylib\Generated\Font $paramfont, int $paramcodepoint, \Nawarian\Raylib\Generated\Vector2 $paramposition, float $paramfontSize, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawTextCodepoint($paramfont->toCData(), $paramcodepoint, $paramposition->toCData(), $paramfontSize, $paramtint->toCData());
}

/**
 * Measure string width for default font
 */
 function MeasureText(string $paramtext, int $paramfontSize) : int
{
global $raylib;
return $raylib->MeasureText($paramtext, $paramfontSize);
}

/**
 * Measure string size for Font
 */
 function MeasureTextEx(\Nawarian\Raylib\Generated\Font $paramfont, string $paramtext, float $paramfontSize, float $paramspacing) : \Nawarian\Raylib\Generated\Vector2
{
global $raylib;
return \Nawarian\Raylib\Generated\Vector2::fromCData($raylib->MeasureTextEx($paramfont->toCData(), $paramtext, $paramfontSize, $paramspacing));
}

/**
 * Get index position for a unicode character on font
 */
 function GetGlyphIndex(\Nawarian\Raylib\Generated\Font $paramfont, int $paramcodepoint) : int
{
global $raylib;
return $raylib->GetGlyphIndex($paramfont->toCData(), $paramcodepoint);
}

/**
 * Copy one string to another, returns bytes copied
 */
 function TextCopy(string $paramdst, string $paramsrc) : int
{
global $raylib;
return $raylib->TextCopy($paramdst, $paramsrc);
}

/**
 * Check if two text string are equal
 */
 function TextIsEqual(string $paramtext1, string $paramtext2) : bool
{
global $raylib;
return $raylib->TextIsEqual($paramtext1, $paramtext2);
}

/**
 * Get text length, checks for ' 0' ending
 */
 function TextLength(string $paramtext) : int
{
global $raylib;
return $raylib->TextLength($paramtext);
}

/**
 * Get a piece of a text string
 */
 function TextSubtext(string $paramtext, int $paramposition, int $paramlength) : string
{
global $raylib;
return $raylib->TextSubtext($paramtext, $paramposition, $paramlength);
}

/**
 * Replace text string (memory must be freed!)
 */
 function TextReplace(string $paramtext, string $paramreplace, string $paramby) : string
{
global $raylib;
return $raylib->TextReplace($paramtext, $paramreplace, $paramby);
}

/**
 * Insert text in a position (memory must be freed!)
 */
 function TextInsert(string $paramtext, string $paraminsert, int $paramposition) : string
{
global $raylib;
return $raylib->TextInsert($paramtext, $paraminsert, $paramposition);
}

/**
 * Split text into multiple strings
 */
 function TextSplit(string $paramtext, string $paramdelimiter, array $paramcount) : array
{
global $raylib;
return $raylib->TextSplit($paramtext, $paramdelimiter, $paramcount);
}

/**
 * Append text at specific position and move cursor!
 */
 function TextAppend(string $paramtext, string $paramappend, array $paramposition) : void
{
global $raylib;
$raylib->TextAppend($paramtext, $paramappend, $paramposition);
}

/**
 * Find first text occurrence within a string
 */
 function TextFindIndex(string $paramtext, string $paramfind) : int
{
global $raylib;
return $raylib->TextFindIndex($paramtext, $paramfind);
}

/**
 * Get upper case version of provided string
 */
 function TextToUpper(string $paramtext) : string
{
global $raylib;
return $raylib->TextToUpper($paramtext);
}

/**
 * Get lower case version of provided string
 */
 function TextToLower(string $paramtext) : string
{
global $raylib;
return $raylib->TextToLower($paramtext);
}

/**
 * Get Pascal case notation version of provided string
 */
 function TextToPascal(string $paramtext) : string
{
global $raylib;
return $raylib->TextToPascal($paramtext);
}

/**
 * Get integer value from text (negative values not supported)
 */
 function TextToInteger(string $paramtext) : int
{
global $raylib;
return $raylib->TextToInteger($paramtext);
}

/**
 * Encode text codepoint into utf8 text (memory must be freed!)
 */
 function TextToUtf8(array $paramcodepoints, int $paramlength) : string
{
global $raylib;
return $raylib->TextToUtf8($paramcodepoints, $paramlength);
}

/**
 * Get all codepoints in a string, codepoints count returned by parameters
 */
 function GetCodepoints(string $paramtext, array $paramcount) : array
{
global $raylib;
return $raylib->GetCodepoints($paramtext, $paramcount);
}

/**
 * Get total number of characters (codepoints) in a UTF8 encoded string
 */
 function GetCodepointsCount(string $paramtext) : int
{
global $raylib;
return $raylib->GetCodepointsCount($paramtext);
}

/**
 * Get next codepoint in a UTF8 encoded string; 0x3f('?') is returned on failure
 */
 function GetNextCodepoint(string $paramtext, array $parambytesProcessed) : int
{
global $raylib;
return $raylib->GetNextCodepoint($paramtext, $parambytesProcessed);
}

/**
 * Encode codepoint into utf8 text (char array length returned as parameter)
 */
 function CodepointToUtf8(int $paramcodepoint, array $parambyteLength) : string
{
global $raylib;
return $raylib->CodepointToUtf8($paramcodepoint, $parambyteLength);
}

/**
 * Draw a line in 3D world space
 */
 function DrawLine3D(\Nawarian\Raylib\Generated\Vector3 $paramstartPos, \Nawarian\Raylib\Generated\Vector3 $paramendPos, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawLine3D($paramstartPos->toCData(), $paramendPos->toCData(), $paramcolor->toCData());
}

/**
 * Draw a point in 3D space, actually a small line
 */
 function DrawPoint3D(\Nawarian\Raylib\Generated\Vector3 $paramposition, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawPoint3D($paramposition->toCData(), $paramcolor->toCData());
}

/**
 * Draw a circle in 3D world space
 */
 function DrawCircle3D(\Nawarian\Raylib\Generated\Vector3 $paramcenter, float $paramradius, \Nawarian\Raylib\Generated\Vector3 $paramrotationAxis, float $paramrotationAngle, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCircle3D($paramcenter->toCData(), $paramradius, $paramrotationAxis->toCData(), $paramrotationAngle, $paramcolor->toCData());
}

/**
 * Draw a color-filled triangle (vertex in counter-clockwise order!)
 */
 function DrawTriangle3D(\Nawarian\Raylib\Generated\Vector3 $paramv1, \Nawarian\Raylib\Generated\Vector3 $paramv2, \Nawarian\Raylib\Generated\Vector3 $paramv3, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawTriangle3D($paramv1->toCData(), $paramv2->toCData(), $paramv3->toCData(), $paramcolor->toCData());
}

/**
 * Draw a triangle strip defined by points
 */
 function DrawTriangleStrip3D(array $parampoints, int $parampointsCount, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawTriangleStrip3D($parampoints, $parampointsCount, $paramcolor->toCData());
}

/**
 * Draw cube
 */
 function DrawCube(\Nawarian\Raylib\Generated\Vector3 $paramposition, float $paramwidth, float $paramheight, float $paramlength, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCube($paramposition->toCData(), $paramwidth, $paramheight, $paramlength, $paramcolor->toCData());
}

/**
 * Draw cube (Vector version)
 */
 function DrawCubeV(\Nawarian\Raylib\Generated\Vector3 $paramposition, \Nawarian\Raylib\Generated\Vector3 $paramsize, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCubeV($paramposition->toCData(), $paramsize->toCData(), $paramcolor->toCData());
}

/**
 * Draw cube wires
 */
 function DrawCubeWires(\Nawarian\Raylib\Generated\Vector3 $paramposition, float $paramwidth, float $paramheight, float $paramlength, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCubeWires($paramposition->toCData(), $paramwidth, $paramheight, $paramlength, $paramcolor->toCData());
}

/**
 * Draw cube wires (Vector version)
 */
 function DrawCubeWiresV(\Nawarian\Raylib\Generated\Vector3 $paramposition, \Nawarian\Raylib\Generated\Vector3 $paramsize, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCubeWiresV($paramposition->toCData(), $paramsize->toCData(), $paramcolor->toCData());
}

/**
 * Draw cube textured
 */
 function DrawCubeTexture(\Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Vector3 $paramposition, float $paramwidth, float $paramheight, float $paramlength, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCubeTexture($paramtexture->toCData(), $paramposition->toCData(), $paramwidth, $paramheight, $paramlength, $paramcolor->toCData());
}

/**
 * Draw sphere
 */
 function DrawSphere(\Nawarian\Raylib\Generated\Vector3 $paramcenterPos, float $paramradius, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawSphere($paramcenterPos->toCData(), $paramradius, $paramcolor->toCData());
}

/**
 * Draw sphere with extended parameters
 */
 function DrawSphereEx(\Nawarian\Raylib\Generated\Vector3 $paramcenterPos, float $paramradius, int $paramrings, int $paramslices, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawSphereEx($paramcenterPos->toCData(), $paramradius, $paramrings, $paramslices, $paramcolor->toCData());
}

/**
 * Draw sphere wires
 */
 function DrawSphereWires(\Nawarian\Raylib\Generated\Vector3 $paramcenterPos, float $paramradius, int $paramrings, int $paramslices, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawSphereWires($paramcenterPos->toCData(), $paramradius, $paramrings, $paramslices, $paramcolor->toCData());
}

/**
 * Draw a cylinder/cone
 */
 function DrawCylinder(\Nawarian\Raylib\Generated\Vector3 $paramposition, float $paramradiusTop, float $paramradiusBottom, float $paramheight, int $paramslices, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCylinder($paramposition->toCData(), $paramradiusTop, $paramradiusBottom, $paramheight, $paramslices, $paramcolor->toCData());
}

/**
 * Draw a cylinder/cone wires
 */
 function DrawCylinderWires(\Nawarian\Raylib\Generated\Vector3 $paramposition, float $paramradiusTop, float $paramradiusBottom, float $paramheight, int $paramslices, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawCylinderWires($paramposition->toCData(), $paramradiusTop, $paramradiusBottom, $paramheight, $paramslices, $paramcolor->toCData());
}

/**
 * Draw a plane XZ
 */
 function DrawPlane(\Nawarian\Raylib\Generated\Vector3 $paramcenterPos, \Nawarian\Raylib\Generated\Vector2 $paramsize, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawPlane($paramcenterPos->toCData(), $paramsize->toCData(), $paramcolor->toCData());
}

/**
 * Draw a ray line
 */
 function DrawRay(\Nawarian\Raylib\Generated\Ray $paramray, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawRay($paramray->toCData(), $paramcolor->toCData());
}

/**
 * Draw a grid (centered at (0, 0, 0))
 */
 function DrawGrid(int $paramslices, float $paramspacing) : void
{
global $raylib;
$raylib->DrawGrid($paramslices, $paramspacing);
}

/**
 * Load model from files (meshes and materials)
 */
 function LoadModel(string $paramfileName) : \Nawarian\Raylib\Generated\Model
{
global $raylib;
return \Nawarian\Raylib\Generated\Model::fromCData($raylib->LoadModel($paramfileName));
}

/**
 * Load model from generated mesh (default material)
 */
 function LoadModelFromMesh(\Nawarian\Raylib\Generated\Mesh $parammesh) : \Nawarian\Raylib\Generated\Model
{
global $raylib;
return \Nawarian\Raylib\Generated\Model::fromCData($raylib->LoadModelFromMesh($parammesh->toCData()));
}

/**
 * Unload model (including meshes) from memory (RAM and/or VRAM)
 */
 function UnloadModel(\Nawarian\Raylib\Generated\Model $parammodel) : void
{
global $raylib;
$raylib->UnloadModel($parammodel->toCData());
}

/**
 * Unload model (but not meshes) from memory (RAM and/or VRAM)
 */
 function UnloadModelKeepMeshes(\Nawarian\Raylib\Generated\Model $parammodel) : void
{
global $raylib;
$raylib->UnloadModelKeepMeshes($parammodel->toCData());
}

/**
 * Upload mesh vertex data in GPU and provide VAO/VBO ids
 */
 function UploadMesh(array $parammesh, bool $paramdynamic) : void
{
global $raylib;
$raylib->UploadMesh($parammesh, $paramdynamic->toCData());
}

/**
 * Update mesh vertex data in GPU for a specific buffer index
 */
 function UpdateMeshBuffer(\Nawarian\Raylib\Generated\Mesh $parammesh, int $paramindex, \FFI\CData $paramdata, int $paramdataSize, int $paramoffset) : void
{
global $raylib;
$raylib->UpdateMeshBuffer($parammesh->toCData(), $paramindex, $paramdata, $paramdataSize, $paramoffset);
}

/**
 * Draw a 3d mesh with material and transform
 */
 function DrawMesh(\Nawarian\Raylib\Generated\Mesh $parammesh, \Nawarian\Raylib\Generated\Material $parammaterial, \Nawarian\Raylib\Generated\Matrix $paramtransform) : void
{
global $raylib;
$raylib->DrawMesh($parammesh->toCData(), $parammaterial->toCData(), $paramtransform->toCData());
}

/**
 * Draw multiple mesh instances with material and different transforms
 */
 function DrawMeshInstanced(\Nawarian\Raylib\Generated\Mesh $parammesh, \Nawarian\Raylib\Generated\Material $parammaterial, array $paramtransforms, int $paraminstances) : void
{
global $raylib;
$raylib->DrawMeshInstanced($parammesh->toCData(), $parammaterial->toCData(), $paramtransforms, $paraminstances);
}

/**
 * Unload mesh data from CPU and GPU
 */
 function UnloadMesh(\Nawarian\Raylib\Generated\Mesh $parammesh) : void
{
global $raylib;
$raylib->UnloadMesh($parammesh->toCData());
}

/**
 * Export mesh data to file, returns true on success
 */
 function ExportMesh(\Nawarian\Raylib\Generated\Mesh $parammesh, string $paramfileName) : bool
{
global $raylib;
return $raylib->ExportMesh($parammesh->toCData(), $paramfileName);
}

/**
 * Load materials from model file
 */
 function LoadMaterials(string $paramfileName, array $parammaterialCount) : array
{
global $raylib;
return $raylib->LoadMaterials($paramfileName, $parammaterialCount);
}

/**
 * Load default material (Supports: DIFFUSE, SPECULAR, NORMAL maps)
 */
 function LoadMaterialDefault() : \Nawarian\Raylib\Generated\Material
{
global $raylib;
return \Nawarian\Raylib\Generated\Material::fromCData($raylib->LoadMaterialDefault());
}

/**
 * Unload material from GPU memory (VRAM)
 */
 function UnloadMaterial(\Nawarian\Raylib\Generated\Material $parammaterial) : void
{
global $raylib;
$raylib->UnloadMaterial($parammaterial->toCData());
}

/**
 * Set texture for a material map type (MATERIAL_MAP_DIFFUSE,
 * MATERIAL_MAP_SPECULAR...)
 */
 function SetMaterialTexture(array $parammaterial, int $parammapType, \Nawarian\Raylib\Generated\Texture $paramtexture) : void
{
global $raylib;
$raylib->SetMaterialTexture($parammaterial, $parammapType, $paramtexture->toCData());
}

/**
 * Set material for a mesh
 */
 function SetModelMeshMaterial(\Nawarian\Raylib\Generated\Model $parammodel, int $parammeshId, int $parammaterialId) : void
{
global $raylib;
$raylib->SetModelMeshMaterial($parammodel->toCData(), $parammeshId, $parammaterialId);
}

/**
 * Load model animations from file
 */
 function LoadModelAnimations(string $paramfileName, array $paramanimsCount) : array
{
global $raylib;
return $raylib->LoadModelAnimations($paramfileName, $paramanimsCount);
}

/**
 * Update model animation pose
 */
 function UpdateModelAnimation(\Nawarian\Raylib\Generated\Model $parammodel, \Nawarian\Raylib\Generated\ModelAnimation $paramanim, int $paramframe) : void
{
global $raylib;
$raylib->UpdateModelAnimation($parammodel->toCData(), $paramanim->toCData(), $paramframe);
}

/**
 * Unload animation data
 */
 function UnloadModelAnimation(\Nawarian\Raylib\Generated\ModelAnimation $paramanim) : void
{
global $raylib;
$raylib->UnloadModelAnimation($paramanim->toCData());
}

/**
 * Unload animation array data
 */
 function UnloadModelAnimations(array $paramanimations, int $paramcount) : void
{
global $raylib;
$raylib->UnloadModelAnimations($paramanimations, $paramcount);
}

/**
 * Check model animation skeleton match
 */
 function IsModelAnimationValid(\Nawarian\Raylib\Generated\Model $parammodel, \Nawarian\Raylib\Generated\ModelAnimation $paramanim) : bool
{
global $raylib;
return $raylib->IsModelAnimationValid($parammodel->toCData(), $paramanim->toCData());
}

/**
 * Generate polygonal mesh
 */
 function GenMeshPoly(int $paramsides, float $paramradius) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshPoly($paramsides, $paramradius));
}

/**
 * Generate plane mesh (with subdivisions)
 */
 function GenMeshPlane(float $paramwidth, float $paramlength, int $paramresX, int $paramresZ) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshPlane($paramwidth, $paramlength, $paramresX, $paramresZ));
}

/**
 * Generate cuboid mesh
 */
 function GenMeshCube(float $paramwidth, float $paramheight, float $paramlength) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshCube($paramwidth, $paramheight, $paramlength));
}

/**
 * Generate sphere mesh (standard sphere)
 */
 function GenMeshSphere(float $paramradius, int $paramrings, int $paramslices) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshSphere($paramradius, $paramrings, $paramslices));
}

/**
 * Generate half-sphere mesh (no bottom cap)
 */
 function GenMeshHemiSphere(float $paramradius, int $paramrings, int $paramslices) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshHemiSphere($paramradius, $paramrings, $paramslices));
}

/**
 * Generate cylinder mesh
 */
 function GenMeshCylinder(float $paramradius, float $paramheight, int $paramslices) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshCylinder($paramradius, $paramheight, $paramslices));
}

/**
 * Generate torus mesh
 */
 function GenMeshTorus(float $paramradius, float $paramsize, int $paramradSeg, int $paramsides) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshTorus($paramradius, $paramsize, $paramradSeg, $paramsides));
}

/**
 * Generate trefoil knot mesh
 */
 function GenMeshKnot(float $paramradius, float $paramsize, int $paramradSeg, int $paramsides) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshKnot($paramradius, $paramsize, $paramradSeg, $paramsides));
}

/**
 * Generate heightmap mesh from image data
 */
 function GenMeshHeightmap(\Nawarian\Raylib\Generated\Image $paramheightmap, \Nawarian\Raylib\Generated\Vector3 $paramsize) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshHeightmap($paramheightmap->toCData(), $paramsize->toCData()));
}

/**
 * Generate cubes-based map mesh from image data
 */
 function GenMeshCubicmap(\Nawarian\Raylib\Generated\Image $paramcubicmap, \Nawarian\Raylib\Generated\Vector3 $paramcubeSize) : \Nawarian\Raylib\Generated\Mesh
{
global $raylib;
return \Nawarian\Raylib\Generated\Mesh::fromCData($raylib->GenMeshCubicmap($paramcubicmap->toCData(), $paramcubeSize->toCData()));
}

/**
 * Compute mesh bounding box limits
 */
 function GetMeshBoundingBox(\Nawarian\Raylib\Generated\Mesh $parammesh) : \Nawarian\Raylib\Generated\BoundingBox
{
global $raylib;
return \Nawarian\Raylib\Generated\BoundingBox::fromCData($raylib->GetMeshBoundingBox($parammesh->toCData()));
}

/**
 * Compute mesh tangents
 */
 function MeshTangents(array $parammesh) : void
{
global $raylib;
$raylib->MeshTangents($parammesh);
}

/**
 * Compute mesh binormals
 */
 function MeshBinormals(array $parammesh) : void
{
global $raylib;
$raylib->MeshBinormals($parammesh);
}

/**
 * Draw a model (with texture if set)
 */
 function DrawModel(\Nawarian\Raylib\Generated\Model $parammodel, \Nawarian\Raylib\Generated\Vector3 $paramposition, float $paramscale, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawModel($parammodel->toCData(), $paramposition->toCData(), $paramscale, $paramtint->toCData());
}

/**
 * Draw a model with extended parameters
 */
 function DrawModelEx(\Nawarian\Raylib\Generated\Model $parammodel, \Nawarian\Raylib\Generated\Vector3 $paramposition, \Nawarian\Raylib\Generated\Vector3 $paramrotationAxis, float $paramrotationAngle, \Nawarian\Raylib\Generated\Vector3 $paramscale, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawModelEx($parammodel->toCData(), $paramposition->toCData(), $paramrotationAxis->toCData(), $paramrotationAngle, $paramscale->toCData(), $paramtint->toCData());
}

/**
 * Draw a model wires (with texture if set)
 */
 function DrawModelWires(\Nawarian\Raylib\Generated\Model $parammodel, \Nawarian\Raylib\Generated\Vector3 $paramposition, float $paramscale, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawModelWires($parammodel->toCData(), $paramposition->toCData(), $paramscale, $paramtint->toCData());
}

/**
 * Draw a model wires (with texture if set) with extended parameters
 */
 function DrawModelWiresEx(\Nawarian\Raylib\Generated\Model $parammodel, \Nawarian\Raylib\Generated\Vector3 $paramposition, \Nawarian\Raylib\Generated\Vector3 $paramrotationAxis, float $paramrotationAngle, \Nawarian\Raylib\Generated\Vector3 $paramscale, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawModelWiresEx($parammodel->toCData(), $paramposition->toCData(), $paramrotationAxis->toCData(), $paramrotationAngle, $paramscale->toCData(), $paramtint->toCData());
}

/**
 * Draw bounding box (wires)
 */
 function DrawBoundingBox(\Nawarian\Raylib\Generated\BoundingBox $parambox, \Nawarian\Raylib\Generated\Color $paramcolor) : void
{
global $raylib;
$raylib->DrawBoundingBox($parambox->toCData(), $paramcolor->toCData());
}

/**
 * Draw a billboard texture
 */
 function DrawBillboard(\Nawarian\Raylib\Generated\Camera3D $paramcamera, \Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Vector3 $paramposition, float $paramsize, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawBillboard($paramcamera->toCData(), $paramtexture->toCData(), $paramposition->toCData(), $paramsize, $paramtint->toCData());
}

/**
 * Draw a billboard texture defined by source
 */
 function DrawBillboardRec(\Nawarian\Raylib\Generated\Camera3D $paramcamera, \Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Rectangle $paramsource, \Nawarian\Raylib\Generated\Vector3 $paramposition, \Nawarian\Raylib\Generated\Vector2 $paramsize, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawBillboardRec($paramcamera->toCData(), $paramtexture->toCData(), $paramsource->toCData(), $paramposition->toCData(), $paramsize->toCData(), $paramtint->toCData());
}

/**
 * Draw a billboard texture defined by source and rotation
 */
 function DrawBillboardPro(\Nawarian\Raylib\Generated\Camera3D $paramcamera, \Nawarian\Raylib\Generated\Texture $paramtexture, \Nawarian\Raylib\Generated\Rectangle $paramsource, \Nawarian\Raylib\Generated\Vector3 $paramposition, \Nawarian\Raylib\Generated\Vector2 $paramsize, \Nawarian\Raylib\Generated\Vector2 $paramorigin, float $paramrotation, \Nawarian\Raylib\Generated\Color $paramtint) : void
{
global $raylib;
$raylib->DrawBillboardPro($paramcamera->toCData(), $paramtexture->toCData(), $paramsource->toCData(), $paramposition->toCData(), $paramsize->toCData(), $paramorigin->toCData(), $paramrotation, $paramtint->toCData());
}

/**
 * Check collision between two spheres
 */
 function CheckCollisionSpheres(\Nawarian\Raylib\Generated\Vector3 $paramcenter1, float $paramradius1, \Nawarian\Raylib\Generated\Vector3 $paramcenter2, float $paramradius2) : bool
{
global $raylib;
return $raylib->CheckCollisionSpheres($paramcenter1->toCData(), $paramradius1, $paramcenter2->toCData(), $paramradius2);
}

/**
 * Check collision between two bounding boxes
 */
 function CheckCollisionBoxes(\Nawarian\Raylib\Generated\BoundingBox $parambox1, \Nawarian\Raylib\Generated\BoundingBox $parambox2) : bool
{
global $raylib;
return $raylib->CheckCollisionBoxes($parambox1->toCData(), $parambox2->toCData());
}

/**
 * Check collision between box and sphere
 */
 function CheckCollisionBoxSphere(\Nawarian\Raylib\Generated\BoundingBox $parambox, \Nawarian\Raylib\Generated\Vector3 $paramcenter, float $paramradius) : bool
{
global $raylib;
return $raylib->CheckCollisionBoxSphere($parambox->toCData(), $paramcenter->toCData(), $paramradius);
}

/**
 * Get collision info between ray and sphere
 */
 function GetRayCollisionSphere(\Nawarian\Raylib\Generated\Ray $paramray, \Nawarian\Raylib\Generated\Vector3 $paramcenter, float $paramradius) : \Nawarian\Raylib\Generated\RayCollision
{
global $raylib;
return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionSphere($paramray->toCData(), $paramcenter->toCData(), $paramradius));
}

/**
 * Get collision info between ray and box
 */
 function GetRayCollisionBox(\Nawarian\Raylib\Generated\Ray $paramray, \Nawarian\Raylib\Generated\BoundingBox $parambox) : \Nawarian\Raylib\Generated\RayCollision
{
global $raylib;
return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionBox($paramray->toCData(), $parambox->toCData()));
}

/**
 * Get collision info between ray and model
 */
 function GetRayCollisionModel(\Nawarian\Raylib\Generated\Ray $paramray, \Nawarian\Raylib\Generated\Model $parammodel) : \Nawarian\Raylib\Generated\RayCollision
{
global $raylib;
return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionModel($paramray->toCData(), $parammodel->toCData()));
}

/**
 * Get collision info between ray and mesh
 */
 function GetRayCollisionMesh(\Nawarian\Raylib\Generated\Ray $paramray, \Nawarian\Raylib\Generated\Mesh $parammesh, \Nawarian\Raylib\Generated\Matrix $paramtransform) : \Nawarian\Raylib\Generated\RayCollision
{
global $raylib;
return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionMesh($paramray->toCData(), $parammesh->toCData(), $paramtransform->toCData()));
}

/**
 * Get collision info between ray and triangle
 */
 function GetRayCollisionTriangle(\Nawarian\Raylib\Generated\Ray $paramray, \Nawarian\Raylib\Generated\Vector3 $paramp1, \Nawarian\Raylib\Generated\Vector3 $paramp2, \Nawarian\Raylib\Generated\Vector3 $paramp3) : \Nawarian\Raylib\Generated\RayCollision
{
global $raylib;
return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionTriangle($paramray->toCData(), $paramp1->toCData(), $paramp2->toCData(), $paramp3->toCData()));
}

/**
 * Get collision info between ray and quad
 */
 function GetRayCollisionQuad(\Nawarian\Raylib\Generated\Ray $paramray, \Nawarian\Raylib\Generated\Vector3 $paramp1, \Nawarian\Raylib\Generated\Vector3 $paramp2, \Nawarian\Raylib\Generated\Vector3 $paramp3, \Nawarian\Raylib\Generated\Vector3 $paramp4) : \Nawarian\Raylib\Generated\RayCollision
{
global $raylib;
return \Nawarian\Raylib\Generated\RayCollision::fromCData($raylib->GetRayCollisionQuad($paramray->toCData(), $paramp1->toCData(), $paramp2->toCData(), $paramp3->toCData(), $paramp4->toCData()));
}

/**
 * Initialize audio device and context
 */
 function InitAudioDevice() : void
{
global $raylib;
$raylib->InitAudioDevice();
}

/**
 * Close the audio device and context
 */
 function CloseAudioDevice() : void
{
global $raylib;
$raylib->CloseAudioDevice();
}

/**
 * Check if audio device has been initialized successfully
 */
 function IsAudioDeviceReady() : bool
{
global $raylib;
return $raylib->IsAudioDeviceReady();
}

/**
 * Set master volume (listener)
 */
 function SetMasterVolume(float $paramvolume) : void
{
global $raylib;
$raylib->SetMasterVolume($paramvolume);
}

/**
 * Load wave data from file
 */
 function LoadWave(string $paramfileName) : \Nawarian\Raylib\Generated\Wave
{
global $raylib;
return \Nawarian\Raylib\Generated\Wave::fromCData($raylib->LoadWave($paramfileName));
}

/**
 * Load wave from memory buffer, fileType refers to extension: i.e. '.wav'
 */
 function LoadWaveFromMemory(string $paramfileType, array $paramfileData, int $paramdataSize) : \Nawarian\Raylib\Generated\Wave
{
global $raylib;
return \Nawarian\Raylib\Generated\Wave::fromCData($raylib->LoadWaveFromMemory($paramfileType, $paramfileData, $paramdataSize));
}

/**
 * Load sound from file
 */
 function LoadSound(string $paramfileName) : \Nawarian\Raylib\Generated\Sound
{
global $raylib;
return \Nawarian\Raylib\Generated\Sound::fromCData($raylib->LoadSound($paramfileName));
}

/**
 * Load sound from wave data
 */
 function LoadSoundFromWave(\Nawarian\Raylib\Generated\Wave $paramwave) : \Nawarian\Raylib\Generated\Sound
{
global $raylib;
return \Nawarian\Raylib\Generated\Sound::fromCData($raylib->LoadSoundFromWave($paramwave->toCData()));
}

/**
 * Update sound buffer with new data
 */
 function UpdateSound(\Nawarian\Raylib\Generated\Sound $paramsound, \FFI\CData $paramdata, int $paramsamplesCount) : void
{
global $raylib;
$raylib->UpdateSound($paramsound->toCData(), $paramdata, $paramsamplesCount);
}

/**
 * Unload wave data
 */
 function UnloadWave(\Nawarian\Raylib\Generated\Wave $paramwave) : void
{
global $raylib;
$raylib->UnloadWave($paramwave->toCData());
}

/**
 * Unload sound
 */
 function UnloadSound(\Nawarian\Raylib\Generated\Sound $paramsound) : void
{
global $raylib;
$raylib->UnloadSound($paramsound->toCData());
}

/**
 * Export wave data to file, returns true on success
 */
 function ExportWave(\Nawarian\Raylib\Generated\Wave $paramwave, string $paramfileName) : bool
{
global $raylib;
return $raylib->ExportWave($paramwave->toCData(), $paramfileName);
}

/**
 * Export wave sample data to code (.h), returns true on success
 */
 function ExportWaveAsCode(\Nawarian\Raylib\Generated\Wave $paramwave, string $paramfileName) : bool
{
global $raylib;
return $raylib->ExportWaveAsCode($paramwave->toCData(), $paramfileName);
}

/**
 * Play a sound
 */
 function PlaySound(\Nawarian\Raylib\Generated\Sound $paramsound) : void
{
global $raylib;
$raylib->PlaySound($paramsound->toCData());
}

/**
 * Stop playing a sound
 */
 function StopSound(\Nawarian\Raylib\Generated\Sound $paramsound) : void
{
global $raylib;
$raylib->StopSound($paramsound->toCData());
}

/**
 * Pause a sound
 */
 function PauseSound(\Nawarian\Raylib\Generated\Sound $paramsound) : void
{
global $raylib;
$raylib->PauseSound($paramsound->toCData());
}

/**
 * Resume a paused sound
 */
 function ResumeSound(\Nawarian\Raylib\Generated\Sound $paramsound) : void
{
global $raylib;
$raylib->ResumeSound($paramsound->toCData());
}

/**
 * Play a sound (using multichannel buffer pool)
 */
 function PlaySoundMulti(\Nawarian\Raylib\Generated\Sound $paramsound) : void
{
global $raylib;
$raylib->PlaySoundMulti($paramsound->toCData());
}

/**
 * Stop any sound playing (using multichannel buffer pool)
 */
 function StopSoundMulti() : void
{
global $raylib;
$raylib->StopSoundMulti();
}

/**
 * Get number of sounds playing in the multichannel
 */
 function GetSoundsPlaying() : int
{
global $raylib;
return $raylib->GetSoundsPlaying();
}

/**
 * Check if a sound is currently playing
 */
 function IsSoundPlaying(\Nawarian\Raylib\Generated\Sound $paramsound) : bool
{
global $raylib;
return $raylib->IsSoundPlaying($paramsound->toCData());
}

/**
 * Set volume for a sound (1.0 is max level)
 */
 function SetSoundVolume(\Nawarian\Raylib\Generated\Sound $paramsound, float $paramvolume) : void
{
global $raylib;
$raylib->SetSoundVolume($paramsound->toCData(), $paramvolume);
}

/**
 * Set pitch for a sound (1.0 is base level)
 */
 function SetSoundPitch(\Nawarian\Raylib\Generated\Sound $paramsound, float $parampitch) : void
{
global $raylib;
$raylib->SetSoundPitch($paramsound->toCData(), $parampitch);
}

/**
 * Convert wave data to desired format
 */
 function WaveFormat(\Nawarian\Raylib\Generated\Wave $paramwave, int $paramsampleRate, int $paramsampleSize, int $paramchannels) : void
{
global $raylib;
$raylib->WaveFormat($paramwave->toCData(), $paramsampleRate, $paramsampleSize, $paramchannels);
}

/**
 * Copy a wave to a new wave
 */
 function WaveCopy(\Nawarian\Raylib\Generated\Wave $paramwave) : \Nawarian\Raylib\Generated\Wave
{
global $raylib;
return \Nawarian\Raylib\Generated\Wave::fromCData($raylib->WaveCopy($paramwave->toCData()));
}

/**
 * Crop a wave to defined samples range
 */
 function WaveCrop(\Nawarian\Raylib\Generated\Wave $paramwave, int $paraminitSample, int $paramfinalSample) : void
{
global $raylib;
$raylib->WaveCrop($paramwave->toCData(), $paraminitSample, $paramfinalSample);
}

/**
 * Load samples data from wave as a floats array
 */
 function LoadWaveSamples(\Nawarian\Raylib\Generated\Wave $paramwave) : array
{
global $raylib;
return $raylib->LoadWaveSamples($paramwave->toCData());
}

/**
 * Unload samples data loaded with LoadWaveSamples()
 */
 function UnloadWaveSamples(array $paramsamples) : void
{
global $raylib;
$raylib->UnloadWaveSamples($paramsamples);
}

/**
 * Load music stream from file
 */
 function LoadMusicStream(string $paramfileName) : \Nawarian\Raylib\Generated\Music
{
global $raylib;
return \Nawarian\Raylib\Generated\Music::fromCData($raylib->LoadMusicStream($paramfileName));
}

/**
 * Load music stream from data
 */
 function LoadMusicStreamFromMemory(string $paramfileType, array $paramdata, int $paramdataSize) : \Nawarian\Raylib\Generated\Music
{
global $raylib;
return \Nawarian\Raylib\Generated\Music::fromCData($raylib->LoadMusicStreamFromMemory($paramfileType, $paramdata, $paramdataSize));
}

/**
 * Unload music stream
 */
 function UnloadMusicStream(\Nawarian\Raylib\Generated\Music $parammusic) : void
{
global $raylib;
$raylib->UnloadMusicStream($parammusic->toCData());
}

/**
 * Start music playing
 */
 function PlayMusicStream(\Nawarian\Raylib\Generated\Music $parammusic) : void
{
global $raylib;
$raylib->PlayMusicStream($parammusic->toCData());
}

/**
 * Check if music is playing
 */
 function IsMusicStreamPlaying(\Nawarian\Raylib\Generated\Music $parammusic) : bool
{
global $raylib;
return $raylib->IsMusicStreamPlaying($parammusic->toCData());
}

/**
 * Updates buffers for music streaming
 */
 function UpdateMusicStream(\Nawarian\Raylib\Generated\Music $parammusic) : void
{
global $raylib;
$raylib->UpdateMusicStream($parammusic->toCData());
}

/**
 * Stop music playing
 */
 function StopMusicStream(\Nawarian\Raylib\Generated\Music $parammusic) : void
{
global $raylib;
$raylib->StopMusicStream($parammusic->toCData());
}

/**
 * Pause music playing
 */
 function PauseMusicStream(\Nawarian\Raylib\Generated\Music $parammusic) : void
{
global $raylib;
$raylib->PauseMusicStream($parammusic->toCData());
}

/**
 * Resume playing paused music
 */
 function ResumeMusicStream(\Nawarian\Raylib\Generated\Music $parammusic) : void
{
global $raylib;
$raylib->ResumeMusicStream($parammusic->toCData());
}

/**
 * Set volume for music (1.0 is max level)
 */
 function SetMusicVolume(\Nawarian\Raylib\Generated\Music $parammusic, float $paramvolume) : void
{
global $raylib;
$raylib->SetMusicVolume($parammusic->toCData(), $paramvolume);
}

/**
 * Set pitch for a music (1.0 is base level)
 */
 function SetMusicPitch(\Nawarian\Raylib\Generated\Music $parammusic, float $parampitch) : void
{
global $raylib;
$raylib->SetMusicPitch($parammusic->toCData(), $parampitch);
}

/**
 * Get music time length (in seconds)
 */
 function GetMusicTimeLength(\Nawarian\Raylib\Generated\Music $parammusic) : float
{
global $raylib;
return $raylib->GetMusicTimeLength($parammusic->toCData());
}

/**
 * Get current music time played (in seconds)
 */
 function GetMusicTimePlayed(\Nawarian\Raylib\Generated\Music $parammusic) : float
{
global $raylib;
return $raylib->GetMusicTimePlayed($parammusic->toCData());
}

/**
 * Load audio stream (to stream raw audio pcm data)
 */
 function LoadAudioStream(int $paramsampleRate, int $paramsampleSize, int $paramchannels) : \Nawarian\Raylib\Generated\AudioStream
{
global $raylib;
return \Nawarian\Raylib\Generated\AudioStream::fromCData($raylib->LoadAudioStream($paramsampleRate, $paramsampleSize, $paramchannels));
}

/**
 * Unload audio stream and free memory
 */
 function UnloadAudioStream(\Nawarian\Raylib\Generated\AudioStream $paramstream) : void
{
global $raylib;
$raylib->UnloadAudioStream($paramstream->toCData());
}

/**
 * Update audio stream buffers with data
 */
 function UpdateAudioStream(\Nawarian\Raylib\Generated\AudioStream $paramstream, \FFI\CData $paramdata, int $paramsamplesCount) : void
{
global $raylib;
$raylib->UpdateAudioStream($paramstream->toCData(), $paramdata, $paramsamplesCount);
}

/**
 * Check if any audio stream buffers requires refill
 */
 function IsAudioStreamProcessed(\Nawarian\Raylib\Generated\AudioStream $paramstream) : bool
{
global $raylib;
return $raylib->IsAudioStreamProcessed($paramstream->toCData());
}

/**
 * Play audio stream
 */
 function PlayAudioStream(\Nawarian\Raylib\Generated\AudioStream $paramstream) : void
{
global $raylib;
$raylib->PlayAudioStream($paramstream->toCData());
}

/**
 * Pause audio stream
 */
 function PauseAudioStream(\Nawarian\Raylib\Generated\AudioStream $paramstream) : void
{
global $raylib;
$raylib->PauseAudioStream($paramstream->toCData());
}

/**
 * Resume audio stream
 */
 function ResumeAudioStream(\Nawarian\Raylib\Generated\AudioStream $paramstream) : void
{
global $raylib;
$raylib->ResumeAudioStream($paramstream->toCData());
}

/**
 * Check if audio stream is playing
 */
 function IsAudioStreamPlaying(\Nawarian\Raylib\Generated\AudioStream $paramstream) : bool
{
global $raylib;
return $raylib->IsAudioStreamPlaying($paramstream->toCData());
}

/**
 * Stop audio stream
 */
 function StopAudioStream(\Nawarian\Raylib\Generated\AudioStream $paramstream) : void
{
global $raylib;
$raylib->StopAudioStream($paramstream->toCData());
}

/**
 * Set volume for audio stream (1.0 is max level)
 */
 function SetAudioStreamVolume(\Nawarian\Raylib\Generated\AudioStream $paramstream, float $paramvolume) : void
{
global $raylib;
$raylib->SetAudioStreamVolume($paramstream->toCData(), $paramvolume);
}

/**
 * Set pitch for audio stream (1.0 is base level)
 */
 function SetAudioStreamPitch(\Nawarian\Raylib\Generated\AudioStream $paramstream, float $parampitch) : void
{
global $raylib;
$raylib->SetAudioStreamPitch($paramstream->toCData(), $parampitch);
}

/**
 * Default size for new audio streams
 */
 function SetAudioStreamBufferSizeDefault(int $paramsize) : void
{
global $raylib;
$raylib->SetAudioStreamBufferSizeDefault($paramsize);
}
