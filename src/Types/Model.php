<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Model
{
    public Matrix $transform;

    public int $meshCount = 0;
    public int $materialCount = 0;

    /**
     * @var Mesh[]
     */
    public array $meshes = [];

    /**
     * @var Material[]
     */
    public array $materials = [];

    /**
     * @var int[]
     */
    public array $meshMaterial = [];

    public int $boneCount = 0;

    /**
     * @var BoneInfo[]
     */
    public array $bones = [];

    /**
     * @var Transform[]
     */
    public array $bindPose = [];

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $model */
            $model = $ffi->new('Model');
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Model"'
            );
        }

        $model->transform = $this->transform->toCData($ffi);
        $model->meshCount = $this->meshCount;
        $model->materialCount = $this->materialCount;
        $model->meshes = array_map(fn (Mesh $m) => $m->toCData($ffi), $this->meshes);
        $model->materials = array_map(fn (Material $m) => $m->toCData($ffi), $this->materials);
        $model->meshMaterial = $this->meshMaterial;
        $model->boneCount = $this->boneCount;
        $model->bones = array_map(fn (BoneInfo $b) => $b->toCData($ffi), $this->bones);
        $model->bindPose = array_map(fn (Transform $t) => $t->toCData($ffi), $this->bindPose);

        return $model;
    }
}
