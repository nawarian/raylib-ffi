<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

use FFI\CData;
use FFI\ParserException;
use InvalidArgumentException;
use Nawarian\Raylib\RaylibFFIProxy;

final class Mesh
{
    public int $vertexCount = 0;
    public int $triangleCount = 0;

    /**
     * Vertex position (XYZ - 3 components per vertex) (shader-location = 0)
     * @var float[]
     */
    public array $vertices = [];

    /**
     * Vertex texture coordinates (UV - 2 components per vertex) (shader-location = 1)
     * @var float[]
     */
    public array $texcoords = [];

    /**
     * Vertex second texture coordinates (useful for lightmaps) (shader-location = 5)
     * @var float[]
     */
    public array $texcoords2 = [];

    /**
     * Vertex normals (XYZ - 3 components per vertex) (shader-location = 2)
     * @var float[]
     */
    public array $normals = [];

    /**
     * Vertex tangents (XYZW - 4 components per vertex) (shader-location = 4)
     * @var float[]
     */
    public array $tangents = [];

    /**
     * Vertex colors (RGBA - 4 components per vertex) (shader-location = 3)
     * @var string[]
     */
    public array $colors = [];

    /**
     * Vertex indices (in case vertex data comes indexed)
     * @var int[]
     */
    public array $indices = [];

    /**
     * Animated vertex positions (after bones transformations)
     * @var float[]
     */
    public array $animVertices = [];

    /**
     * Animated normals (after bones transformations)
     * @var float[]
     */
    public array $animNormals = [];

    /**
     * Vertex bone ids, up to 4 bones influence by vertex (skinning)
     * @var int[]
     */
    public array $boneIds = [];

    /**
     * Vertex bone weight, up to 4 bones influence by vertex (skinning)
     * @var float[]
     */
    public array $boneWeights = [];

    public int $vaoId = 0; // OpenGL Vertex Array Object id

    public int $vboId = 0; // OpenGL Vertex Buffer Objects id (default vertex data)

    /**
     * @psalm-suppress MixedAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public static function fromStruct(CData $struct): self
    {
        $mesh = new self();
        $mesh->vertexCount = $struct->vertexCount;
        $mesh->triangleCount = $struct->triangleCount;
        $mesh->vertices = $struct->vertices;
        $mesh->texcoords = $struct->texcoords;
        $mesh->texcoords2 = $struct->texcoords2;
        $mesh->normals = $struct->normals;
        $mesh->tangents = $struct->tangents;
        $mesh->colors = $struct->colors;
        $mesh->indices = $struct->indices;
        $mesh->animVertices = $struct->animVertices;
        $mesh->animNormals = $struct->animNormals;
        $mesh->boneIds = $struct->boneIds;
        $mesh->boneWeights = $struct->boneWeights;
        $mesh->vaoId = $struct->vaoId;
        $mesh->vboId = $struct->vboId;

        return $mesh;
    }

    /**
     * @psalm-suppress MixedPropertyAssignment
     * @psalm-suppress UndefinedPropertyAssignment
     * @psalm-suppress UndefinedPropertyFetch
     */
    public function toCData(RaylibFFIProxy $ffi): CData
    {
        try {
            /** @var CData $mesh */
            $mesh = $ffi->new('Mesh');
        } catch (ParserException $e) {
            throw new InvalidArgumentException(
                'Object $ffi does not provide the type "struct Mesh"'
            );
        }

        $mesh->vertexCount = $this->vertexCount;
        $mesh->triangleCount = $this->triangleCount;

        // Default vertex data
        $mesh->vertices = $this->vertices; // pointer (!)
        $mesh->texcoords = $this->texcoords; // pointer (!)
        $mesh->texcoords2 = $this->texcoords2; // pointer (!)
        $mesh->normals = $this->normals; // pointer (!)
        $mesh->tangents = $this->tangents; // pointer (!)
        $mesh->colors = $this->colors; // pointer (!)
        $mesh->indices = $this->indices; // pointer (!)

        // Animation vertex data
        $mesh->animVertices = $this->animVertices; // pointer (!)
        $mesh->animNormals = $this->animNormals; // pointer (!)
        $mesh->boneIds = $this->boneIds; // pointer (!)
        $mesh->boneWeights = $this->boneWeights; // pointer (!)

        // OpenGL identifiers
        $mesh->vaoId = $this->vaoId;
        $mesh->vboId = $this->vboId; // pointer (!)

        return $mesh;
    }
}
