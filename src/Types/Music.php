<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Music
{
    public AudioStream $stream;
    public int $sampleCount;
    public bool $looping;
    public int $ctxType;
    public CData $ctxData;

    public function __construct(AudioStream $stream, int $sampleCount, bool $looping, int $ctxType, CData $ctxData)
    {
        $this->stream = $stream;
        $this->sampleCount = $sampleCount;
        $this->looping = $looping;
        $this->ctxType = $ctxType;
        $this->ctxData = $ctxData;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $music = $ffi->new('Music');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Music"'
            );
        }

        $music->stream = $this->stream->toCData($ffi);
        $music->sampleCount = $this->sampleCount;
        $music->looping = $this->looping;
        $music->ctxType = $this->ctxType;
        $music->ctxData = $this->ctxData;

        return $music;
    }
}
