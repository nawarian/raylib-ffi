<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib;

use FFI;
use FFI\CData;
use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFFIProxy;
use Nawarian\Raylib\Types\Camera2D;
use Nawarian\Raylib\Types\Color;
use Nawarian\Raylib\Types\Rectangle;
use Nawarian\Raylib\Types\Vector2;
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

    public function test_BeginMode2D_convertsCamera2DToCData(): void
    {
        $camera = new Camera2D(new Vector2(0, 0), new Vector2(0, 0), 0.0, 0.0);

        $expectedStruct = $this->ffi->new('Camera2D');
        $this->ffiProxy->BeginMode2D($this->sameCDataCamera2DArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->beginMode2D($camera);
    }

    public function test_ClearBackground_convertsColorToCData(): void
    {
        $color = new Color(0, 0, 0, 0);
        $expectedStruct = $this->ffi->new('Color');

        $this->ffiProxy->ClearBackground($this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->clearBackground($color);
    }

    public function test_DrawLine_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $color = new Color(0, 0, 0, 0);

        $expectedStruct = $this->ffi->new('Color');
        $this->ffiProxy->DrawLine(10, 20,30, 40, $this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->drawLine(10, 20, 30 ,40, $color);
    }

    public function test_DrawRectangle_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $color = new Color(0, 0, 0, 0);

        $expectedStruct = $this->ffi->new('Color');
        $this->ffiProxy->DrawRectangle(10, 20, 30, 40, $this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->drawRectangle(10, 20, 30, 40, $color);
    }

    public function test_DrawRectangleLines_respectsParameterOrderAndConvertsColorToCData(): void
    {
        $color = new Color(0, 0, 0, 0);

        $expectedStruct = $this->ffi->new('Color');
        $this->ffiProxy->DrawRectangleLines(10, 20, 30, 40, $this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->drawRectangleLines(10, 20, 30, 40, $color);
    }

    public function test_DrawRectangleRec_respectsParameterOrderAndConvertsObjectsToCData(): void
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

    public function test_DrawText_respectsParameterOrderAndConvertsObjectsToCData(): void
    {
        $color = new Color(0, 0, 0, 0);

        $expectedStruct = $this->ffi->new('Color');
        $this->ffiProxy->DrawText('abc', 10, 20, 30, $this->sameCDataColorArgument($expectedStruct))
            ->shouldBeCalledOnce();

        $this->raylib->drawText('abc', 10, 20, 30, $color);
    }

    /**
     * @method DrawText(string $text, int $x, int $y, int $fontSize, FFI\CData $color): void
     * @method Fade(FFI\CData $color, float $alpha): FFI\CData
     */

    public function test_GetRandomValue_respectsParameterOrder(): void
    {
        $this->ffiProxy->GetRandomValue(10, 20)
            ->shouldBeCalledOnce()
            ->willReturn(15);

        self::assertEquals(15, $this->raylib->getRandomValue(10, 20));
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
