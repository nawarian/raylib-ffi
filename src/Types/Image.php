<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Image
{
    public CData $data;
    public int $width;
    public int $height;
    public int $mipmaps;
    public int $format;

    public function __construct(CData $data, int $width, int $height, int $mipmaps, int $format)
    {
        $this->data = $data;
        $this->width = $width;
        $this->height = $height;
        $this->mipmaps = $mipmaps;
        $this->format = $format;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $image = $ffi->new('Image');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Image"'
            );
        }

        $image->data = $this->data;
        $image->width = $this->width;
        $image->height = $this->height;
        $image->mipmaps = $this->mipmaps;
        $image->format = $this->format;

        return $image;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress MixedReturnStatement
     */
    public function updateFromStruct(CData $imageStruct): CData
    {
        return FFI::addr($imageStruct);
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function updateImageObject(Image $image, CData $imageStruct): Image
    {
        $image->data = $imageStruct->data;
        $image->width = $imageStruct->width;
        $image->height = $imageStruct->height;
        $image->format = $imageStruct->format;
        $image->mipmaps = $imageStruct->mipmaps;

        return $image;
    }
}
