<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

class CharInfo
{
    public int $value;
    public int $offsetX;
    public int $offsetY;
    public int $advanceX;
    public CData $image;

    public function __construct(
        int $value,
        int $offsetX,
        int $offsetY,
        int $advanceX,
        CData $image
    ) {
        $this->value = $value;
        $this->offsetX = $offsetX;
        $this->offsetY = $offsetY;
        $this->advanceX = $advanceX;
        $this->image = $image;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $charInfo = $ffi->new('CharInfo');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct CharInfo"'
            );
        }

        $charInfo->value = $this->value;
        $charInfo->offsetX = $this->offsetX;
        $charInfo->offsetY = $this->offsetY;
        $charInfo->advanceX = $this->advanceX;
        $charInfo->image = $this->image;

        return $charInfo;
    }
}
