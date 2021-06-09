<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib;

use FFI;
use FFI\CData;
use Nawarian\Raylib\{
    Raylib,
    RaylibFFIProxy,
};
use Nawarian\Raylib\Types\{AudioStream,
    BoundingBox,
    Camera2D,
    Camera3D,
    Color,
    Font,
    Image,
    Ray,
    Rectangle,
    Sound,
    Texture2D,
    Vector2,
    Vector3};
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

    public function test_checkCollisionPointCircle_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $point = $this->ffi->new('Vector2');
        $origin = $this->ffi->new('Vector2');

        $this->ffiProxy->CheckCollisionPointCircle(
            $this->sameCDataVector2Argument($point),
            $this->sameCDataVector2Argument($origin),
            10.0,
        )->shouldBeCalledOnce()->willReturn(true);

        self::assertTrue(
            $this->raylib->checkCollisionPointCircle(
                new Vector2(0, 0),
                new Vector2(0, 0),
                10.0,
            ),
        );
    }

    public function test_checkCollisionPointRec_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $point = $this->ffi->new('Vector2');
        $rec = $this->ffi->new('Rectangle');

        $this->ffiProxy->CheckCollisionPointRec(
            $this->sameCDataVector2Argument($point),
            $this->sameCDataRectangleArgument($rec),
        )->shouldBeCalledOnce()->willReturn(true);

        self::assertTrue(
            $this->raylib->checkCollisionPointRec(
                new Vector2(0, 0),
                new Rectangle(0, 0, 0, 0),
            ),
        );
    }

    public function test_checkCollisionRecs_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $rec1 = $this->ffi->new('Rectangle');
        $rec2 = $this->ffi->new('Rectangle');

        $this->ffiProxy->CheckCollisionRecs(
            $this->sameCDataRectangleArgument($rec1),
            $this->sameCDataRectangleArgument($rec2),
        )->shouldBeCalledOnce()->willReturn(true);

        self::assertTrue(
            $this->raylib->checkCollisionRecs(
                new Rectangle(0, 0, 0, 0),
                new Rectangle(0, 0, 0, 0),
            ),
        );
    }

    public function test_clearBackground_convertsColorToCData(): void
    {
        $color = new Color(0, 0, 0, 0);
        $expectedStruct = $this->ffi->new('Color');

        $this->ffiProxy->ClearBackground($this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->clearBackground($color);
    }

    public function test_clearWindowState(): void
    {
        $this->ffiProxy->ClearWindowState(
            Raylib::FLAG_WINDOW_ALWAYS_RUN
        )->shouldBeCalledOnce();

        $this->raylib->clearWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN);
    }

    public function test_closeAudioDevice(): void
    {
        $this->ffiProxy->CloseAudioDevice()
            ->shouldBeCalledOnce();

        $this->raylib->closeAudioDevice();
    }

    public function test_closeWindow(): void
    {
        $this->ffiProxy->CloseWindow()
            ->shouldBeCalledOnce();

        $this->raylib->closeWindow();
    }

    public function test_colorAlpha_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $color = Color::black(0);
        $expectedColorStruct = $this->ffi->new('Color');

        $newColorStruct = $this->ffi->new('Color');
        $newColorStruct->r = 255;
        $this->ffiProxy->ColorAlpha($this->sameCDataColorArgument($expectedColorStruct), 0.5)
            ->shouldBeCalledOnce()
            ->willReturn($newColorStruct);

        self::assertEquals(
            new Color(255, 0, 0, 0),
            $this->raylib->colorAlpha($color, 0.5)
        );
    }

    public function test_drawCircle_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $expectedColor = $this->ffi->new('Color');
        $this->ffiProxy->DrawCircle(10, 20, 30, $this->sameCDataColorArgument($expectedColor))
            ->shouldBeCalledOnce();

        $this->raylib->drawCircle(10, 20, 30, Color::black(0));
    }

    public function test_drawCircleGradient_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $expectedColor1 = $this->ffi->new('Color');
        $expectedColor2 = $this->ffi->new('Color');
        $this->ffiProxy->DrawCircleGradient(
            10,
            20,
            30,
            $this->sameCDataColorArgument($expectedColor1),
            $this->sameCDataColorArgument($expectedColor2),
        )->shouldBeCalledOnce();

        $this->raylib->drawCircleGradient(10, 20, 30, Color::black(0), Color::black(0));
    }

    public function test_drawCircleLines_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $expectedColor = $this->ffi->new('Color');
        $this->ffiProxy->DrawCircleLines(10, 20, 30, $this->sameCDataColorArgument($expectedColor))
            ->shouldBeCalledOnce();

        $this->raylib->drawCircleLines(10, 20, 30, Color::black(0));
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

    public function test_drawLineBezier_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $start = new Vector2(0, 0);
        $end = new Vector2(100, 100);

        $expectedStart = $this->ffi->new('Vector2');
        $expectedEnd = $this->ffi->new('Vector2');
        $expectedEnd->x = 100;
        $expectedEnd->y = 100;
        $expectedColor = $this->ffi->new('Color');
        $expectedColor->a = 255;

        $this->ffiProxy->DrawLineBezier(
            $this->sameCDataVector2Argument($expectedStart),
            $this->sameCDataVector2Argument($expectedEnd),
            10,
            $this->sameCDataColorArgument($expectedColor),
        )->shouldBeCalledOnce();

        $this->raylib->drawLineBezier($start, $end, 10, Color::black());
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

    public function test_drawPoly_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $expectedVector = $this->ffi->new('Vector2');
        $expectedColor = $this->ffi->new('Color');

        $this->ffiProxy->DrawPoly(
            $this->sameCDataVector2Argument($expectedVector),
            10,
            20,
            30,
            $this->sameCDataColorArgument($expectedColor),
        )->shouldBeCalledOnce();

        $this->raylib->drawPoly(new Vector2(0, 0), 10, 20, 30, Color::black(0));
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

    public function test_drawRectangleGradientH_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $expectedColor1 = $this->ffi->new('Color');
        $expectedColor2 = $this->ffi->new('Color');
        $expectedColor2->a = 255;

        $this->ffiProxy->DrawRectangleGradientH(
            0,
            10,
            20,
            30,
            $this->sameCDataColorArgument($expectedColor1),
            $this->sameCDataColorArgument($expectedColor2),
        )->shouldBeCalledOnce();

        $this->raylib->DrawRectangleGradientH(
            0,
            10,
            20,
            30,
            Color::black(0),
            Color::black(255),
        );
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

    public function test_drawRectanglePro_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $rectangle = new Rectangle(10, 20, 30, 40);
        $vector2 = new Vector2(0, 0);
        $color = new Color(0, 0, 0, 0);

        $expectedRectangle = $this->ffi->new('Rectangle');
        $expectedRectangle->x = 10;
        $expectedRectangle->y = 20;
        $expectedRectangle->width = 30;
        $expectedRectangle->height = 40;
        $expectedVector2 = $this->ffi->new('Vector2');
        $expectedColor = $this->ffi->new('Color');
        $this->ffiProxy->DrawRectanglePro(
            $this->sameCDataRectangleArgument($expectedRectangle),
            $this->sameCDataVector2Argument($expectedVector2),
            10.0,
            $this->sameCDataColorArgument($expectedColor)
        )->shouldBeCalledOnce();

        $this->raylib->drawRectanglePro($rectangle, $vector2, 10.0, $color);
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

    public function test_drawTexturePro_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $texture = new Texture2D(0, 0, 0, 0, 0);
        $source = new Rectangle(0, 0, 0, 0);
        $dest = new Rectangle(0, 0, 0, 0);
        $origin = new Vector2(0, 0);
        $rotation = 0.0;
        $tint = new Color(255, 0, 0, 0);

        $expectedTexture = $this->ffi->new('Texture');
        $expectedSource = $this->ffi->new('Rectangle');
        $expectedDest = $this->ffi->new('Rectangle');
        $expectedOrigin = $this->ffi->new('Vector2');
        $expectedTint = $this->ffi->new('Color');
        $expectedTint->r = 255;

        $this->ffiProxy->DrawTexturePro(
            $this->sameCDataTexture2DArgument($expectedTexture),
            $this->sameCDataRectangleArgument($expectedSource),
            $this->sameCDataRectangleArgument($expectedDest),
            $this->sameCDataVector2Argument($expectedOrigin),
            $rotation,
            $this->sameCDataColorArgument($expectedTint),
        )->shouldBeCalledOnce();

        $this->raylib->drawTexturePro($texture, $source, $dest, $origin, $rotation, $tint);
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

    public function test_drawTriangle_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $expectedVec1 = $this->ffi->new('Vector2');
        $expectedVec2 = $this->ffi->new('Vector2');
        $expectedVec2->x = 1;
        $expectedVec2->y = 1;
        $expectedVec3 = $this->ffi->new('Vector2');
        $expectedVec3->x = 2;
        $expectedVec3->y = 2;
        $expectedColor = $this->ffi->new('Color');

        $this->ffiProxy->DrawTriangle(
            $this->sameCDataVector2Argument($expectedVec1),
            $this->sameCDataVector2Argument($expectedVec2),
            $this->sameCDataVector2Argument($expectedVec3),
            $this->sameCDataColorArgument($expectedColor)
        )->shouldBeCalledOnce();

        $this->raylib->drawTriangle(new Vector2(0, 0), new Vector2(1, 1), new Vector2(2, 2), Color::black(0));
    }

    public function test_drawTriangleLines_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $expectedVec1 = $this->ffi->new('Vector2');
        $expectedVec2 = $this->ffi->new('Vector2');
        $expectedVec2->x = 1;
        $expectedVec2->y = 1;
        $expectedVec3 = $this->ffi->new('Vector2');
        $expectedVec3->x = 2;
        $expectedVec3->y = 2;
        $expectedColor = $this->ffi->new('Color');

        $this->ffiProxy->DrawTriangleLines(
            $this->sameCDataVector2Argument($expectedVec1),
            $this->sameCDataVector2Argument($expectedVec2),
            $this->sameCDataVector2Argument($expectedVec3),
            $this->sameCDataColorArgument($expectedColor)
        )->shouldBeCalledOnce();

        $this->raylib->drawTriangleLines(
            new Vector2(0, 0),
            new Vector2(1, 1),
            new Vector2(2, 2),
            Color::black(0),
        );
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

    public function test_GenImageCellular(): void
    {
        $expectedImage = $this->ffi->new('Image');
        $imageData = FFI::addr($this->ffi->new('void *'));

        $expectedImage->data = $imageData;
        $expectedImage->width = 10;
        $expectedImage->height = 10;
        $expectedImage->mipmaps = 5;
        $expectedImage->format = 5;

        $this->ffiProxy->GenImageCellular(200, 200, 32)
            ->shouldBeCalledOnce()
            ->willReturn($expectedImage);

        $image = $this->raylib->genImageCellular(200, 200, 32);

        self::assertEquals($expectedImage->data, $image->data);
        self::assertEquals($expectedImage->width, $image->width);
        self::assertEquals($expectedImage->height, $image->height);
        self::assertEquals($expectedImage->mipmaps, $image->mipmaps);
        self::assertEquals($expectedImage->format, $image->format);
    }

    public function test_GenImageChecked(): void
    {
        $expectedImage = $this->ffi->new('Image');
        $imageData = FFI::addr($this->ffi->new('void *'));

        $expectedImage->data = $imageData;
        $expectedImage->width = 10;
        $expectedImage->height = 10;
        $expectedImage->mipmaps = 5;
        $expectedImage->format = 5;

        $colorCol1Struct = $this->ffi->new('Color');
        $colorCol1Struct->r = 230;
        $colorCol1Struct->g = 41;
        $colorCol1Struct->b = 55;
        $colorCol1Struct->a = 255;

        $colorCol2Struct = $this->ffi->new('Color');
        $colorCol2Struct->r = 0;
        $colorCol2Struct->g = 121;
        $colorCol2Struct->b = 241;
        $colorCol2Struct->a = 255;

        $this->ffiProxy->GenImageChecked(
            200,
            200,
            32,
            32,
            $this->sameCDataColorArgument($colorCol1Struct),
            $this->sameCDataColorArgument($colorCol2Struct),
        )
            ->shouldBeCalledOnce()
            ->willReturn($expectedImage);

        $image = $this->raylib->genImageChecked(200, 200, 32, 32, Color::red(), Color::blue());

        self::assertEquals($expectedImage->data, $image->data);
        self::assertEquals($expectedImage->width, $image->width);
        self::assertEquals($expectedImage->height, $image->height);
        self::assertEquals($expectedImage->mipmaps, $image->mipmaps);
        self::assertEquals($expectedImage->format, $image->format);
    }

    public function test_GenImageGradientH(): void
    {
        $expectedImage = $this->ffi->new('Image');
        $imageData = FFI::addr($this->ffi->new('void *'));

        $expectedImage->data = $imageData;
        $expectedImage->width = 10;
        $expectedImage->height = 10;
        $expectedImage->mipmaps = 5;
        $expectedImage->format = 5;

        $colorCol1Struct = $this->ffi->new('Color');
        $colorCol1Struct->r = 230;
        $colorCol1Struct->g = 41;
        $colorCol1Struct->b = 55;
        $colorCol1Struct->a = 255;

        $colorCol2Struct = $this->ffi->new('Color');
        $colorCol2Struct->r = 0;
        $colorCol2Struct->g = 121;
        $colorCol2Struct->b = 241;
        $colorCol2Struct->a = 255;

        $this->ffiProxy->GenImageGradientH(
            200,
            200,
            $this->sameCDataColorArgument($colorCol1Struct),
            $this->sameCDataColorArgument($colorCol2Struct),
        )
            ->shouldBeCalledOnce()
            ->willReturn($expectedImage);

        $image = $this->raylib->genImageGradientH(200, 200, Color::red(), Color::blue());

        self::assertEquals($expectedImage->data, $image->data);
        self::assertEquals($expectedImage->width, $image->width);
        self::assertEquals($expectedImage->height, $image->height);
        self::assertEquals($expectedImage->mipmaps, $image->mipmaps);
        self::assertEquals($expectedImage->format, $image->format);
    }

    public function test_GenImageGradientRadial(): void
    {
        $expectedImage = $this->ffi->new('Image');
        $imageData = FFI::addr($this->ffi->new('void *'));

        $expectedImage->data = $imageData;
        $expectedImage->width = 10;
        $expectedImage->height = 10;
        $expectedImage->mipmaps = 5;
        $expectedImage->format = 5;

        $colorCol1Struct = $this->ffi->new('Color');
        $colorCol1Struct->r = 230;
        $colorCol1Struct->g = 41;
        $colorCol1Struct->b = 55;
        $colorCol1Struct->a = 255;

        $colorCol2Struct = $this->ffi->new('Color');
        $colorCol2Struct->r = 0;
        $colorCol2Struct->g = 121;
        $colorCol2Struct->b = 241;
        $colorCol2Struct->a = 255;

        $this->ffiProxy->GenImageGradientRadial(
            200,
            200,
            0.5,
            $this->sameCDataColorArgument($colorCol1Struct),
            $this->sameCDataColorArgument($colorCol2Struct),
        )
            ->shouldBeCalledOnce()
            ->willReturn($expectedImage);

        $image = $this->raylib->genImageGradientRadial(200, 200, 0.5, Color::red(), Color::blue());

        self::assertEquals($expectedImage->data, $image->data);
        self::assertEquals($expectedImage->width, $image->width);
        self::assertEquals($expectedImage->height, $image->height);
        self::assertEquals($expectedImage->mipmaps, $image->mipmaps);
        self::assertEquals($expectedImage->format, $image->format);
    }

    public function test_GenImageGradientV(): void
    {
        $expectedImage = $this->ffi->new('Image');
        $imageData = FFI::addr($this->ffi->new('void *'));

        $expectedImage->data = $imageData;
        $expectedImage->width = 10;
        $expectedImage->height = 10;
        $expectedImage->mipmaps = 5;
        $expectedImage->format = 5;

        $colorCol1Struct = $this->ffi->new('Color');
        $colorCol1Struct->r = 230;
        $colorCol1Struct->g = 41;
        $colorCol1Struct->b = 55;
        $colorCol1Struct->a = 255;

        $colorCol2Struct = $this->ffi->new('Color');
        $colorCol2Struct->r = 0;
        $colorCol2Struct->g = 121;
        $colorCol2Struct->b = 241;
        $colorCol2Struct->a = 255;

        $this->ffiProxy->GenImageGradientV(
            200,
            200,
            $this->sameCDataColorArgument($colorCol1Struct),
            $this->sameCDataColorArgument($colorCol2Struct),
        )
            ->shouldBeCalledOnce()
            ->willReturn($expectedImage);

        $image = $this->raylib->genImageGradientV(200, 200, Color::red(), Color::blue());

        self::assertEquals($expectedImage->data, $image->data);
        self::assertEquals($expectedImage->width, $image->width);
        self::assertEquals($expectedImage->height, $image->height);
        self::assertEquals($expectedImage->mipmaps, $image->mipmaps);
        self::assertEquals($expectedImage->format, $image->format);
    }

    public function test_GenImagePerlinNoise(): void
    {
        $expectedImage = $this->ffi->new('Image');
        $imageData = FFI::addr($this->ffi->new('void *'));

        $expectedImage->data = $imageData;
        $expectedImage->width = 10;
        $expectedImage->height = 10;
        $expectedImage->mipmaps = 5;
        $expectedImage->format = 5;

        $this->ffiProxy->GenImagePerlinNoise(200, 200, 1, 1, 1.5)
            ->shouldBeCalledOnce()
            ->willReturn($expectedImage);

        $image = $this->raylib->genImagePerlinNoise(200, 200, 1, 1, 1.5);

        self::assertEquals($expectedImage->data, $image->data);
        self::assertEquals($expectedImage->width, $image->width);
        self::assertEquals($expectedImage->height, $image->height);
        self::assertEquals($expectedImage->mipmaps, $image->mipmaps);
        self::assertEquals($expectedImage->format, $image->format);
    }

    public function test_GenImageWhiteNoise(): void
    {
        $expectedImage = $this->ffi->new('Image');
        $imageData = FFI::addr($this->ffi->new('void *'));

        $expectedImage->data = $imageData;
        $expectedImage->width = 10;
        $expectedImage->height = 10;
        $expectedImage->mipmaps = 5;
        $expectedImage->format = 5;

        $this->ffiProxy->GenImageWhiteNoise(200, 200, 1.5)
            ->shouldBeCalledOnce()
            ->willReturn($expectedImage);

        $image = $this->raylib->genImageWhiteNoise(200, 200, 1.5);

        self::assertEquals($expectedImage->data, $image->data);
        self::assertEquals($expectedImage->width, $image->width);
        self::assertEquals($expectedImage->height, $image->height);
        self::assertEquals($expectedImage->mipmaps, $image->mipmaps);
        self::assertEquals($expectedImage->format, $image->format);
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

    public function test_getCollisionRec_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $expectedRec = $this->ffi->new('Rectangle');
        $expectedRec->x = 100;

        $this->ffiProxy->GetCollisionRec(
            $this->ffi->new('Rectangle'),
            $this->ffi->new('Rectangle'),
        )->shouldBeCalledOnce()->willReturn($expectedRec);

        $collsionRec = $this->raylib->getCollisionRec(
            new Rectangle(0, 0, 10, 10),
            new Rectangle(0, 0, 20, 20),
        );

        self::assertEquals(100, $collsionRec->x);
        self::assertEquals(0, $collsionRec->y);
        self::assertEquals(0, $collsionRec->width);
        self::assertEquals(0, $collsionRec->height);
    }

    public function test_getFPS(): void
    {
        $this->ffiProxy->GetFPS()
            ->shouldBeCalledOnce()
            ->willReturn(10);

        self::assertEquals(10, $this->raylib->getFPS());
    }

    public function test_getFrameTime(): void
    {
        $this->ffiProxy->GetFrameTime()
            ->shouldBeCalledOnce()
            ->willReturn(10.0);

        self::assertEquals(10.0, $this->raylib->getFrameTime());
    }

    public function test_getImageData(): void
    {
        $colorStruct = $this->ffi->new('Color');
        $colorStruct->r = 255;
        $colorStruct->g = 255;
        $colorStruct->b = 255;
        $colorStruct->a = 255;

        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($this->ffi->new('void *'));

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->LoadImageColors($this->sameCDataImageArgument($imageStruct))
            ->shouldBeCalledOnce()
            ->willReturn($colorStruct);

        $image = new Image(
            $imageStruct->data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format,
        );

        self::assertEquals($colorStruct, $this->raylib->getImageData($image));
    }

    public function test_getKeyPressed(): void
    {
        $this->ffiProxy->GetKeyPressed()
            ->shouldBeCalledOnce()
            ->willReturn(Raylib::KEY_N);

        self::assertEquals(Raylib::KEY_N, $this->raylib->getKeyPressed());
    }

    public function test_getCharPressed(): void
    {
        $this->ffiProxy->GetCharPressed()
            ->shouldBeCalledOnce()
            ->willReturn(Raylib::KEY_N);

        self::assertEquals(Raylib::KEY_N, $this->raylib->getCharPressed());
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

    public function test_getSoundsPlaying(): void
    {
        $this->ffiProxy->GetSoundsPlaying()
            ->shouldBeCalledOnce()
            ->willReturn(10);

        self::assertEquals(10, $this->raylib->getSoundsPlaying());
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

    public function test_imageColorBrightness(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($this->ffi->new('void *'));

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->ImageColorBrightness(
            $this->sameCDataImageArgument($imageStruct),
            -40
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageColorBrightness($image, -40);
    }

    public function test_imageColorContrast(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($this->ffi->new('void *'));

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->ImageColorContrast(
            $this->sameCDataImageArgument($imageStruct),
            -40.0
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageColorContrast($image, -40.0);
    }

    public function test_imageColorGrayscale(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($this->ffi->new('void *'));

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->ImageColorGrayscale(
            $this->sameCDataImageArgument($imageStruct)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageColorGrayscale($image);
    }

    public function test_imageColorInvert(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($this->ffi->new('void *'));

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->ImageColorInvert(
            $this->sameCDataImageArgument($imageStruct)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageColorInvert($image);
    }

    public function test_imageColorTint(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($this->ffi->new('void *'));

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $colorStruct = $this->ffi->new('Color');
        $colorStruct->r = 255;
        $colorStruct->g = 255;
        $colorStruct->b = 255;
        $colorStruct->a = 255;

        $this->ffiProxy->ImageColorTint(
            $this->sameCDataImageArgument($imageStruct),
            $this->sameCDataColorArgument($colorStruct)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $color = new Color(
            $colorStruct->r,
            $colorStruct->g,
            $colorStruct->b,
            $colorStruct->a,
        );

        $this->raylib->imageColorTint($image, $color);
    }

    public function test_imageCrop(): void
    {
        $rec1 = $this->ffi->new('Rectangle');
        $rec1->x = 10.0;
        $rec1->y = 5.0;
        $rec1->width = 100.0;
        $rec1->height = 50.0;

        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->ImageCrop(
            $this->sameCDataImageArgument($imageStruct),
            $this->sameCDataRectangleArgument($rec1)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $rectangle = new Rectangle(
            $rec1->x,
            $rec1->y,
            $rec1->width,
            $rec1->height
        );

        $this->raylib->imageCrop($image, $rectangle);
    }

    public function test_imageDraw(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $imageSrcStruct = $this->ffi->new('Image');
        $dataSrc = FFI::addr($imageSrcStruct);

        $imageSrcStruct->data = $dataSrc;
        $imageSrcStruct->width = 10;
        $imageSrcStruct->height = 20;
        $imageSrcStruct->mipmaps = 30;
        $imageSrcStruct->format = 40;

        $colorStruct = $this->ffi->new('Color');
        $colorStruct->r = 255;
        $colorStruct->g = 255;
        $colorStruct->b = 255;
        $colorStruct->a = 255;

        $recDstStruct = $this->ffi->new('Rectangle');
        $recSrcStruct = $this->ffi->new('Rectangle');

        $this->ffiProxy->ImageDraw(
            $this->sameCDataImageArgument($imageStruct),
            $this->sameCDataImageArgument($imageSrcStruct),
            $this->sameCDataRectangleArgument($recSrcStruct),
            $this->sameCDataRectangleArgument($recDstStruct),
            $this->sameCDataColorArgument($colorStruct)
        )
            ->willReturn($imageStruct);

        $imageDst = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $imageSrc = new Image(
            $dataSrc,
            $imageSrcStruct->width,
            $imageSrcStruct->height,
            $imageSrcStruct->mipmaps,
            $imageSrcStruct->format
        );

        $srcRec = new Rectangle(0, 0, 0, 0);
        $dstRec = new Rectangle(0, 0, 0, 0);

        $this->raylib->imageDraw($imageDst, $imageSrc, $srcRec, $dstRec, Color::white());
    }

    public function test_imageDrawCircle(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $colorStruct = $this->ffi->new('Color');
        $colorStruct->r = 255;
        $colorStruct->g = 255;
        $colorStruct->b = 255;
        $colorStruct->a = 255;

        $this->ffiProxy->ImageDrawCircle(
            $this->sameCDataImageArgument($imageStruct),
            10,
            10,
            2,
            $this->sameCDataColorArgument($colorStruct)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageDrawCircle($image, 10, 10, 2, Color::white());
    }

    public function test_imageDrawPixel(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $colorStruct = $this->ffi->new('Color');
        $colorStruct->r = 255;
        $colorStruct->g = 255;
        $colorStruct->b = 255;
        $colorStruct->a = 255;

        $this->ffiProxy->ImageDrawPixel(
            $this->sameCDataImageArgument($imageStruct),
            10,
            10,
            $this->sameCDataColorArgument($colorStruct)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageDrawPixel($image, 10, 10, Color::white());
    }

    public function test_imageDrawRectangle(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $colorStruct = $this->ffi->new('Color');
        $colorStruct->r = 255;
        $colorStruct->g = 255;
        $colorStruct->b = 255;
        $colorStruct->a = 255;

        $this->ffiProxy->ImageDrawRectangle(
            $this->sameCDataImageArgument($imageStruct),
            10,
            10,
            20,
            20,
            $this->sameCDataColorArgument($colorStruct)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageDrawRectangle($image, 10, 10, 20, 20, Color::white());
    }

    public function test_imageDrawTextEx(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $recStruct = $this->ffi->new('Rectangle');
        $dataRec = FFI::addr($recStruct);

        $charInfoStruct = $this->ffi->new('CharInfo');
        $dataCharInfo = FFI::addr($charInfoStruct);
        $dataCharInfo->value = 10;
        $dataCharInfo->offsetX = 10;
        $dataCharInfo->offsetY = 10;
        $dataCharInfo->advanceX = 10;
        $dataCharInfo->image = $imageStruct;

        $fontStruct = $this->ffi->new('Font');
        $fontStruct->recs = $dataRec;
        $fontStruct->chars = $dataCharInfo;

        $position = $this->ffi->new('Vector2');

        $textureStruct = $this->ffi->new('Texture');
        $textureStruct->id = 10;
        $textureStruct->width = 10;
        $textureStruct->height = 10;
        $textureStruct->mipmaps = 10;
        $textureStruct->format = 10;

        $texture = new Texture2D(
            $textureStruct->id,
            $textureStruct->width,
            $textureStruct->height,
            $textureStruct->mipmaps,
            $textureStruct->format,
        );

        $colorStruct = $this->ffi->new('Color');
        $colorStruct->r = 255;
        $colorStruct->g = 255;
        $colorStruct->b = 255;
        $colorStruct->a = 255;

        $this->ffiProxy->ImageDrawTextEx(
            $this->sameCDataImageArgument($imageStruct),
            $this->sameCDataFontArgument($fontStruct),
            'Text',
            $this->sameCDataVector2Argument($position),
            20.0,
            1.5,
            $this->sameCDataColorArgument($colorStruct)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $imageStruct->data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $font = new Font(
            $fontStruct->baseSize,
            $fontStruct->charsCount,
            $fontStruct->charsPadding,
            $texture,
            $dataRec,
            $dataCharInfo
        );

        $this->raylib->imageDrawTextEx(
            $image,
            $font,
            'Text',
            new Vector2(0, 0),
            20,
            1.5,
            Color::white()
        );
    }

    public function test_imageFlipHorizontal(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->ImageFlipHorizontal(
            $this->sameCDataImageArgument($imageStruct)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageFlipHorizontal($image);
    }

    public function test_imageFlipVertical(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->ImageFlipVertical(
            $this->sameCDataImageArgument($imageStruct)
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageFlipVertical($image);
    }

    public function test_imageFormat(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->ImageFormat(
            $this->sameCDataImageArgument($imageStruct),
            Raylib::UNCOMPRESSED_R8G8B8A8
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageFormat($image, Raylib::UNCOMPRESSED_R8G8B8A8);
    }

    public function test_imageResize(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->ImageResize(
            $this->sameCDataImageArgument($imageStruct),
            200,
            200
        )
            ->willReturn($imageStruct);

        $image = new Image(
            $data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        $this->raylib->imageResize($image, 200, 200);
    }

    public function test_initAudioDevice(): void
    {
        $this->ffiProxy->InitAudioDevice()
            ->shouldBeCalledOnce();

        $this->raylib->initAudioDevice();
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

    public function test_isMouseButtonReleased(): void
    {
        $this->ffiProxy->IsMouseButtonReleased(10)
            ->shouldBeCalledOnce()
            ->willReturn(true);

        self::assertTrue($this->raylib->isMouseButtonReleased(10));
    }

    public function test_isWindowState(): void
    {
        $this->ffiProxy->IsWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN)
            ->shouldBeCalledOnce()
            ->willReturn(true);

        self::assertTrue($this->raylib->isWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN));
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

    public function test_loadImageColors(): void
    {
        $colorStruct = $this->ffi->new('Color');
        $colorStruct->r = 255;
        $colorStruct->g = 255;
        $colorStruct->b = 255;
        $colorStruct->a = 255;

        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($this->ffi->new('void *'));

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $this->ffiProxy->LoadImageColors($this->sameCDataImageArgument($imageStruct))
            ->shouldBeCalledOnce()
            ->willReturn($colorStruct);

        $image = new Image(
            $imageStruct->data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format,
        );

        self::assertEquals($colorStruct, $this->raylib->loadImageColors($image));
    }

    public function test_loadMusicStream(): void
    {
        $expectedMusicStruct = $this->ffi->new('Music');
        $expectedMusicStruct->stream->buffer = FFI::addr($this->ffi->new('struct rAudioBuffer { void* ptr; }'));
        $expectedMusicStruct->ctxData = FFI::addr($this->ffi->new('struct { void* ptr; }'));

        $this->ffiProxy->LoadMusicStream('music001.xm')
            ->shouldBeCalledOnce()
            ->willReturn($expectedMusicStruct);

        $this->raylib->loadMusicStream('music001.xm');
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

    public function test_loadTextureFromImage(): void
    {
        $imageStruct = $this->ffi->new('Image');
        $data = FFI::addr($imageStruct);

        $imageStruct->data = $data;
        $imageStruct->width = 10;
        $imageStruct->height = 20;
        $imageStruct->mipmaps = 30;
        $imageStruct->format = 40;

        $textureStruct = $this->ffi->new('Texture');
        $textureStruct->id = 10;
        $textureStruct->width = 10;
        $textureStruct->height = 10;
        $textureStruct->mipmaps = 10;
        $textureStruct->format = 10;

        $texture = new Texture2D(
            $textureStruct->id,
            $textureStruct->width,
            $textureStruct->height,
            $textureStruct->mipmaps,
            $textureStruct->format,
        );

        $this->ffiProxy->LoadTextureFromImage(
            $this->sameCDataImageArgument($imageStruct)
        )
            ->willReturn($texture);

        $image = new Image(
            $imageStruct->data,
            $imageStruct->width,
            $imageStruct->height,
            $imageStruct->mipmaps,
            $imageStruct->format
        );

        self::assertEquals($texture, $this->raylib->loadTextureFromImage($image));
    }

    public function test_maximizeWindow(): void
    {
        $this->ffiProxy->MaximizeWindow()
            ->shouldBeCalledOnce();

        $this->raylib->maximizeWindow();
    }

    public function test_measureText(): void
    {
        $this->ffiProxy->MeasureText('Tiny Text', 20)
            ->shouldBeCalledOnce()
            ->willReturn(2000);

        self::assertEquals(2000, $this->raylib->measureText('Tiny Text', 20));
    }

    public function test_minimizeWindow(): void
    {
        $this->ffiProxy->MinimizeWindow()
            ->shouldBeCalledOnce();

        $this->raylib->minimizeWindow();
    }

    public function test_playSound(): void
    {
        $buffer = FFI::addr($this->ffi->new('struct rAudioBuffer { void* ptr; }'));
        $stream = new AudioStream($buffer, 0, 0, 0);
        $sound = new Sound($stream, 0);

        $this->ffiProxy->PlaySound($buffer)
            ->shouldBeCalledOnce();

        $this->raylib->playSound($sound);
    }

    public function test_playSoundMulti(): void
    {
        $buffer = FFI::addr($this->ffi->new('struct rAudioBuffer { void* ptr; }'));
        $stream = new AudioStream($buffer, 0, 0, 0);
        $sound = new Sound($stream, 0);

        $this->ffiProxy->PlaySoundMulti($buffer)
            ->shouldBeCalledOnce();

        $this->raylib->playSoundMulti($sound);
    }

    public function test_restoreWindow(): void
    {
        $this->ffiProxy->RestoreWindow()
            ->shouldBeCalledOnce();

        $this->raylib->restoreWindow();
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

    public function test_setConfigFlags(): void
    {
        $this->ffiProxy->SetConfigFlags(10)
            ->shouldBeCalledOnce();

        $this->raylib->setConfigFlags(10);
    }

    public function test_setSoundVolume_respectsParameterOrder(): void
    {
        $buffer = FFI::addr($this->ffi->new('struct rAudioBuffer { void* ptr; }'));
        $stream = new AudioStream($buffer, 0, 0, 0);
        $sound = new Sound($stream, 0);

        $this->ffiProxy->SetSoundVolume($this->ffi->new('Sound'), 10)->shouldBeCalledOnce();

        $this->raylib->setSoundVolume($sound, 10.0);
    }

    public function test_setTargetFPS_respectsParameterOrder(): void
    {
        $this->ffiProxy->SetTargetFPS(45)
            ->shouldBeCalledOnce();

        $this->raylib->setTargetFPS(45);
    }

    public function test_setTextureFilter_respectsParameterOrder(): void
    {
        $tex = new Texture2D(0, 0, 0, 0, 0);
        $texStruct = $this->ffi->new('Texture');

        $this->ffiProxy->SetTextureFilter(
            $this->sameCDataTexture2DArgument($texStruct),
            10
        )->shouldBeCalledOnce();

        $this->raylib->setTextureFilter($tex, 10);
    }

    public function test_setWindowState(): void
    {
        $this->ffiProxy->SetWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN)
            ->shouldBeCalledOnce();

        $this->raylib->setWindowState(Raylib::FLAG_WINDOW_ALWAYS_RUN);
    }

    public function test_stopSoundMulti(): void
    {
        $this->ffiProxy->StopSoundMulti()
            ->shouldBeCalledOnce();

        $this->raylib->stopSoundMulti();
    }

    public function test_textSubtext(): void
    {
        $this->ffiProxy->TextSubtext('blah', 10, 20)
            ->shouldBeCalledOnce()
            ->willReturn('somethingelseactually');

        self::assertEquals(
            'somethingelseactually',
            $this->raylib->textSubtext('blah', 10, 20)
        );
    }

    public function test_toggleFullscreen(): void
    {
        $this->ffiProxy->ToggleFullscreen()
            ->shouldBeCalledOnce();

        $this->raylib->toggleFullscreen();
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

    public function test_unloadSound_respectsParameterOrder(): void
    {
        $buffer = FFI::addr($this->ffi->new('struct rAudioBuffer { void* ptr; }'));
        $stream = new AudioStream($buffer, 0, 0, 0);
        $sound = new Sound($stream, 0);

        $this->ffiProxy->UnloadSound($this->ffi->new('Sound'))
            ->shouldBeCalledOnce();

        $this->raylib->unloadSound($sound);
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

    public function test_updateTexture(): void
    {
        $textureStruct = $this->ffi->new('Texture');
        $textureStruct->id = 10;
        $textureStruct->width = 10;
        $textureStruct->height = 10;
        $textureStruct->mipmaps = 10;
        $textureStruct->format = 10;

        $colorStruct = $this->ffi->new('Color');
        $colorStruct->r = 255;
        $colorStruct->g = 255;
        $colorStruct->b = 255;
        $colorStruct->a = 255;

        $this->ffiProxy->UpdateTexture(
            $this->sameCDataTexture2DArgument($textureStruct),
            $this->sameCDataColorArgument($colorStruct)
        )->shouldBeCalledOnce();

        $texture = new Texture2D(
            $textureStruct->id,
            $textureStruct->width,
            $textureStruct->height,
            $textureStruct->mipmaps,
            $textureStruct->format,
        );

        $this->raylib->updateTexture($texture, $colorStruct);
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

    private function sameCDataFontArgument(CData $expectedStruct): CallbackToken
    {
        return Argument::that(function (CData $font) use ($expectedStruct) {
            self::assertEquals($expectedStruct->baseSize, $font->baseSize);
            self::assertEquals($expectedStruct->charsCount, $font->charsCount);
            self::assertEquals($expectedStruct->charsPadding, $font->charsPadding);
            self::assertEquals($expectedStruct->texture, $font->texture);
            self::assertEquals($expectedStruct->recs, $font->recs);
            self::assertEquals($expectedStruct->chars, $font->chars);

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
