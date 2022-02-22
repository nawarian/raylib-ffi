<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Generated;

class Mesh
{
    /**
     * Number of vertices stored in arrays
     */
    public int $vertexCount;

    /**
     * Number of triangles stored (indexed or not)
     */
    public int $triangleCount;

    /**
     * Vertex position (XYZ - 3 components per vertex) (shader-location = 0)
     */
    public array $vertices;

    /**
     * Vertex texture coordinates (UV - 2 components per vertex) (shader-location = 1)
     */
    public array $texcoords;

    /**
     * Vertex second texture coordinates (useful for lightmaps) (shader-location = 5)
     */
    public array $texcoords2;

    /**
     * Vertex normals (XYZ - 3 components per vertex) (shader-location = 2)
     */
    public array $normals;

    /**
     * Vertex tangents (XYZW - 4 components per vertex) (shader-location = 4)
     */
    public array $tangents;

    /**
     * Vertex colors (RGBA - 4 components per vertex) (shader-location = 3)
     */
    public array $colors;

    /**
     * Vertex indices (in case vertex data comes indexed)
     */
    public array $indices;

    /**
     * Animated vertex positions (after bones transformations)
     */
    public array $animVertices;

    /**
     * Animated normals (after bones transformations)
     */
    public array $animNormals;

    /**
     * Vertex bone ids, up to 4 bones influence by vertex (skinning)
     */
    public array $boneIds;

    /**
     * Vertex bone weight, up to 4 bones influence by vertex (skinning)
     */
    public array $boneWeights;

    /**
     * OpenGL Vertex Array Object id
     */
    public int $vaoId;

    /**
     * OpenGL Vertex Buffer Objects id (default vertex data)
     */
    public array $vboId;

    public function __construct(int $vertexCount, int $triangleCount, array $vertices, array $texcoords, array $texcoords2, array $normals, array $tangents, array $colors, array $indices, array $animVertices, array $animNormals, array $boneIds, array $boneWeights, int $vaoId, array $vboId)
    {
        $this->vertexCount = $vertexCount;
        $this->triangleCount = $triangleCount;
        $this->vertices = $vertices;
        $this->texcoords = $texcoords;
        $this->texcoords2 = $texcoords2;
        $this->normals = $normals;
        $this->tangents = $tangents;
        $this->colors = $colors;
        $this->indices = $indices;
        $this->animVertices = $animVertices;
        $this->animNormals = $animNormals;
        $this->boneIds = $boneIds;
        $this->boneWeights = $boneWeights;
        $this->vaoId = $vaoId;
        $this->vboId = $vboId;
    }

    public function toCData(): \FFI\CData
    {
        global $raylib;
        $type = $raylib->new('Mesh');
        $type->vertexCount = $this->vertexCount;
        $type->triangleCount = $this->triangleCount;
        $type->vertices = $this->vertices;
        $type->texcoords = $this->texcoords;
        $type->texcoords2 = $this->texcoords2;
        $type->normals = $this->normals;
        $type->tangents = $this->tangents;
        $type->colors = $this->colors;
        $type->indices = $this->indices;
        $type->animVertices = $this->animVertices;
        $type->animNormals = $this->animNormals;
        $type->boneIds = $this->boneIds;
        $type->boneWeights = $this->boneWeights;
        $type->vaoId = $this->vaoId;
        $type->vboId = $this->vboId;
        return $type;
    }

    public static function fromCData(\FFI\CData $cdata): \Nawarian\Raylib\Generated\Mesh
    {
        return new self($cdata->vertexCount, $cdata->triangleCount, $cdata->vertices, $cdata->texcoords, $cdata->texcoords2, $cdata->normals, $cdata->tangents, $cdata->colors, $cdata->indices, $cdata->animVertices, $cdata->animNormals, $cdata->boneIds, $cdata->boneWeights, $cdata->vaoId, $cdata->vboId);
    }
}
