<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class Music
{
    /**
     * Audio stream
     */
    public \Nawarian\Raylib\Generated\AudioStream $stream;

    /**
     * Total number of samples
     */
    public int $sampleCount;

    /**
     * Music looping enable
     */
    public bool $looping;

    /**
     * Type of music context (audio filetype)
     */
    public int $ctxType;

    /**
     * Audio context data, depends on type
     */
    public FFI\CData $ctxData;

    public function __construct(\Nawarian\Raylib\Generated\AudioStream $stream, int $sampleCount, bool $looping, int $ctxType, \FFI\CData $ctxData)
    {
        $this->stream = $stream;
        $this->sampleCount = $sampleCount;
        $this->looping = $looping;
        $this->ctxType = $ctxType;
        $this->ctxData = $ctxData;
    }

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Music');
        $type->stream = $this->stream->toCData();
        $type->sampleCount = $this->sampleCount;
        $type->looping = $this->looping->toCData();
        $type->ctxType = $this->ctxType;
        $type->ctxData = $this->ctxData;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self(\Nawarian\Raylib\Generated\AudioStream::fromCData($cdata->stream), $cdata->sampleCount, bool::fromCData($cdata->looping), $cdata->ctxType, $cdata->ctxData);
    }
}

