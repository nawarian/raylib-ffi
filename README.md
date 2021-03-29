Raylib FFI
---

Raylib bindings for PHP using [FFI](https://thephp.website/en/issue/php-ffi/).

## Usage

See [examples/](https://github.com/nawarian/raylib-ffi/tree/main/examples/) for full implementation examples.

Every program will look like the following at first:

```php
/**
 * The factory class will create an instance based on your
 * Operating System.
 */
$factory = new \Nawarian\Raylib\RaylibFactory();
$raylib = $factory->newInstance();

/**
 * You may normally call Raylib functions from the $raylib object now
 */
$raylib->initWindow(800, 600, 'My raylib Window');

$white = new \Nawarian\Raylib\Types\Color(255, 255, 255, 255);
$red = new \Nawarian\Raylib\Types\Color(255, 0, 0, 255);
while (!$raylib->windowShouldClose()) {
    $raylib->beginDrawing();
        $raylib->clearBackground($white);
        $raylib->drawText('Hello from raylib-ffi!', 400, 300, 20, $red);
    $raylib->endDrawing();
}

$raylib->closeWindow();
```

## Roadmap

Below you'll find the list of things to be developed in this project.

### Project

- [ ] Automatic checks on `main` and Pull Requests: compile raylib and test FFI against Linux, Windows and MacOS
- [x] Rename methods in `Raylib` to follow No Camel Caps convention (PSR-1)
- [ ] Make `RaylibFactory` detect current OS and load `raylib.h` accordingly
- [ ] Create a `functions.php` file that will mimic Raylib by registering global functions

### FFI Proxy

- [x] `void InitWindow(int width, int height, const char *title)`
- [x] `bool WindowShouldClose(void)`
- [x] `void CloseWindow(void)`
- [ ] `bool IsWindowReady(void)`
- [ ] `bool IsWindowFullscreen(void)`
- [ ] `bool IsWindowHidden(void)`
- [ ] `bool IsWindowMinimized(void)`
- [ ] `bool IsWindowMaximized(void)`
- [ ] `bool IsWindowFocused(void)`
- [ ] `bool IsWindowResized(void)`
- [ ] `bool IsWindowState(unsigned int flag)`
- [ ] `void SetWindowState(unsigned int flags)`
- [ ] `void ClearWindowState(unsigned int flags)`
- [ ] `void ToggleFullscreen(void)`
- [ ] `void MaximizeWindow(void)`
- [ ] `void MinimizeWindow(void)`
- [ ] `void RestoreWindow(void)`
- [ ] `void SetWindowIcon(Image image)`
- [ ] `void SetWindowTitle(const char *title)`
- [ ] `void SetWindowPosition(int x, int y)`
- [ ] `void SetWindowMonitor(int monitor)`
- [ ] `void SetWindowMinSize(int width, int height)`
- [ ] `void SetWindowSize(int width, int height)`
- [ ] `void *GetWindowHandle(void)`
- [ ] `int GetScreenWidth(void)`
- [ ] `int GetScreenHeight(void)`
- [ ] `int GetMonitorCount(void)`
- [ ] `Vector2 GetMonitorPosition(int monitor)`
- [ ] `int GetMonitorWidth(int monitor)`
- [ ] `int GetMonitorHeight(int monitor)`
- [ ] `int GetMonitorPhysicalWidth(int monitor)`
- [ ] `int GetMonitorPhysicalHeight(int monitor)`
- [ ] `int GetMonitorRefreshRate(int monitor)`
- [ ] `Vector2 GetWindowPosition(void)`
- [ ] `Vector2 GetWindowScaleDPI(void)`
- [ ] `const char *GetMonitorName(int monitor)`
- [ ] `void SetClipboardText(const char *text)`
- [ ] `const char *GetClipboardText(void)`
- [ ] `void ShowCursor(void)`
- [ ] `void HideCursor(void)`
- [ ] `bool IsCursorHidden(void)`
- [ ] `void EnableCursor(void)`
- [ ] `void DisableCursor(void)`
- [ ] `bool IsCursorOnScreen(void)`
- [x] `void ClearBackground(Color color)`
- [x] `void BeginDrawing(void)`
- [x] `void EndDrawing(void)`
- [x] `void BeginMode2D(Camera2D camera)`
- [x] `void EndMode2D(void)`
- [x] `void BeginMode3D(Camera3D camera)`
- [x] `void EndMode3D(void)`
- [ ] `void BeginTextureMode(RenderTexture2D target)`
- [ ] `void EndTextureMode(void)`
- [ ] `void BeginScissorMode(int x, int y, int width, int height)`
- [ ] `void EndScissorMode(void)`
- [ ] `Ray GetMouseRay(Vector2 mousePosition, Camera camera)`
- [ ] `Matrix GetCameraMatrix(Camera camera)`
- [ ] `Matrix GetCameraMatrix2D(Camera2D camera)`
- [ ] `Vector2 GetWorldToScreen(Vector3 position, Camera camera)`
- [ ] `Vector2 GetWorldToScreenEx(Vector3 position, Camera camera, int width, int height)`
- [x] `Vector2 GetWorldToScreen2D(Vector2 position, Camera2D camera)`
- [x] `Vector2 GetScreenToWorld2D(Vector2 position, Camera2D camera)`
- [x] `void SetTargetFPS(int fps)`
- [ ] `int GetFPS(void)`
- [x] `float GetFrameTime(void)`
- [ ] `double GetTime(void)`
- [ ] `void SetConfigFlags(unsigned int flags)`
- [ ] `void SetTraceLogLevel(int logType)`
- [ ] `void SetTraceLogExit(int logType)`
- [ ] `void SetTraceLogCallback(TraceLogCallback callback)`
- [ ] `void TraceLog(int logType, const char *text, ...)`
- [ ] `void *MemAlloc(int size)`
- [ ] `void MemFree(void *ptr)`
- [ ] `void TakeScreenshot(const char *fileName)`
- [x] `int GetRandomValue(int min, int max)`
- [ ] `unsigned char *LoadFileData(const char *fileName, unsigned int *bytesRead)`
- [ ] `void UnloadFileData(unsigned char *data)`
- [ ] `bool SaveFileData(const char *fileName, void *data, unsigned int bytesToWrite)`
- [ ] `char *LoadFileText(const char *fileName)`
- [ ] `void UnloadFileText(unsigned char *text)`
- [ ] `bool SaveFileText(const char *fileName, char *text)`
- [ ] `bool FileExists(const char *fileName)`
- [ ] `bool DirectoryExists(const char *dirPath)`
- [ ] `bool IsFileExtension(const char *fileName, const char *ext)`
- [ ] `const char *GetFileExtension(const char *fileName)`
- [ ] `const char *GetFileName(const char *filePath)`
- [ ] `const char *GetFileNameWithoutExt(const char *filePath)`
- [ ] `const char *GetDirectoryPath(const char *filePath)`
- [ ] `const char *GetPrevDirectoryPath(const char *dirPath)`
- [ ] `const char *GetWorkingDirectory(void)`
- [ ] `char **GetDirectoryFiles(const char *dirPath, int *count)`
- [ ] `void ClearDirectoryFiles(void)`
- [ ] `bool ChangeDirectory(const char *dir)`
- [ ] `bool IsFileDropped(void)`
- [ ] `char **GetDroppedFiles(int *count)`
- [ ] `void ClearDroppedFiles(void)`
- [ ] `long GetFileModTime(const char *fileName)`
- [ ] `unsigned char *CompressData(unsigned char *data, int dataLength, int *compDataLength)`
- [ ] `unsigned char *DecompressData(unsigned char *compData, int compDataLength, int *dataLength)`
- [ ] `bool SaveStorageValue(unsigned int position, int value)`
- [ ] `int LoadStorageValue(unsigned int position)`
- [ ] `void OpenURL(const char *url)`
- [x] `bool IsKeyPressed(int key)`
- [x] `bool IsKeyDown(int key)`
- [ ] `bool IsKeyReleased(int key)`
- [ ] `bool IsKeyUp(int key)`
- [ ] `void SetExitKey(int key)`
- [ ] `int GetKeyPressed(void)`
- [ ] `int GetCharPressed(void)`
- [ ] `bool IsGamepadAvailable(int gamepad)`
- [ ] `bool IsGamepadName(int gamepad, const char *name)`
- [ ] `const char *GetGamepadName(int gamepad)`
- [ ] `bool IsGamepadButtonPressed(int gamepad, int button)`
- [ ] `bool IsGamepadButtonDown(int gamepad, int button)`
- [ ] `bool IsGamepadButtonReleased(int gamepad, int button)`
- [ ] `bool IsGamepadButtonUp(int gamepad, int button)`
- [ ] `int GetGamepadButtonPressed(void)`
- [ ] `int GetGamepadAxisCount(int gamepad)`
- [ ] `float GetGamepadAxisMovement(int gamepad, int axis)`
- [ ] `bool IsMouseButtonPressed(int button)`
- [ ] `bool IsMouseButtonDown(int button)`
- [ ] `bool IsMouseButtonReleased(int button)`
- [ ] `bool IsMouseButtonUp(int button)`
- [ ] `int GetMouseX(void)`
- [ ] `int GetMouseY(void)`
- [ ] `Vector2 GetMousePosition(void)`
- [ ] `void SetMousePosition(int x, int y)`
- [ ] `void SetMouseOffset(int offsetX, int offsetY)`
- [ ] `void SetMouseScale(float scaleX, float scaleY)`
- [x] `float GetMouseWheelMove(void)`
- [ ] `int GetMouseCursor(void)`
- [ ] `void SetMouseCursor(int cursor)`
- [ ] `int GetTouchX(void)`
- [ ] `int GetTouchY(void)`
- [ ] `Vector2 GetTouchPosition(int index)`
- [x] `void DrawLine(int startPosX, int startPosY, int endPosX, int endPosY, Color color)`
- [x] `void DrawRectangle(int posX, int posY, int width, int height, Color color)`
- [x] `void DrawRectangleLines(int posX, int posY, int width, int height, Color color)`
- [x] `void DrawRectangleRec(Rectangle rec, Color color)`
- [x] `void DrawText(const char *text, int posX, int posY, int fontSize, Color color)`
- [x] `void DrawCube(Vector3 position, float width, float height, float length, Color color);`
- [x] `void DrawCubeWires(Vector3 position, float width, float height, float length, Color color);`
- [x] `void DrawPlane(Vector3 centerPos, Vector2 size, Color color);`
- [x] `Color Fade(Color color, float alpha)`

### Ray Math

- [ ] `float Clamp(float value, float min, float max)`
- [ ] `float Lerp(float start, float end, float amount)`
- [ ] `float Normalize(float value, float start, float end)`
- [ ] `float Remap(float value, float inputStart, float inputEnd, float outputStart, float outputEnd)`
- [ ] `Vector2 Vector2Zero(void)`
- [ ] `Vector2 Vector2One(void)`
- [x] `Vector2 Vector2Add(Vector2 v1, Vector2 v2)`
- [ ] `Vector2 Vector2AddValue(Vector2 v, float add)`
- [x] `Vector2 Vector2Subtract(Vector2 v1, Vector2 v2)`
- [ ] `Vector2 Vector2SubtractValue(Vector2 v, float sub)`
- [x] `float Vector2Length(Vector2 v)`
- [ ] `float Vector2LengthSqr(Vector2 v)`
- [ ] `float Vector2DotProduct(Vector2 v1, Vector2 v2)`
- [ ] `float Vector2Distance(Vector2 v1, Vector2 v2)`
- [ ] `float Vector2Angle(Vector2 v1, Vector2 v2)`
- [x] `Vector2 Vector2Scale(Vector2 v, float scale)`
- [ ] `Vector2 Vector2Multiply(Vector2 v1, Vector2 v2)`
- [ ] `Vector2 Vector2Negate(Vector2 v)`
- [ ] `Vector2 Vector2Divide(Vector2 v1, Vector2 v2)`
- [ ] `Vector2 Vector2Normalize(Vector2 v)`
- [ ] `Vector2 Vector2Lerp(Vector2 v1, Vector2 v2, float amount)`
- [ ] `Vector2 Vector2Reflect(Vector2 v, Vector2 normal)`
- [ ] `Vector2 Vector2Rotate(Vector2 v, float degs)`
- [ ] `Vector2 Vector2MoveTowards(Vector2 v, Vector2 target, float maxDistance)`
- [ ] `Vector3 Vector3Zero(void)`
- [ ] `Vector3 Vector3One(void)`
- [ ] `Vector3 Vector3Add(Vector3 v1, Vector3 v2)`
- [ ] `Vector3 Vector3AddValue(Vector3 v, float add)`
- [ ] `Vector3 Vector3Subtract(Vector3 v1, Vector3 v2)`
- [ ] `Vector3 Vector3SubtractValue(Vector3 v, float sub)`
- [ ] `Vector3 Vector3Scale(Vector3 v, float scalar)`
- [ ] `Vector3 Vector3Multiply(Vector3 v1, Vector3 v2)`
- [ ] `Vector3 Vector3CrossProduct(Vector3 v1, Vector3 v2)`
- [ ] `Vector3 Vector3Perpendicular(Vector3 v)`
- [ ] `float Vector3Length(const Vector3 v)`
- [ ] `float Vector3LengthSqr(const Vector3 v)`
- [ ] `float Vector3DotProduct(Vector3 v1, Vector3 v2)`
- [ ] `float Vector3Distance(Vector3 v1, Vector3 v2)`
- [ ] `Vector3 Vector3Negate(Vector3 v)`
- [ ] `Vector3 Vector3Divide(Vector3 v1, Vector3 v2)`
- [ ] `Vector3 Vector3Normalize(Vector3 v)`
- [ ] `void Vector3OrthoNormalize(Vector3 *v1, Vector3 *v2)`
- [ ] `Vector3 Vector3Transform(Vector3 v, Matrix mat)`
- [ ] `Vector3 Vector3RotateByQuaternion(Vector3 v, Quaternion q)`
- [ ] `Vector3 Vector3Lerp(Vector3 v1, Vector3 v2, float amount)`
- [ ] `Vector3 Vector3Reflect(Vector3 v, Vector3 normal)`
- [ ] `Vector3 Vector3Min(Vector3 v1, Vector3 v2)`
- [ ] `Vector3 Vector3Max(Vector3 v1, Vector3 v2)`
- [ ] `Vector3 Vector3Barycenter(Vector3 p, Vector3 a, Vector3 b, Vector3 c)`
- [ ] `float3 Vector3ToFloatV(Vector3 v)`
- [ ] `float MatrixDeterminant(Matrix mat)`
- [ ] `float MatrixTrace(Matrix mat)`
- [ ] `Matrix MatrixTranspose(Matrix mat)`
- [ ] `Matrix MatrixInvert(Matrix mat)`
- [ ] `Matrix MatrixNormalize(Matrix mat)`
- [ ] `Matrix MatrixIdentity(void)`
- [ ] `Matrix MatrixAdd(Matrix left, Matrix right)`
- [ ] `Matrix MatrixSubtract(Matrix left, Matrix right)`
- [ ] `Matrix MatrixMultiply(Matrix left, Matrix right)`
- [ ] `Matrix MatrixTranslate(float x, float y, float z)`
- [ ] `Matrix MatrixRotate(Vector3 axis, float angle)`
- [ ] `Matrix MatrixRotateX(float angle)`
- [ ] `Matrix MatrixRotateY(float angle)`
- [ ] `Matrix MatrixRotateZ(float angle)`
- [ ] `Matrix MatrixRotateXYZ(Vector3 ang)`
- [ ] `Matrix MatrixRotateZYX(Vector3 ang)`
- [ ] `Matrix MatrixScale(float x, float y, float z)`
- [ ] `Matrix MatrixFrustum(double left, double right, double bottom, double top, double near, double far)`
- [ ] `Matrix MatrixPerspective(double fovy, double aspect, double near, double far)`
- [ ] `Matrix MatrixOrtho(double left, double right, double bottom, double top, double near, double far)`
- [ ] `Matrix MatrixLookAt(Vector3 eye, Vector3 target, Vector3 up)`
- [ ] `float16 MatrixToFloatV(Matrix mat)`
- [ ] `Quaternion QuaternionAdd(Quaternion q1, Quaternion q2)`
- [ ] `Quaternion QuaternionAddValue(Quaternion q, float add)`
- [ ] `Quaternion QuaternionSubtract(Quaternion q1, Quaternion q2)`
- [ ] `Quaternion QuaternionSubtractValue(Quaternion q, float sub)`
- [ ] `Quaternion QuaternionIdentity(void)`
- [ ] `float QuaternionLength(Quaternion q)`
- [ ] `Quaternion QuaternionNormalize(Quaternion q)`
- [ ] `Quaternion QuaternionInvert(Quaternion q)`
- [ ] `Quaternion QuaternionMultiply(Quaternion q1, Quaternion q2)`
- [ ] `Quaternion QuaternionScale(Quaternion q, float mul)`
- [ ] `Quaternion QuaternionDivide(Quaternion q1, Quaternion q2)`
- [ ] `Quaternion QuaternionLerp(Quaternion q1, Quaternion q2, float amount)`
- [ ] `Quaternion QuaternionNlerp(Quaternion q1, Quaternion q2, float amount)`
- [ ] `Quaternion QuaternionSlerp(Quaternion q1, Quaternion q2, float amount)`
- [ ] `Quaternion QuaternionFromVector3ToVector3(Vector3 from, Vector3 to)`
- [ ] `Quaternion QuaternionFromMatrix(Matrix mat)`
- [ ] `Matrix QuaternionToMatrix(Quaternion q)`
- [ ] `Quaternion QuaternionFromAxisAngle(Vector3 axis, float angle)`
- [ ] `void QuaternionToAxisAngle(Quaternion q, Vector3 *outAxis, float *outAngle)`
- [ ] `Quaternion QuaternionFromEuler(float pitch, float yaw, float roll)`
- [ ] `Vector3 QuaternionToEuler(Quaternion q)`
- [ ] `Quaternion QuaternionTransform(Quaternion q, Matrix mat)`
- [ ] `Vector3 Vector3Unproject(Vector3 source, Matrix projection, Matrix view)`

### Examples

- [ ] audio/audio_module_playing.php
- [ ] audio/audio_multichannel_sound.php
- [ ] audio/audio_music_stream.php
- [ ] audio/audio_raw_stream.php
- [ ] audio/audio_sound_loading.php
- [x] [core/core_2d_camera.php](https://github.com/nawarian/raylib-ffi/blob/main/examples/core/core_2d_camera.php)
- [x] [core/core_2d_camera_platformer.php](https://github.com/raylib-ffi/blob/main/examples/core/core_2d_camera_platformer.php)
- [ ] core/core_3d_camera_first_person.php
- [ ] core/core_3d_camera_free.php
- [ ] core/core_3d_camera_mode.php
- [ ] core/core_3d_picking.php
- [ ] core/core_basic_window.php
- [ ] core/core_basic_window_web.php
- [ ] core/core_custom_logging.php
- [ ] core/core_drop_files.php
- [ ] core/core_input_gamepad.php
- [ ] core/core_input_gestures.php
- [ ] core/core_input_keys.php
- [ ] core/core_input_mouse.php
- [ ] core/core_input_mouse_wheel.php
- [ ] core/core_input_multitouch.php
- [ ] core/core_loading_thread.php
- [ ] core/core_quat_conversion.php
- [ ] core/core_random_values.php
- [ ] core/core_scissor_test.php
- [ ] core/core_storage_values.php
- [ ] core/core_vr_simulator.php
- [ ] core/core_window_flags.php
- [ ] core/core_window_letterbox.php
- [ ] core/core_world_screen.php
- [ ] models/models_animation.php
- [ ] models/models_billboard.php
- [ ] models/models_box_collisions.php
- [ ] models/models_cubicmap.php
- [ ] models/models_first_person_maze.php
- [ ] models/models_geometric_shapes.php
- [ ] models/models_gltf_animation.php
- [ ] models/models_gltf_model.php
- [ ] models/models_heightmap.php
- [ ] models/models_loading.php
- [ ] models/models_material_pbr.php
- [ ] models/models_mesh_generation.php
- [ ] models/models_mesh_picking.php
- [ ] models/models_orthographic_projection.php
- [ ] models/models_rlgl_solar_system.php
- [ ] models/models_skybox.php
- [ ] models/models_waving_cubes.php
- [ ] models/models_yaw_pitch_roll.php
- [ ] physics/physics_demo.php
- [ ] physics/physics_friction.php
- [ ] physics/physics_movement.php
- [ ] physics/physics_restitution.php
- [ ] physics/physics_shatter.php
- [ ] shaders/shaders_basic_lighting.php
- [ ] shaders/shaders_custom_uniform.php
- [ ] shaders/shaders_eratosthenes.php
- [ ] shaders/shaders_fog.php
- [ ] shaders/shaders_hot_reloading.php
- [ ] shaders/shaders_julia_set.php
- [ ] shaders/shaders_model_shader.php
- [ ] shaders/shaders_multi_sample2d.php
- [ ] shaders/shaders_palette_switch.php
- [ ] shaders/shaders_postprocessing.php
- [ ] shaders/shaders_raymarching.php
- [ ] shaders/shaders_rlgl_mesh_instanced.php
- [ ] shaders/shaders_shapes_textures.php
- [ ] shaders/shaders_simple_mask.php
- [ ] shaders/shaders_spotlight.php
- [ ] shaders/shaders_texture_drawing.php
- [ ] shaders/shaders_texture_waves.php
- [ ] shapes/shapes_basic_shapes.php
- [ ] shapes/shapes_bouncing_ball.php
- [ ] shapes/shapes_collision_area.php
- [ ] shapes/shapes_colors_palette.php
- [ ] shapes/shapes_draw_circle_sector.php
- [ ] shapes/shapes_draw_rectangle_rounded.php
- [ ] shapes/shapes_draw_ring.php
- [ ] shapes/shapes_easings_ball_anim.php
- [ ] shapes/shapes_easings_box_anim.php
- [ ] shapes/shapes_easings_rectangle_array.php
- [ ] shapes/shapes_following_eyes.php
- [ ] shapes/shapes_lines_bezier.php
- [ ] shapes/shapes_logo_raylib.php
- [ ] shapes/shapes_logo_raylib_anim.php
- [ ] shapes/shapes_rectangle_scaling.php
- [ ] text/text_font_filters.php
- [ ] text/text_font_loading.php
- [ ] text/text_font_sdf.php
- [ ] text/text_font_spritefont.php
- [ ] text/text_format_text.php
- [ ] text/text_input_box.php
- [ ] text/text_raylib_fonts.php
- [ ] text/text_rectangle_bounds.php
- [ ] text/text_unicode.php
- [ ] text/text_writing_anim.php
- [ ] textures/textures_background_scrolling.php
- [ ] textures/textures_blend_modes.php
- [ ] textures/textures_bunnymark.php
- [ ] textures/textures_draw_tiled.php
- [ ] textures/textures_image_drawing.php
- [ ] textures/textures_image_generation.php
- [ ] textures/textures_image_loading.php
- [ ] textures/textures_image_processing.php
- [ ] textures/textures_image_text.php
- [ ] textures/textures_logo_raylib.php
- [ ] textures/textures_mouse_painting.php
- [ ] textures/textures_npatch_drawing.php
- [ ] textures/textures_particles_blending.php
- [ ] textures/textures_poly.php
- [ ] textures/textures_raw_data.php
- [ ] textures/textures_rectangle.php
- [ ] textures/textures_sprite_button.php
- [ ] textures/textures_sprite_explosion.php
- [ ] textures/textures_srcrec_dstrec.php
- [ ] textures/textures_to_image.php
