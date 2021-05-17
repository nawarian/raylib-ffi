<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib;

use FFI;
use FFI\CData;
use Nawarian\Raylib\{
    Raylib,
    RaylibFFIProxy,
};
use Nawarian\Raylib\Types\{BoundingBox, Camera2D, Camera3D, Color, Image, Ray, Rectangle, Texture2D, Vector2, Vector3};
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Argument\Token\CallbackToken;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class RaylibTest extends TestCase
{
    use ProphecyTrait;

    private FFI $ffi;
    private ObjectProphecy $ffiProxy;
    private Raylib $raylib;

    protected function setUp(): void
    {
        $ffi = FFI::load(__DIR__ . '/resources/raylib.h');
        $this->ffi = $ffi;
        $this->ffiProxy = $this->prophesize(RaylibFFIProxy::class);

        $this->ffiProxy->new(Argument::any())
            ->will(function (array $args) use ($ffi) {
                return $ffi->new($args[0]);
            });

        $this->raylib = new Raylib(
            $this->ffiProxy->reveal(),
        );
    }

    public function test_beginBlendMode(): void
    {
        $this->ffiProxy->BeginBlendMode(Raylib::BLEND_ADDITIVE)
            ->shouldBeCalledOnce();

        $this->raylib->beginBlendMode(Raylib::BLEND_ADDITIVE);
    }

    public function test_beginDrawing(): void
    {
        $this->ffiProxy->BeginDrawing()
            ->shouldBeCalledOnce();

        $this->raylib->beginDrawing();
    }

    public function test_beginMode2D_convertsCamera2DToCData(): void
    {
        $camera = new Camera2D(new Vector2(0, 0), new Vector2(0, 0), 0.0, 0.0);

        $expectedStruct = $this->ffi->new('Camera2D');
        $this->ffiProxy->BeginMode2D($this->sameCDataCamera2DArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->beginMode2D($camera);
    }

    public function test_beginMode3D_convertsCamera3DToCData(): void
    {
        $camera = new Camera3D(
            new Vector3(0, 0, 0),
            new Vector3(1, 1, 1),
            new Vector3(2, 2, 2),
            10.0,
            5,
        );

        $expectedStruct = $this->ffi->new('Camera3D');
        $expectedStruct->target->x = 1;
        $expectedStruct->target->y = 1;
        $expectedStruct->target->z = 1;
        $expectedStruct->up->x = 2;
        $expectedStruct->up->y = 2;
        $expectedStruct->up->z = 2;
        $expectedStruct->fovy = 10.0;
        $expectedStruct->type = 5;

        $this->ffiProxy->BeginMode3D(
            $this->sameCDataCamera3DArgument($expectedStruct)
        )->shouldBeCalledOnce();

        $this->raylib->beginMode3D($camera);
    }

    public function test_beginScissorMode(): void
    {
        $this->ffiProxy->BeginScissorMode(10, 20, 30, 40)
            ->shouldBeCalledOnce();

        $this->raylib->beginScissorMode(10, 20, 30,40);
    }

    public function test_checkCollisionRayBox_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $ray = new Ray(new Vector3(0, 0, 0), new Vector3(0, 0, 0));
        $box = new BoundingBox(new Vector3(1, 1, 1), new Vector3(1, 1, 1));

        $expectedRayStruct = $this->ffi->new('Ray');
        $expectedBoxStruct = $this->ffi->new('BoundingBox');
        $expectedBoxStruct->min->x = 1;
        $expectedBoxStruct->min->y = 1;
        $expectedBoxStruct->min->z = 1;
        $expectedBoxStruct->max->x = 1;
        $expectedBoxStruct->max->y = 1;
        $expectedBoxStruct->max->z = 1;

        $this->ffiProxy->CheckCollisionRayBox(
            $this->sameCDataRayArgument($expectedRayStruct),
            $this->sameCDataBoundingBoxArgument($expectedBoxStruct),
        )->willReturn(true)->shouldBeCalledOnce();

        self::assertTrue($this->raylib->checkCollisionRayBox($ray, $box));
    }

    public function test_clearBackground_convertsColorToCData(): void
    {
        $color = new Color(0, 0, 0, 0);
        $expectedStruct = $this->ffi->new('Color');

        $this->ffiProxy->ClearBackground($this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->clearBackground($color);
    }

    public function test_closeWindow(): void
    {
        $this->ffiProxy->CloseWindow()
            ->shouldBeCalledOnce();

        $this->raylib->closeWindow();
    }

    public function test_drawCube_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $position = new Vector3(5, 10, 15);
        $color = new Color(0, 0, 0, 0);

        $expectedColorStruct = $this->ffi->new('Color');
        $expectedVector3Struct = $this->ffi->new('Vector3');
        $expectedVector3Struct->x = 5;
        $expectedVector3Struct->y = 10;
        $expectedVector3Struct->z = 15;

        $this->ffiProxy->DrawCube(
            $this->sameCDataVector3Argument($expectedVector3Struct),
            10,
            20,
            30,
            $this->sameCDataColorArgument($expectedColorStruct),
            )->shouldBeCalledOnce();

        $this->raylib->drawCube($position, 10, 20, 30, $color);
    }

    public function test_drawCubeWires_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $position = new Vector3(5, 10, 15);
        $color = new Color(0, 0, 0, 0);

        $expectedColorStruct = $this->ffi->new('Color');
        $expectedVector3Struct = $this->ffi->new('Vector3');
        $expectedVector3Struct->x = 5;
        $expectedVector3Struct->y = 10;
        $expectedVector3Struct->z = 15;

        $this->ffiProxy->DrawCubeWires(
            $this->sameCDataVector3Argument($expectedVector3Struct),
            10,
            20,
            30,
            $this->sameCDataColorArgument($expectedColorStruct),
            )->shouldBeCalledOnce();

        $this->raylib->drawCubeWires($position, 10, 20, 30, $color);
    }

    public function test_drawFPS_respectsParameterOrder(): void
    {
        $this->ffiProxy->DrawFPS(15, 30)
            ->shouldBeCalledOnce();

        $this->raylib->drawFPS(15, 30);
    }

    public function test_drawGrid_respectsParameterOrder(): void
    {
        $this->ffiProxy->DrawGrid(10, 20.0)
            ->shouldBeCalledOnce();

        $this->raylib->drawGrid(10, 20.0);
    }

    public function test_drawLine_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $color = new Color(0, 0, 0, 0);

        $expectedStruct = $this->ffi->new('Color');
        $this->ffiProxy->DrawLine(10, 20,30, 40, $this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->drawLine(10, 20, 30 ,40, $color);
    }

    public function test_drawPlane_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $center = new Vector3(5, 10, 15);
        $size = new Vector2(20, 40);
        $color = new Color(0, 0, 0, 0);

        $expectedCenterStruct = $this->ffi->new('Vector3');
        $expectedCenterStruct->x = 5;
        $expectedCenterStruct->y = 10;
        $expectedCenterStruct->z = 15;
        $expectedSizeStruct = $this->ffi->new('Vector2');
        $expectedSizeStruct->x = 20;
        $expectedSizeStruct->y = 40;
        $expectedColorStruct = $this->ffi->new('Color');

        $this->ffiProxy->DrawPlane(
            $this->sameCDataVector3Argument($expectedCenterStruct),
            $this->sameCDataVector2Argument($expectedSizeStruct),
            $this->sameCDataColorArgument($expectedColorStruct),
        )->shouldBeCalledOnce();

        $this->raylib->drawPlane($center, $size, $color);
    }

    public function test_drawRay_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $ray = new Ray(new Vector3(0, 0, 0), new Vector3(0, 0, 0));
        $color = new Color(0, 0, 0, 0);

        $expectedRay = $this->ffi->new('Ray');
        $expectedColor = $this->ffi->new('Color');

        $this->ffiProxy->DrawRay(
            $this->sameCDataRayArgument($expectedRay),
            $this->sameCDataColorArgument($expectedColor),
        )->shouldBeCalledOnce();

        $this->raylib->drawRay($ray, $color);
    }

    public function test_drawRectangle_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $color = new Color(0, 0, 0, 0);

        $expectedStruct = $this->ffi->new('Color');
        $this->ffiProxy->DrawRectangle(10, 20, 30, 40, $this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->drawRectangle(10, 20, 30, 40, $color);
    }

    public function test_drawRectangleLines_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $color = new Color(0, 0, 0, 0);

        $expectedStruct = $this->ffi->new('Color');
        $this->ffiProxy->DrawRectangleLines(10, 20, 30, 40, $this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->drawRectangleLines(10, 20, 30, 40, $color);
    }

    public function test_drawRectangleLinesEx_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $rectangle = new Rectangle(10, 20, 30, 40);
        $color = new Color(0, 0, 0, 0);

        $expectedRectangle = $this->ffi->new('Rectangle');
        $expectedRectangle->x = 10;
        $expectedRectangle->y = 20;
        $expectedRectangle->width = 30;
        $expectedRectangle->height = 40;
        $expectedColor = $this->ffi->new('Color');
        $this->ffiProxy->DrawRectangleLinesEx(
            $this->sameCDataRectangleArgument($expectedRectangle),
            10,
            $this->sameCDataColorArgument($expectedColor)
        )->shouldBeCalledOnce();

        $this->raylib->drawRectangleLinesEx($rectangle, 10, $color);
    }

    public function test_drawRectangleRec_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $rectangle = new Rectangle(0, 0, 0, 0);
        $color = new Color(0, 0, 0, 0);

        $expectedRectangleStruct = $this->ffi->new('Rectangle');
        $expectedColorStruct = $this->ffi->new('Color');
        $this->ffiProxy->DrawRectangleRec(
            $this->sameCDataRectangleArgument($expectedRectangleStruct),
            $this->sameCDataColorArgument($expectedColorStruct),
        )->shouldBeCalledOnce();

        $this->raylib->drawRectangleRec($rectangle, $color);
    }

    public function test_drawText_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $color = new Color(0, 0, 0, 0);

        $expectedStruct = $this->ffi->new('Color');
        $this->ffiProxy->DrawText('abc', 10, 20, 30, $this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->drawText('abc', 10, 20, 30, $color);
    }

    public function test_drawTexture_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $texture = new Texture2D(0, 0, 0, 0, 0);
        $tint = new Color(255, 0, 0, 0);

        $expectedTexture = $this->ffi->new('Texture');
        $expectedTint = $this->ffi->new('Color');
        $expectedTint->r = 255;

        $this->ffiProxy->DrawTexture(
            $this->sameCDataTexture2DArgument($expectedTexture),
            10,
            20,
            $this->sameCDataColorArgument($expectedTint),
        )->shouldBeCalledOnce();

        $this->raylib->drawTexture($texture, 10, 20, $tint);
    }

    public function test_drawTextureEx_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $texture = new Texture2D(0, 0, 0, 0, 0);
        $position = new Vector2(0, 0);
        $tint = new Color(255, 0, 0, 0);

        $expectedTexture = $this->ffi->new('Texture');
        $expectedPosition = $this->ffi->new('Vector2');
        $expectedTint = $this->ffi->new('Color');
        $expectedTint->r = 255;

        $this->ffiProxy->DrawTextureEx(
            $this->sameCDataTexture2DArgument($expectedTexture),
            $this->sameCDataVector2Argument($expectedPosition),
            20,
            30,
            $this->sameCDataColorArgument($expectedTint),
        )->shouldBeCalledOnce();

        $this->raylib->drawTextureEx($texture, $position, 20, 30, $tint);
    }

    public function test_drawTextureTiled_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $texture = new Texture2D(0, 0, 0, 0, 0);
        $source = new Rectangle(0, 0, 0, 0);
        $dest = new Rectangle(0, 0, 0, 0);
        $origin = new Vector2(0, 0);
        $tint = new Color(255, 0, 0, 0);

        $expectedTexture = $this->ffi->new('Texture');
        $expectedSource = $this->ffi->new('Rectangle');
        $expectedDest = $this->ffi->new('Rectangle');
        $expectedOrigin = $this->ffi->new('Vector2');
        $expectedTint = $this->ffi->new('Color');
        $expectedTint->r = 255;

        $this->ffiProxy->DrawTextureTiled(
            $this->sameCDataTexture2DArgument($expectedTexture),
            $this->sameCDataRectangleArgument($expectedSource),
            $this->sameCDataRectangleArgument($expectedDest),
            $this->sameCDataVector2Argument($expectedOrigin),
            20,
            30,
            $this->sameCDataColorArgument($expectedTint),
        )->shouldBeCalledOnce();

        $this->raylib->drawTextureTiled($texture, $source, $dest, $origin, 20, 30, $tint);
    }

    public function test_endBlendMode(): void
    {
        $this->ffiProxy->EndBlendMode()
            ->shouldBeCalledOnce();

        $this->raylib->endBlendMode();
    }

    public function test_endDrawing(): void
    {
        $this->ffiProxy->EndDrawing()
            ->shouldBeCalledOnce();

        $this->raylib->endDrawing();
    }

    public function test_endMode2D(): void
    {
        $this->ffiProxy->EndMode2D()
            ->shouldBeCalledOnce();

        $this->raylib->endMode2D();
    }

    public function test_endMode3D(): void
    {
        $this->ffiProxy->EndMode3D()
            ->shouldBeCalledOnce();

        $this->raylib->endMode3D();
    }

    public function test_endScissorMode(): void
    {
        $this->ffiProxy->EndScissorMode()
            ->shouldBeCalledOnce();

        $this->raylib->endScissorMode();
    }

    public function test_fade_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $color = new Color(255, 0, 0, 155);
        $expectedStruct = $this->ffi->new('Color');
        $this->ffiProxy->Fade($expectedStruct, 20)
            ->shouldBeCalledOnce()
            ->willReturn($expectedStruct);

        self::assertEquals(
            new Color(0, 0, 0, 0),
            $this->raylib->fade($color, 20),
        );
    }

    public function test_getColor(): void
    {
        $expectedColor = $this->ffi->new('Color');
        $expectedColor->g = 255;
        $expectedColor->a = 255;

        $this->ffiProxy->GetColor(0x00ff00ff)
            ->shouldBeCalledOnce()
            ->willReturn($expectedColor);

        self::assertEquals(new Color(0, 255,0, 255), $this->raylib->getColor(0x00ff00ff));
    }

    public function test_getFrameTime(): void
    {
        $this->ffiProxy->GetFrameTime()
            ->shouldBeCalledOnce()
            ->willReturn(10.0);

        self::assertEquals(10.0, $this->raylib->getFrameTime());
    }

    public function test_getMousePosition(): void
    {
        $vector2Struct = $this->ffi->new('Vector2');
        $vector2Struct->x = 10;

        $this->ffiProxy->GetMousePosition()
            ->shouldBeCalledOnce()
            ->willReturn($vector2Struct);

        self::assertEquals(new Vector2(10, 0), $this->raylib->getMousePosition());
    }

    public function test_GetMouseRay(): void
    {
        $mousePosition = new Vector2(0, 0);
        $camera = new Camera3D(
            new Vector3(0, 0, 0),
            new Vector3(0, 0, 0),
            new Vector3(0, 0, 0),
            10.0,
            Camera3D::PROJECTION_PERSPECTIVE,
        );

        $mousePositionStruct = $this->ffi->new('Vector2');
        $cameraStruct = $this->ffi->new('Camera3D');
        $cameraStruct->fovy = 10.0;

        $expectedRayStruct = $this->ffi->new('Ray');

        $this->ffiProxy->GetMouseRay(
            $this->sameCDataVector2Argument($mousePositionStruct),
            $this->sameCDataCamera3DArgument($cameraStruct),
        )->willReturn($expectedRayStruct)->shouldBeCalledOnce();

        $ray = $this->raylib->getMouseRay($mousePosition, $camera);
        self::assertEquals(new Ray(new Vector3(0, 0, 0), new Vector3(0, 0, 0)), $ray);
    }

    public function test_getMouseWheelMove(): void
    {
        $this->ffiProxy->GetMouseWheelMove()
            ->shouldBeCalledOnce()
            ->willReturn(1.0);

        self::assertEquals(1.0, $this->raylib->getMouseWheelMove());
    }

    public function test_getMouseX(): void
    {
        $this->ffiProxy->GetMouseX()
            ->shouldBeCalledOnce()
            ->willReturn(10);

        self::assertEquals(10, $this->raylib->getMouseX());
    }

    public function test_getMouseY(): void
    {
        $this->ffiProxy->GetMouseY()
            ->shouldBeCalledOnce()
            ->willReturn(10);

        self::assertEquals(10, $this->raylib->getMouseY());
    }

    /**
     * @method DrawText(string $text, int $x, int $y, int $fontSize, FFI\CData $color): void
     * @method Fade(FFI\CData $color, float $alpha): FFI\CData
     */
    public function test_getRandomValue_respectsParameterOrder(): void
    {
        $this->ffiProxy->GetRandomValue(10, 20)
            ->shouldBeCalledOnce()
            ->willReturn(15);

        self::assertEquals(15, $this->raylib->getRandomValue(10, 20));
    }

    public function test_getScreenToWorld2D_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $expectedPosition = $this->ffi->new('Vector2');
        $expectedPosition->x = 5;
        $expectedPosition->y = 5;

        $expectedStruct = $this->ffi->new('Vector2');
        $expectedStruct->x = 10;
        $expectedStruct->y = 20;

        $this->ffiProxy->GetScreenToWorld2D(
            $this->sameCDataVector2Argument($expectedPosition),
            $this->sameCDataCamera2DArgument($this->ffi->new('Camera2D')),
            )->shouldBeCalledOnce()->willReturn($expectedStruct);

        $position = new Vector2(5, 5);
        $camera = new Camera2D(new Vector2(0, 0), new Vector2(0, 0), 0, 0);
        self::assertEquals(new Vector2(10, 20), $this->raylib->getScreenToWorld2D($position, $camera));
    }

    public function test_getWorldToScreen_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $expectedPosition = $this->ffi->new('Vector3');
        $expectedPosition->x = 5;
        $expectedPosition->y = 5;
        $expectedPosition->z = 5;

        $expectedStruct = $this->ffi->new('Vector2');
        $expectedStruct->x = 10;
        $expectedStruct->y = 20;

        $this->ffiProxy->GetWorldToScreen(
            $this->sameCDataVector3Argument($expectedPosition),
            $this->sameCDataCamera3DArgument($this->ffi->new('Camera3D')),
        )->shouldBeCalledOnce()->willReturn($expectedStruct);

        $position = new Vector3(5, 5, 5);
        $camera = new Camera3D(new Vector3(0, 0, 0), new Vector3(0, 0, 0), new Vector3(0, 0, 0), 0, 0);
        self::assertEquals(new Vector2(10, 20), $this->raylib->getWorldToScreen($position, $camera));
    }

    public function test_getWorldToScreen2D_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $expectedPosition = $this->ffi->new('Vector2');
        $expectedPosition->x = 5;
        $expectedPosition->y = 5;

        $expectedStruct = $this->ffi->new('Vector2');
        $expectedStruct->x = 10;
        $expectedStruct->y = 20;

        $this->ffiProxy->GetWorldToScreen2D(
            $this->sameCDataVector2Argument($expectedPosition),
            $this->sameCDataCamera2DArgument($this->ffi->new('Camera2D')),
        )->shouldBeCalledOnce()->willReturn($expectedStruct);

        $position = new Vector2(5, 5);
        $camera = new Camera2D(new Vector2(0, 0), new Vector2(0, 0), 0, 0);
        self::assertEquals(new Vector2(10, 20), $this->raylib->getWorldToScreen2D($position, $camera));
    }

    public function test_getScreenWidth(): void
    {
        $this->ffiProxy->GetScreenWidth()
            ->shouldBeCalledOnce()
            ->willReturn(10);

        self::assertEquals(10, $this->raylib->getScreenWidth());
    }

    public function test_getScreenHeight(): void
    {
        $this->ffiProxy->GetScreenHeight()
            ->shouldBeCalledOnce()
            ->willReturn(10);

        self::assertEquals(10, $this->raylib->getScreenHeight());
    }

    public function test_initWindow_respectsParameterOrder(): void
    {
        $this->ffiProxy->InitWindow(800, 600, 'My Test')
            ->shouldBeCalledOnce();

        $this->raylib->initWindow(800, 600, 'My Test');
    }

    public function test_isKeyDown(): void
    {
        $this->ffiProxy->IsKeyDown(10)
            ->shouldBeCalledOnce()
            ->willReturn(true);

        self::assertTrue($this->raylib->isKeyDown(10));
    }

    public function test_isKeyPressed(): void
    {
        $this->ffiProxy->IsKeyPressed(10)
            ->shouldBeCalledOnce()
            ->willReturn(true);

        self::assertTrue($this->raylib->isKeyPressed(10));
    }

    public function test_isMouseButtonDown(): void
    {
        $this->ffiProxy->IsMouseButtonDown(10)
            ->shouldBeCalledOnce()
            ->willReturn(true);

        self::assertTrue($this->raylib->isMouseButtonDown(10));
    }

    public function test_isMouseButtonPressed(): void
    {
        $this->ffiProxy->IsMouseButtonPressed(10)
            ->shouldBeCalledOnce()
            ->willReturn(true);

        self::assertTrue($this->raylib->isMouseButtonPressed(10));
    }

    public function test_loadImage(): void
    {
        $imageCData = $this->ffi->new('Image');
        $data = FFI::addr($this->ffi->new('void *'));

        $imageCData->data = $data;
        $imageCData->width = 10;
        $imageCData->height = 20;
        $imageCData->mipmaps = 30;
        $imageCData->format = 40;

        $this->ffiProxy->LoadImage('image001.png')
            ->shouldBeCalledOnce()
            ->willReturn($imageCData);

        $expectedImage = new Image($data, 10, 20, 30, 40);

        self::assertEquals($expectedImage, $this->raylib->loadImage('image001.png'));
    }

    public function test_loadStorageValue(): void
    {
        $this->ffiProxy->LoadStorageValue(10)
            ->shouldBeCalledOnce()
            ->willReturn(20);

        self::assertEquals(20, $this->raylib->loadStorageValue(10));
    }

    public function test_loadTexture(): void
    {
        $texture = $this->ffi->new('Texture');
        $this->ffiProxy->LoadTexture('unknown.png')
            ->shouldBeCalledOnce()
            ->willReturn($texture);

        self::assertEquals(new Texture2D(0, 0, 0, 0, 0), $this->raylib->loadTexture('unknown.png'));
    }

    public function test_measureText(): void
    {
        $this->ffiProxy->MeasureText('Tiny Text', 20)
            ->shouldBeCalledOnce()
            ->willReturn(2000);

        self::assertEquals(2000, $this->raylib->measureText('Tiny Text', 20));
    }

    public function test_saveStorageValue(): void
    {
        $this->ffiProxy->SaveStorageValue(0, 200)
            ->shouldBeCalledOnce()
            ->willReturn(true);

        self::assertTrue($this->raylib->saveStorageValue(0, 200));
    }

    public function test_setCameraMode_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $camera = new Camera3D(
            new Vector3(0, 0, 0),
            new Vector3(0, 0, 0),
            new Vector3(0, 0, 0),
            15.0,
            5,
        );

        $expectedStruct = $this->ffi->new('Camera3D');
        $expectedStruct->fovy = 15.0;
        $expectedStruct->type = 5;

        $this->ffiProxy->SetCameraMode(
            $this->sameCDataCamera3DArgument($expectedStruct),
            Camera3D::MODE_FIRST_PERSON,
        )->shouldBeCalledOnce();

        $this->raylib->setCameraMode($camera, Camera3D::MODE_FIRST_PERSON);
    }

    public function test_setTargetFPS_respectsParameterOrder(): void
    {
        $this->ffiProxy->SetTargetFPS(45)
            ->shouldBeCalledOnce();

        $this->raylib->setTargetFPS(45);
    }

    public function test_unloadImage(): void
    {
        $expectedImage = $this->ffi->new('Image');
        $data = FFI::addr($this->ffi->new('void *'));
        $expectedImage->data = $data;
        $image = new Image($data, 0, 0, 0, 0);

        $this->ffiProxy->UnloadImage(
            $this->sameCDataImageArgument($expectedImage)
        )->shouldBeCalledOnce();

        $this->raylib->unloadImage($image);
    }

    public function test_unloadTexture(): void
    {
        $texture = $this->ffi->new('Texture');
        $this->ffiProxy->UnloadTexture(
            $this->sameCDataTexture2DArgument($texture)
        )->shouldBeCalledOnce();

        $this->raylib->unloadTexture(new Texture2D(0, 0, 0, 0, 0));
    }

    public function test_updateCamera_respectsParameterOrderAndConvertsObjectsToCDataAndUpdatesOriginalObject(): void
    {
        $camera = new Camera3D(
            new Vector3(0, 0, 0),
            new Vector3(0, 0, 0),
            new Vector3(0, 0, 0),
            15.0,
            5,
        );

        $expectedStruct = $this->ffi->new('Camera3D');
        $expectedStruct->fovy = 15.0;
        $expectedStruct->type = 5;

        $this->ffiProxy->UpdateCamera(
            $this->sameCDataCamera3DArgument($expectedStruct)
        )->will(function (array $args) {
            /** @var CData $cdata */
            [$cdata] = $args;

            $cdata->position->x = 10;
            $cdata->target->x = 15;
            $cdata->up->x = 20;
            $cdata->fovy = 30.0;
        })->shouldBeCalledOnce();

        $this->raylib->updateCamera($camera);

        self::assertEquals(10, $camera->position->x);
        self::assertEquals(15, $camera->target->x);
        self::assertEquals(20, $camera->up->x);
        self::assertEquals(30.0, $camera->fovy);
    }

    public function test_windowShouldClose(): void
    {
        $this->ffiProxy->WindowShouldClose()
            ->shouldBeCalledOnce()
            ->willReturn(true);

        self::assertTrue($this->raylib->windowShouldClose());
    }

    private function sameCDataBoundingBoxArgument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $boundingBox) use ($expectedStruct) {
            self::assertEquals($expectedStruct->min->x, $boundingBox->min->x);
            self::assertEquals($expectedStruct->min->y, $boundingBox->min->y);
            self::assertEquals($expectedStruct->min->z, $boundingBox->min->z);

            self::assertEquals($expectedStruct->max->x, $boundingBox->max->x);
            self::assertEquals($expectedStruct->max->y, $boundingBox->max->y);
            self::assertEquals($expectedStruct->max->z, $boundingBox->max->z);

            return true;
        });
    }

    private function sameCDataCamera2DArgument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $camera) use ($expectedStruct) {
            self::assertEquals($expectedStruct->offset->x, $camera->offset->x);
            self::assertEquals($expectedStruct->offset->y, $camera->offset->y);
            self::assertEquals($expectedStruct->target->x, $camera->target->x);
            self::assertEquals($expectedStruct->target->y, $camera->target->y);
            self::assertEquals($expectedStruct->rotation, $camera->rotation);
            self::assertEquals($expectedStruct->zoom, $camera->zoom);

            return true;
        });
    }

    private function sameCDataCamera3DArgument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $camera) use ($expectedStruct) {
            self::assertEquals($expectedStruct->position->x, $camera->position->x);
            self::assertEquals($expectedStruct->position->y, $camera->position->y);
            self::assertEquals($expectedStruct->position->z, $camera->position->z);
            self::assertEquals($expectedStruct->target->x, $camera->target->x);
            self::assertEquals($expectedStruct->target->y, $camera->target->y);
            self::assertEquals($expectedStruct->target->z, $camera->target->z);
            self::assertEquals($expectedStruct->up->x, $camera->up->x);
            self::assertEquals($expectedStruct->up->y, $camera->up->y);
            self::assertEquals($expectedStruct->up->z, $camera->up->z);
            self::assertEquals($expectedStruct->fovy, $camera->fovy);
            self::assertEquals($expectedStruct->type, $camera->type);

            return true;
        });
    }

    private function sameCDataColorArgument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $color) use ($expectedStruct) {
            self::assertEquals($expectedStruct->r, $color->r);
            self::assertEquals($expectedStruct->g, $color->g);
            self::assertEquals($expectedStruct->b, $color->b);
            self::assertEquals($expectedStruct->a, $color->a);

            return true;
        });
    }

    public function sameCDataImageArgument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $image) use ($expectedStruct) {
            self::assertEquals($expectedStruct->data, $image->data);
            self::assertEquals($expectedStruct->width, $image->width);
            self::assertEquals($expectedStruct->height, $image->height);
            self::assertEquals($expectedStruct->mipmaps, $image->mipmaps);
            self::assertEquals($expectedStruct->format, $image->format);

            return true;
        });
    }

    public function sameCDataRayArgument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $ray) use ($expectedStruct) {
            self::assertEquals($expectedStruct->position->x, $ray->position->x);
            self::assertEquals($expectedStruct->position->y, $ray->position->y);
            self::assertEquals($expectedStruct->position->z, $ray->position->z);

            self::assertEquals($expectedStruct->direction->x, $ray->direction->x);
            self::assertEquals($expectedStruct->direction->y, $ray->direction->y);
            self::assertEquals($expectedStruct->direction->z, $ray->direction->z);

            return true;
        });
    }

    private function sameCDataRectangleArgument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $rectangle) use ($expectedStruct) {
            self::assertEquals($expectedStruct->x, $rectangle->x);
            self::assertEquals($expectedStruct->y, $rectangle->y);
            self::assertEquals($expectedStruct->width, $rectangle->width);
            self::assertEquals($expectedStruct->height, $rectangle->height);

            return true;
        });
    }

    private function sameCDataTexture2DArgument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $texture2D) use ($expectedStruct) {
            self::assertEquals($expectedStruct->id, $texture2D->id);
            self::assertEquals($expectedStruct->width, $texture2D->width);
            self::assertEquals($expectedStruct->height, $texture2D->height);
            self::assertEquals($expectedStruct->mipmaps, $texture2D->mipmaps);
            self::assertEquals($expectedStruct->format, $texture2D->format);

            return true;
        });
    }

    private function sameCDataVector2Argument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $vector2) use ($expectedStruct) {
            self::assertEquals($expectedStruct->x, $vector2->x);
            self::assertEquals($expectedStruct->y, $vector2->y);

            return true;
        });
    }

    private function sameCDataVector3Argument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $vector3) use ($expectedStruct) {
            self::assertEquals($expectedStruct->x, $vector3->x);
            self::assertEquals($expectedStruct->y, $vector3->y);
            self::assertEquals($expectedStruct->z, $vector3->z);

            return true;
        });
    }
}
