<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Camera2D
{
    public Vector2 $offset;
    public Vector2 $target;
    public float $rotation;
    public float $zoom;

    public function __construct(Vector2 $offset, Vector2 $target, float $rotation, float $zoom)
    {
        $this->offset = $offset;
        $this->target = $target;
        $this->rotation = $rotation;
        $this->zoom = $zoom;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $camera = $ffi->new('Camera2D');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Camera2D"'
            );
        }

        $camera->offset = $this->offset->toCData($ffi);
        $camera->target = $this->target->toCData($ffi);
        $camera->rotation = $this->rotation;
        $camera->zoom = $this->zoom;

        return $camera;
    }
}
