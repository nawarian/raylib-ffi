<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class BoneInfo
{
    public string $name;
    public int $parent;

    public function __construct(string $name, int $parent)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $bone */
            $bone = $ffi->new('BoneInfo');
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct BoneInfo"'
            );
        }

        $bone->name = $this->name;
        $bone->parent = $this->parent;

        return $bone;
    }
}
