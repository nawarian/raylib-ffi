<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Wave
{
    /**
     * Total number of samples (considering channels!)
     */
    public int $sampleCount;

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

    /**
     * Buffer data pointer
     */
    public FFI\CData $data;

    public function __construct(int $sampleCount, int $sampleRate, int $sampleSize, int $channels, \FFI\CData $data)
    {
        $this->sampleCount = $sampleCount;
        $this->sampleRate = $sampleRate;
        $this->sampleSize = $sampleSize;
        $this->channels = $channels;
        $this->data = $data;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Wave');
        $type->sampleCount = $this->sampleCount;
        $type->sampleRate = $this->sampleRate;
        $type->sampleSize = $this->sampleSize;
        $type->channels = $this->channels;
        $type->data = $this->data;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Wave
    {
        return new self($cdata->sampleCount, $cdata->sampleRate, $cdata->sampleSize, $cdata->channels, $cdata->data);
    }
}
