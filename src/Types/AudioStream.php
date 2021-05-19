<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class AudioStream
{
    public CData $buffer;
    public int $sampleRate;
    public int $sampleSize;
    public int $channels;

    public function __construct(CData $buffer, int $sampleRate, int $sampleSize, int $channels)
    {
        $this->buffer = $buffer;
        $this->sampleRate = $sampleRate;
        $this->sampleSize = $sampleSize;
        $this->channels = $channels;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $stream = $ffi->new('AudioStream');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct AudioStream"'
            );
        }

        $stream->buffer = $this->buffer;
        $stream->sampleRate = $this->sampleRate;
        $stream->sampleSize = $this->sampleSize;
        $stream->channels = $this->channels;

        return $stream;
    }
}
