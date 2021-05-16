<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

use FFI;

final class RaylibFactory
{
    private const RESOURCES_PATH = __DIR__ . '/../resources';

    public function newInstance(): Raylib
    {
        // Figure out shared lib for current OS
        $os = php_uname('s');

        switch (strtoupper(substr($os, 0, 3))) {
            case 'WIN':
                $lib = 'raylib.dll';
                break;
            case 'DAR': // Darwin Kernel (OS X)
                $lib = 'libraylib.dylib';
                break;
            // Throw notice on default lib picked up?
            default:
                $lib = 'libraylib.so';
                break;
        }

        $raylibH = file_get_contents(self::RESOURCES_PATH . '/raylib.h');

        /** @var FFI $ffi */
        $ffi = FFI::cdef($raylibH, $lib);
        $proxy = new RaylibFFIProxy($ffi);

        return new Raylib($proxy);
    }
}
