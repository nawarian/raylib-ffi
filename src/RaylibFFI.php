<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;
use RuntimeException;

final class RaylibFFI
{
    private const RAYLIB_H = __DIR__ . '/raylib.h';

    private static FFI $ffi;

    public static function boot(): void
    {
        /** @var FFI|null $ffi */
        $ffi = FFI::load(self::RAYLIB_H);

        // TODO: find a way to test this exception
        if (is_null($ffi)) {
            throw new RuntimeException(
                'Could not load header file ' . self::RAYLIB_H,
            );
        }

        self::$ffi = $ffi;
    }

    public static function __callStatic(string $method, array $args)
    {
        $callable = [self::$ffi, $method];
        return $callable(...$args);
    }
}
