<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI;
use FFI\CData;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Model
{
    public CData $transform;
    public int $meshCount;
    public int $materialCount;
    public CData $meshes;
    public CData $materials;
    public CData $meshMaterial;
    public int $boneCount;
    public CData $bones;
    public CData $bindPose;

    public function __construct(
        CData $transform,
        int $meshCount,
        int $materialCount,
        CData $meshes,
        CData $materials,
        CData $meshMaterial,
        int $boneCount,
        CData $bones,
        CData $bindPose
    ) {
        $this->transform = $transform;
        $this->meshCount = $meshCount;
        $this->materialCount = $materialCount;
        $this->meshes = $meshes;
        $this->materials = $materials;
        $this->meshMaterial = $meshMaterial;
        $this->boneCount = $boneCount;
        $this->bones = $bones;
        $this->bindPose = $bindPose;
    }

    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            $model = $ffi->new('Model');
        } catch (FFI\ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Model"'
            );
        }

        $model->transform = $this->transform;
        $model->meshCount = $this->meshCount;
        $model->materialCount = $this->materialCount;
        $model->meshes = $this->meshes;
        $model->materials = $this->materials;
        $model->meshMaterial = $this->meshMaterial;
        $model->boneCount = $this->boneCount;
        $model->bones = $this->bones;
        $model->bindPose = $this->bindPose;

        return $model;
    }
}
