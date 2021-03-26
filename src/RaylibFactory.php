<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;

final class RaylibFactory
{
    private const RESOURCES_PATH = __DIR__ . '/../resources';

    /**
     * @todo Detect operating system and load shared lib accordingly
     */
    public function newInstance(): Raylib
    {
        /** @var FFI $ffi */
        $ffi = FFI::load(self::RESOURCES_PATH . '/raylib.h');
        $proxy = new RaylibFFIProxy($ffi);

        return new Raylib($proxy);
    }
}
