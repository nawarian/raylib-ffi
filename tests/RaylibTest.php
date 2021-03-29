<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib;

use FFI;
use FFI\CData;
use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFFIProxy;
use Nawarian\Raylib\Types\Camera2D;
use Nawarian\Raylib\Types\Camera3D;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Rectangle;
use Nawarian\Raylib\Types\Vector2;
use Nawarian\Raylib\Types\Vector3;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
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

    public function test_getFrameTime(): void
    {
        $this->ffiProxy->GetFrameTime()
            ->shouldBeCalledOnce()
            ->willReturn(10.0);

        self::assertEquals(10.0, $this->raylib->getFrameTime());
    }

    public function test_getMouseWheelMove(): void
    {
        $this->ffiProxy->GetMouseWheelMove()
            ->shouldBeCalledOnce()
            ->willReturn(1.0);

        self::assertEquals(1.0, $this->raylib->getMouseWheelMove());
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

    public function test_updateCamera_respectsParameterOrderAndConvertsObjectsToCData(): void
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
        )->shouldBeCalledOnce();

        $this->raylib->updateCamera($camera);
    }

    public function test_windowShouldClose(): void
    {
        $this->ffiProxy->WindowShouldClose()
            ->shouldBeCalledOnce()
            ->willReturn(true);

        self::assertTrue($this->raylib->windowShouldClose());
    }

    private function sameCDataVector3Argument(CData $expectedStruct): Argument\Token\CallbackToken
    {
        return Argument::that(function (CData $vector3) use ($expectedStruct) {
            self::assertEquals($expectedStruct->x, $vector3->x);
            self::assertEquals($expectedStruct->y, $vector3->y);
            self::assertEquals($expectedStruct->z, $vector3->z);

            return true;
        });
    }

    private function sameCDataVector2Argument(CData $expectedStruct): Argument\Token\CallbackToken
    {
        return Argument::that(function (CData $vector2) use ($expectedStruct) {
            self::assertEquals($expectedStruct->x, $vector2->x);
            self::assertEquals($expectedStruct->y, $vector2->y);

            return true;
        });
    }

    private function sameCDataCamera3DArgument(CData $expectedStruct): Argument\Token\CallbackToken
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

    private function sameCDataCamera2DArgument(CData $expectedStruct): Argument\Token\CallbackToken
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

    private function sameCDataColorArgument(CData $expectedStruct): Argument\Token\CallbackToken
    {
        return Argument::that(function (CData $color) use ($expectedStruct) {
            self::assertEquals($expectedStruct->r, $color->r);
            self::assertEquals($expectedStruct->g, $color->g);
            self::assertEquals($expectedStruct->b, $color->b);
            self::assertEquals($expectedStruct->a, $color->a);

            return true;
        });
    }

    private function sameCDataRectangleArgument(CData $expectedStruct): Argument\Token\CallbackToken
    {
        return Argument::that(function (CData $rectangle) use ($expectedStruct) {
            self::assertEquals($expectedStruct->x, $rectangle->x);
            self::assertEquals($expectedStruct->y, $rectangle->y);
            self::assertEquals($expectedStruct->width, $rectangle->width);
            self::assertEquals($expectedStruct->height, $rectangle->height);

            return true;
        });
    }
}
