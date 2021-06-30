// Structures Definition
//----------------------------------------------------------------------------------
// Vector2 type
typedef struct Vector2 {
    float x;
    float y;
} Vector2;

// Vector3 type
typedef struct Vector3 {
    float x;
    float y;
    float z;
} Vector3;

// Vector4 type
typedef struct Vector4 {
    float x;
    float y;
    float z;
    float w;
} Vector4;

// Quaternion type, same as Vector4
typedef Vector4 Quaternion;

// Matrix type (OpenGL style 4x4 - right handed, column major)
typedef struct Matrix {
    float m0, m4, m8, m12;
    float m1, m5, m9, m13;
    float m2, m6, m10, m14;
    float m3, m7, m11, m15;
} Matrix;

// Color type, RGBA (32bit)
typedef struct Color {
    unsigned char r;
    unsigned char g;
    unsigned char b;
    unsigned char a;
} Color;

// Rectangle type
typedef struct Rectangle {
    float x;
    float y;
    float width;
    float height;
} Rectangle;

// Image type, bpp always RGBA (32bit)
// NOTE: Data stored in CPU memory (RAM)
typedef struct Image {
    void *data;             // Image raw data
    int width;              // Image base width
    int height;             // Image base height
    int mipmaps;            // Mipmap levels, 1 by default
    int format;             // Data format (PixelFormat type)
} Image;

// Texture type
// NOTE: Data stored in GPU memory
typedef struct Texture {
    unsigned int id;        // OpenGL texture id
    int width;              // Texture base width
    int height;             // Texture base height
    int mipmaps;            // Mipmap levels, 1 by default
    int format;             // Data format (PixelFormat type)
} Texture;

// Texture2D type, same as Texture
typedef Texture Texture2D;

// TextureCubemap type, actually, same as Texture
typedef Texture TextureCubemap;

// RenderTexture type, for texture rendering
typedef struct RenderTexture {
    unsigned int id;        // OpenGL framebuffer object id
    Texture texture;        // Color buffer attachment texture
    Texture depth;          // Depth buffer attachment texture
} RenderTexture;

// RenderTexture2D type, same as RenderTexture
typedef RenderTexture RenderTexture2D;

// N-Patch layout info
typedef struct NPatchInfo {
    Rectangle source;       // Texture source rectangle
    int left;               // Left border offset
    int top;                // Top border offset
    int right;              // Right border offset
    int bottom;             // Bottom border offset
    int layout;             // Layout of the n-patch: 3x3, 1x3 or 3x1
} NPatchInfo;

// Font character info
typedef struct CharInfo {
    int value;              // Character value (Unicode)
    int offsetX;            // Character offset X when drawing
    int offsetY;            // Character offset Y when drawing
    int advanceX;           // Character advance position X
    Image image;            // Character image data
} CharInfo;

// Font type, includes texture and charSet array data
typedef struct Font {
    int baseSize;           // Base size (default chars height)
    int charsCount;         // Number of characters
    int charsPadding;       // Padding around the chars
    Texture2D texture;      // Characters texture atlas
    Rectangle *recs;        // Characters rectangles in texture
    CharInfo *chars;        // Characters info data
} Font;

#define SpriteFont Font     // SpriteFont type fallback, defaults to Font

// Camera type, defines a camera position/orientation in 3d space
typedef struct Camera3D {
    Vector3 position;       // Camera position
    Vector3 target;         // Camera target it looks-at
    Vector3 up;             // Camera up vector (rotation over its axis)
    float fovy;             // Camera field-of-view apperture in Y (degrees) in perspective, used as near plane width in orthographic
    int projection;         // Camera projection: CAMERA_PERSPECTIVE or CAMERA_ORTHOGRAPHIC
} Camera3D;

typedef Camera3D Camera;    // Camera type fallback, defaults to Camera3D

// Camera2D type, defines a 2d camera
typedef struct Camera2D {
    Vector2 offset;         // Camera offset (displacement from target)
    Vector2 target;         // Camera target (rotation and zoom origin)
    float rotation;         // Camera rotation in degrees
    float zoom;             // Camera zoom (scaling), should be 1.0f by default
} Camera2D;

// Vertex data definning a mesh
// NOTE: Data stored in CPU memory (and GPU)
typedef struct Mesh {
    int vertexCount;        // Number of vertices stored in arrays
    int triangleCount;      // Number of triangles stored (indexed or not)

    // Default vertex data
    float *vertices;        // Vertex position (XYZ - 3 components per vertex) (shader-location = 0)
    float *texcoords;       // Vertex texture coordinates (UV - 2 components per vertex) (shader-location = 1)
    float *texcoords2;      // Vertex second texture coordinates (useful for lightmaps) (shader-location = 5)
    float *normals;         // Vertex normals (XYZ - 3 components per vertex) (shader-location = 2)
    float *tangents;        // Vertex tangents (XYZW - 4 components per vertex) (shader-location = 4)
    unsigned char *colors;  // Vertex colors (RGBA - 4 components per vertex) (shader-location = 3)
    unsigned short *indices;// Vertex indices (in case vertex data comes indexed)

    // Animation vertex data
    float *animVertices;    // Animated vertex positions (after bones transformations)
    float *animNormals;     // Animated normals (after bones transformations)
    int *boneIds;           // Vertex bone ids, up to 4 bones influence by vertex (skinning)
    float *boneWeights;     // Vertex bone weight, up to 4 bones influence by vertex (skinning)

    // OpenGL identifiers
    unsigned int vaoId;     // OpenGL Vertex Array Object id
    unsigned int *vboId;    // OpenGL Vertex Buffer Objects id (default vertex data)
} Mesh;

// Shader type (generic)
typedef struct Shader {
    unsigned int id;        // Shader program id
    int *locs;              // Shader locations array (MAX_SHADER_LOCATIONS)
} Shader;

// Material texture map
typedef struct MaterialMap {
    Texture2D texture;      // Material map texture
    Color color;            // Material map color
    float value;            // Material map value
} MaterialMap;

// Material type (generic)
typedef struct Material {
    Shader shader;          // Material shader
    MaterialMap *maps;      // Material maps array (MAX_MATERIAL_MAPS)
    float params[4];        // Material generic parameters (if required)
} Material;

// Transformation properties
typedef struct Transform {
    Vector3 translation;    // Translation
    Quaternion rotation;    // Rotation
    Vector3 scale;          // Scale
} Transform;

// Bone information
typedef struct BoneInfo {
    char name[32];          // Bone name
    int parent;             // Bone parent
} BoneInfo;

// Model type
typedef struct Model {
    Matrix transform;       // Local transform matrix

    int meshCount;          // Number of meshes
    int materialCount;      // Number of materials
    Mesh *meshes;           // Meshes array
    Material *materials;    // Materials array
    int *meshMaterial;      // Mesh material number

    // Animation data
    int boneCount;          // Number of bones
    BoneInfo *bones;        // Bones information (skeleton)
    Transform *bindPose;    // Bones base transformation (pose)
} Model;

// Model animation
typedef struct ModelAnimation {
    int boneCount;          // Number of bones
    int frameCount;         // Number of animation frames
    BoneInfo *bones;        // Bones information (skeleton)
    Transform **framePoses; // Poses array by frame
} ModelAnimation;

// Ray type (useful for raycast)
typedef struct Ray {
    Vector3 position;       // Ray position (origin)
    Vector3 direction;      // Ray direction
} Ray;

// Raycast hit information
typedef struct RayHitInfo {
    bool hit;               // Did the ray hit something?
    float distance;         // Distance to nearest hit
    Vector3 position;       // Position of nearest hit
    Vector3 normal;         // Surface normal of hit
} RayHitInfo;

// Bounding box type
typedef struct BoundingBox {
    Vector3 min;            // Minimum vertex box-corner
    Vector3 max;            // Maximum vertex box-corner
} BoundingBox;

// Wave type, defines audio wave data
typedef struct Wave {
    unsigned int sampleCount;       // Total number of samples
    unsigned int sampleRate;        // Frequency (samples per second)
    unsigned int sampleSize;        // Bit depth (bits per sample): 8, 16, 32 (24 not supported)
    unsigned int channels;          // Number of channels (1-mono, 2-stereo)
    void *data;                     // Buffer data pointer
} Wave;

typedef struct rAudioBuffer rAudioBuffer;

// Audio stream type
// NOTE: Useful to create custom audio streams not bound to a specific file
typedef struct AudioStream {
    rAudioBuffer *buffer;           // Pointer to internal data used by the audio system

    unsigned int sampleRate;        // Frequency (samples per second)
    unsigned int sampleSize;        // Bit depth (bits per sample): 8, 16, 32 (24 not supported)
    unsigned int channels;          // Number of channels (1-mono, 2-stereo)
} AudioStream;

// Sound source type
typedef struct Sound {
    AudioStream stream;             // Audio stream
    unsigned int sampleCount;       // Total number of samples
} Sound;

// Music stream type (audio file streaming from memory)
// NOTE: Anything longer than ~10 seconds should be streamed
typedef struct Music {
    AudioStream stream;             // Audio stream
    unsigned int sampleCount;       // Total number of samples
    bool looping;                   // Music looping enable

    int ctxType;                    // Type of music context (audio filetype)
    void *ctxData;                  // Audio context data, depends on type
} Music;

// Head-Mounted-Display device parameters
typedef struct VrDeviceInfo {
    int hResolution;                // Horizontal resolution in pixels
    int vResolution;                // Vertical resolution in pixels
    float hScreenSize;              // Horizontal size in meters
    float vScreenSize;              // Vertical size in meters
    float vScreenCenter;            // Screen center in meters
    float eyeToScreenDistance;      // Distance between eye and display in meters
    float lensSeparationDistance;   // Lens separation distance in meters
    float interpupillaryDistance;   // IPD (distance between pupils) in meters
    float lensDistortionValues[4];  // Lens distortion constant parameters
    float chromaAbCorrection[4];    // Chromatic aberration correction parameters
} VrDeviceInfo;

// VR Stereo rendering configuration for simulator
typedef struct VrStereoConfig {
    Matrix projection[2];           // VR projection matrices (per eye)
    Matrix viewOffset[2];           // VR view offset matrices (per eye)
    float leftLensCenter[2];        // VR left lens center
    float rightLensCenter[2];       // VR right lens center
    float leftScreenCenter[2];      // VR left screen center
    float rightScreenCenter[2];     // VR right screen center
    float scale[2];                 // VR distortion scale
    float scaleIn[2];               // VR distortion scale in
} VrStereoConfig;

// Callbacks to hook some internal functions
// WARNING: This callbacks are intended for advance users
typedef void (*TraceLogCallback)(int logLevel, const char *text, va_list args);  // Logging: Redirect trace log messages
typedef unsigned char* (*LoadFileDataCallback)(const char* fileName, unsigned int* bytesRead);      // FileIO: Load binary data
typedef bool (*SaveFileDataCallback)(const char *fileName, void *data, unsigned int bytesToWrite);  // FileIO: Save binary data
typedef char *(*LoadFileTextCallback)(const char* fileName);                // FileIO: Load text data
typedef bool (*SaveFileTextCallback)(const char *fileName, char *text);     // FileIO: Save text data

