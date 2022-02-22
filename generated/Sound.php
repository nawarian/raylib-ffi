<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Sound
{
    /**
     * Audio stream
     */
    public \Nawarian\Raylib\Generated\AudioStream $stream;

    /**
     * Total number of samples
     */
    public int $frameCount;

    public function __construct(\Nawarian\Raylib\Generated\AudioStream $stream, int $frameCount)
    {
        $this->stream = $stream;
        $this->frameCount = $frameCount;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Sound');
        $type->stream = $this->stream->toCData();
        $type->frameCount = $this->frameCount;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Sound
    {
        return new self(\Nawarian\Raylib\Generated\AudioStream::fromCData($cdata->stream), $cdata->frameCount);
    }
}
