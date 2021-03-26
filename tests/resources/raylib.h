typedef struct Vector2 {
    float x;
    float y;
} Vector2;

typedef struct Vector3 {
    float x;
    float y;
    float z;
} Vector3;


typedef struct Vector4 {
    float x;
    float y;
    float z;
    float w;
} Vector4;

typedef Vector4 Quaternion;

typedef struct Matrix {
    float m0, m4, m8, m12;
    float m1,m5, m9, m13;
    float m2, m6, m10, m14;
    float m3, m7, m11, m15;
} Matrix;

typedef struct Color {
    unsigned char r;
    unsigned char g;
    unsigned char b;
    unsigned char a;
} Color;

typedef struct Rectangle {
    float x;
    float y;
    float width;
    float height;
} Rectangle;

typedef struct Image {
    void *data;
    int width;
    int height;
    int mipmaps;
    int format;
} Image;

typedef struct Texture {
    unsigned int id;
    int width;
    int height;
    int mipmaps;
    int format;
} Texture;

typedef Texture Texture2D;

typedef Texture TextureCubemap;

typedef struct RenderTexture {
    unsigned int id;
    Texture texture;
    Texture depth;
} RenderTexture;

typedef RenderTexture RenderTexture2D;

typedef struct NPatchInfo {
    Rectangle source;
    int left;
    int top;
    int right;
    int bottom;
    int type;
} NPatchInfo;

typedef struct CharInfo {
    int value;
    int offsetX;
    int offsetY;
    int advanceX;
    Image image;
} CharInfo;

typedef struct Font {
    int baseSize;
    int charsCount;
    int charsPadding;
    Texture2D texture;
    Rectangle *recs;
    CharInfo *chars;
} Font;

#define SpriteFont Font

typedef struct Camera3D {
    Vector3 position;
    Vector3 target;
    Vector3 up;
    float fovy;
    int type;
} Camera3D;

typedef Camera3D Camera;

typedef struct Camera2D {
    Vector2 offset;
    Vector2 target;
    float rotation;
    float zoom;
} Camera2D;

typedef struct Mesh {
    int vertexCount;
    int  triangleCount;
    float *vertices;
    float *texcoords;
    float *texcoords2;
    float *normals;
    float *tangents;
    unsigned char *colors;
    unsigned short *indices;
    float *animVertices;
    float *animNormals;
    int *boneIds;
    float *boneWeights;
    unsigned int vaoId;
    unsigned int *vboId;
} Mesh;

typedef struct Shader {
    unsigned int id;
    int *locs;
} Shader;

typedef struct MaterialMap {
    Texture2D texture;
    Color color;
    float value;
} MaterialMap;

typedef struct Material {
    Shader shader;
    MaterialMap *maps;
    float *params;
} Material;

typedef struct Transform {
    Vector3 translation;
    Quaternion rotation;
    Vector3 scale;
} Transform;

typedef struct BoneInfo {
    char name[32];
    int parent;
} BoneInfo;

typedef struct Model {
    Matrix transform;
    int meshCount;
    int materialCount;
    Mesh *meshes;
    Material *materials;
    int *meshMaterial;
    int boneCount;
    BoneInfo *bones;
    Transform *bindPose;
} Model;

typedef struct ModelAnimation {
    int boneCount;
    int frameCount;
    BoneInfo *bones;
    Transform **framePoses;
} ModelAnimation;

typedef struct Ray {
    Vector3 position;
    Vector3 direction;
} Ray;

typedef struct RayHitInfo {
    bool hit;
    float distance;
    Vector3 position;
    Vector3 normal;
} RayHitInfo;

typedef struct BoundingBox {
    Vector3 min;
    Vector3 max;
} BoundingBox;

typedef struct Wave {
    unsigned int sampleCount;
    unsigned int sampleRate;
    unsigned int sampleSize;
    unsigned int channels;
    void *data;
} Wave;

typedef struct rAudioBuffer rAudioBuffer;

typedef struct AudioStream {
    rAudioBuffer *buffer;
    unsigned int sampleRate;
    unsigned int sampleSize;
    unsigned int channels;
} AudioStream;

typedef struct Sound {
    AudioStream stream;
    unsigned int sampleCount;
} Sound;

typedef struct Music {
    AudioStream stream;
    unsigned int sampleCount;
    bool looping;
    int ctxType;
    void *ctxData;
} Music;

typedef struct VrDeviceInfo {
    int hResolution;
    int vResolution;
    float hScreenSize;
    float vScreenSize;
    float eyeToScreenDistance;
    float interpupillaryDistance;
    float lensDistortionValues[4];
    float chromaAbCorrection[4];
} VrDeviceInfo;

typedef void (*TraceLogCallback)(int logType, const char *text, va_list args);
typedef void *(*MemAllocCallback)(int size);
typedef void *(*MemReallocCallback)(void *ptr, int size);
typedef void (*MemFreeCallback)(void *ptr);
typedef unsigned char* (*LoadFileDataCallback)(const char* fileName, unsigned int* bytesRead);
typedef void (*SaveFileDataCallback)(const char *fileName, void *data, unsigned int bytesToWrite);
typedef char *(*LoadFileTextCallback)(const char* fileName);
typedef void (*SaveFileTextCallback)(const char *fileName, char *text);
