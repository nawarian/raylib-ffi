<?php

declare(strict_types=1);

namespace Nawarian\Tests\Raylib;

use Nawarian\Raylib\RaylibFFI;
use PHPUnit\Framework\TestCase;

final class RaylibFFITest extends TestCase
{
    public function setUp(): void
    {
        RaylibFFI::boot();
    }

    public function test_build_vector2_struct(): void
    {
        $vec = RaylibFFI::new('Vector2');

        self::assertEquals(0, $vec->x);
        self::assertEquals(0, $vec->y);
    }

    public function test_build_vector3_struct(): void
    {
        $vec = RaylibFFI::new('Vector3');

        self::assertEquals(0, $vec->x);
        self::assertEquals(0, $vec->y);
        self::assertEquals(0, $vec->z);
    }

    public function test_InitWindow_sets_screen_size(): void
    {
        RaylibFFI::InitWindow(800, 600, 'Any Title');

        self::assertEquals(800, RaylibFFI::GetScreenWidth());
        self::assertEquals(600, RaylibFFI::GetScreenHeight());
    }
}
