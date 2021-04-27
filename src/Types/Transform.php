<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Transform
{
    public Vector3 $translation;
    public Quaternion $rotation;
    public Vector3 $scale;

    public function __construct(Vector3 $translation, Quaternion $rotation, Vector3 $scale)
    {
        $this->translation = $translation;
        $this->rotation = $rotation;
        $this->scale = $scale;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $transform */
            $transform = $ffi->new('Transform');
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Transform"'
            );
        }

        $transform->translation = $this->translation->toCData($ffi);
        $transform->rotation = $this->rotation->toCData($ffi);
        $transform->scale = $this->scale->toCData($ffi);

        return $transform;
    }
}
