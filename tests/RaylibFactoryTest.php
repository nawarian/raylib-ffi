<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib;

use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\Color;
use PHPUnit\Framework\TestCase;

class RaylibFactoryTest extends TestCase
{
    public function test_newInstance_createsConfiguredInstance(): void
    {
        $factory = new RaylibFactory();

        $raylib = $factory->newInstance();

        $color = $raylib->Fade(new Color(255, 0, 0, 100), .20);
        self::assertEquals(255, $color->red);
        self::assertEquals(0, $color->green);
        self::assertEquals(0, $color->blue);
        self::assertEquals(51, $color->alpha);
    }
}
