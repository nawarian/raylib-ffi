<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Sound
{
    public AudioStream $stream;
    public int $sampleCount;

    public function __construct(AudioStream $stream, int $sampleCount)
    {
        $this->stream = $stream;
        $this->sampleCount = $sampleCount;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $sound = $ffi->new('Sound');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Sound"'
            );
        }

        $sound->stream = $this->stream->toCData($ffi);
        $sound->sampleCount = $this->sampleCount;

        return $sound;
    }
}
