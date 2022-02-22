<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class AudioStream
{
    /**
     * Pointer to internal data used by the audio system
     */
    public FFI\CData $buffer;

    /**
     * Frequency (samples per second)
     */
    public int $sampleRate;

    /**
     * Bit depth (bits per sample): 8, 16, 32 (24 not supported)
     */
    public int $sampleSize;

    /**
     * Number of channels (1-mono, 2-stereo)
     */
    public int $channels;

    public function __construct(\FFI\CData $buffer, int $sampleRate, int $sampleSize, int $channels)
    {
        $this->buffer = $buffer;
        $this->sampleRate = $sampleRate;
        $this->sampleSize = $sampleSize;
        $this->channels = $channels;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('AudioStream');
        $type->buffer = $this->buffer;
        $type->sampleRate = $this->sampleRate;
        $type->sampleSize = $this->sampleSize;
        $type->channels = $this->channels;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\AudioStream
    {
        return new self($cdata->buffer, $cdata->sampleRate, $cdata->sampleSize, $cdata->channels);
    }
}
