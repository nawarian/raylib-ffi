<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Shader
{
    public int $id = 0;

    /**
     * @var int[]
     */
    public array $locs = [];

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $shader */
            $shader = $ffi->new('Shader');
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Shader"'
            );
        }

        $shader->id = $this->id;
        $shader->locs = $this->locs;

        return $shader;
    }
}
