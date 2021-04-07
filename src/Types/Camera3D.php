<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Camera3D
{
    public const MODE_CUSTOM = 0;
    public const MODE_FREE = 1;
    public const MODE_ORBITAL = 2;
    public const MODE_FIRST_PERSON = 3;
    public const MODE_THIRD_PERSON = 4;

    public const PROJECTION_PERSPECTIVE = 0;
    public const PROJECTION_ORTHOGRAPHIC = 1;

    public Vector3 $position;
    public Vector3 $target;
    public Vector3 $up;
    public float $fovy;
    public int $projection;

    public function __construct(Vector3 $position, Vector3 $target, Vector3 $up, float $fovy, int $projection)
    {
        $this->position = $position;
        $this->target = $target;
        $this->up = $up;
        $this->fovy = $fovy;
        $this->projection = $projection;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $camera */
            $camera = $ffi->new('Camera3D');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Camera3D"'
            );
        }

        $camera->position = $this->position->toCData($ffi);
        $camera->target = $this->target->toCData($ffi);
        $camera->up = $this->up->toCData($ffi);
        $camera->fovy = $this->fovy;
        $camera->type = $this->projection;

        return $camera;
    }
}
