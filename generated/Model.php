<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

use FFI;

class Model
{
    /**
     * Local transform matrix
     */
    public \Nawarian\Raylib\Generated\Matrix $transform;

    /**
     * Number of meshes
     */
    public int $meshCount;

    /**
     * Number of materials
     */
    public int $materialCount;

    /**
     * Meshes array
     */
    public array $meshes;

    /**
     * Materials array
     */
    public array $materials;

    /**
     * Mesh material number
     */
    public array $meshMaterial;

    /**
     * Number of bones
     */
    public int $boneCount;

    /**
     * Bones information (skeleton)
     */
    public array $bones;

    /**
     * Bones base transformation (pose)
     */
    public array $bindPose;

    public function __construct(\Nawarian\Raylib\Generated\Matrix $transform, int $meshCount, int $materialCount, array $meshes, array $materials, array $meshMaterial, int $boneCount, array $bones, array $bindPose)
    {
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

    public function toCData() : \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Model');
        $type->transform = $this->transform->toCData();
        $type->meshCount = $this->meshCount;
        $type->materialCount = $this->materialCount;
        $type->meshes = $this->meshes;
        $type->materials = $this->materials;
        $type->meshMaterial = $this->meshMaterial;
        $type->boneCount = $this->boneCount;
        $type->bones = $this->bones;
        $type->bindPose = $this->bindPose;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata)
    {
        return new self(
            \Nawarian\Raylib\Generated\Matrix::fromCData($cdata->transform),
            $cdata->meshCount,
            $cdata->materialCount,
            $cdata->meshes, $cdata->materials, $cdata->meshMaterial, $cdata->boneCount, $cdata->bones, $cdata->bindPose);
    }
}

