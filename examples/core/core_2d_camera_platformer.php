<?php

declare(strict_types=1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Nawarian\Raylib\Raylib;
use Nawarian\Raylib\RaylibFactory;
use Nawarian\Raylib\Types\{
    Camera2D,
    Color,
    Rectangle,
    Vector2
};

$raylibFactory = new RaylibFactory();

/** @var Raylib $raylib */
$raylib = $raylibFactory->newInstance();

const G = 400;
const PLAYER_JUMP_SPD = 350.0;
const PLAYER_HOR_SPD = 200.0;

class Player
{
    public Vector2 $position;
    public float $speed = 0;
    public bool $canJump = false;

    public function __construct(float $x, float $y)
    {
        $this->position = new Vector2($x, $y);
    }
}

class EnvItem
{
    public Rectangle $rect;
    public bool $blocking;
    public Color $color;

    public function __construct(Rectangle $rect, bool $blocking, Color $color)
    {
        $this->rect = $rect;
        $this->blocking = $blocking;
        $this->color = $color;
    }
}

function UpdatePlayer(Raylib $raylib, Player $player, iterable $envItems, float $delta): void
{
    if ($raylib->isKeyDown(Raylib::KEY_LEFT)) {
        $player->position->x -= PLAYER_HOR_SPD * $delta;
    }

    if ($raylib->isKeyDown(Raylib::KEY_RIGHT)) {
        $player->position->x += PLAYER_HOR_SPD * $delta;
    }

    if ($raylib->isKeyDown(Raylib::KEY_SPACE) && $player->canJump) {
        $player->speed = -PLAYER_JUMP_SPD;
        $player->canJump = false;
    }

    $hitObstacle = false;

    /** @var EnvItem $ei */
    foreach ($envItems as $ei) {
        $p = $player->position;
        if (
            $ei->blocking &&
            $ei->rect->x <= $p->x &&
            $ei->rect->x + $ei->rect->width >= $p->x &&
            $ei->rect->y <= $p->y &&
            $ei->rect->y < $p->y + $player->speed * $delta
        ) {
            $hitObstacle = true;
            $player->speed = 0.0;
            $p->y = $ei->rect->y;
        }
    }

    $player->canJump = $hitObstacle;
    if (!$hitObstacle) {
        $player->position->y += $player->speed * $delta;
        $player->speed += G * $delta;
    }
}

function UpdateCameraCenter(
    Raylib $raylib,
    Camera2D $camera,
    Player $player,
    iterable $envItems,
    float $delta,
    int $width,
    int $height
): void {
    $camera->offset = new Vector2($width / 2.0, $height / 2.0);
    $camera->target = $player->position;
}

function UpdateCameraCenterInsideMap(
    Raylib $raylib,
    Camera2D $camera,
    Player $player,
    iterable $envItems,
    float $delta,
    int $width,
    int $height
): void {
    $camera->target = $player->position;
    $camera->offset = new Vector2($width / 2.0, $height / 2.0);
    $minX = 1000.0;
    $minY = 1000.0;
    $maxX = -1000.0;
    $maxY = -1000;

    /** @var EnvItem $ei */
    foreach ($envItems as $ei) {
        $minX = min($ei->rect->x, $minX);
        $maxX = max($ei->rect->x + $ei->rect->width, $maxX);
        $minY = min($ei->rect->y, $minY);
        $maxY = max($ei->rect->y + $ei->rect->height, $maxY);
    }

    $max = $raylib->getWorldToScreen2D(new Vector2($maxX, $maxY), $camera);
    $min = $raylib->getWorldToScreen2D(new Vector2($minX, $minY), $camera);

    if ($max->x < $width) {
        $camera->offset->x = $width - ($max->x - $width / 2);
    }

    if ($max->y < $height) {
        $camera->offset->y = $height - ($max->y - $height / 2);
    }

    if ($min->x > 0) {
        $camera->offset->x = $width / 2 - $min->x;
    }
    if ($min->y > 0) {
        $camera->offset->y = $height / 2 - $min->y;
    }
}

function UpdateCameraCenterSmoothFollow(
    Raylib $raylib,
    Camera2D $camera,
    Player $player,
    iterable $envItems,
    float $delta,
    int $width,
    int $height
): void {
    $minSpeed = 30;
    $minEffectLength = 10;
    $fractionSpeed = 0.8;

    $camera->offset = new Vector2($width / 2.0, $height / 2.0);
    $diff = $raylib->vector2Subtract($player->position, $camera->target);
    $length = $raylib->vector2Length($diff);

    if ($length > $minEffectLength) {
        $speed = max($fractionSpeed * $length, $minSpeed);
        $camera->target = $raylib->vector2Add(
            $camera->target,
            $raylib->vector2Scale($diff, $speed * $delta / $length),
        );
    }
}

function UpdateCameraEvenOutOnLanding(
    Raylib $raylib,
    Camera2D $camera,
    Player $player,
    iterable $envItems,
    float $delta,
    int $width,
    int $height
): void {
    global $evenOutTarget;
    global $eveningOut;

    $evenOutTarget = (float) $evenOutTarget;
    $eveningOut = !!$eveningOut;
    $evenOutSpeed = 700;

    $camera->offset = new Vector2($width / 2.0, $height / 2.0);
    $camera->target->x = $player->position->x;

    if ($eveningOut) {
        if ($evenOutTarget > $camera->target->y) {
            $camera->target->y += $evenOutSpeed * $delta;

            if ($camera->target->y > $evenOutTarget) {
                $camera->target->y = $evenOutTarget;
                $eveningOut = 0;
            }
        } else {
            $camera->target->y -= $evenOutSpeed * $delta;

            if ($camera->target->y < $evenOutTarget) {
                $camera->target->y = $evenOutTarget;
                $eveningOut = 0;
            }
        }
    } elseif ($player->canJump && ($player->speed == 0) && ($player->position->y != $camera->target->y)) {
        $eveningOut = 1;
        $evenOutTarget = $player->position->y;
    }
}

function UpdateCameraPlayerBoundsPush(
    Raylib $raylib,
    Camera2D $camera,
    Player $player,
    iterable $envItems,
    float $delta,
    int $width,
    int $height
): void {
    $bbox = new Vector2(0.2, 0.2);

    $bboxWorldMin = $raylib->getScreenToWorld2D(
        new Vector2((1 - $bbox->x) * 0.5 * $width, (1 - $bbox->y) * 0.5 * $height),
        $camera,
    );

    $bboxWorldMax = $raylib->getScreenToWorld2D(
        new Vector2((1 + $bbox->x) * 0.5 * $width, (1 + $bbox->y) * 0.5 * $height),
        $camera,
    );

    $camera->offset = new Vector2((1 - $bbox->x) * 0.5 * $width, (1 - $bbox->y) * 0.5 * $height);

    if ($player->position->x < $bboxWorldMin->x) {
        $camera->target->x = $player->position->x;
    }

    if ($player->position->y < $bboxWorldMin->y) {
        $camera->target->y = $player->position->y;
    }

    if ($player->position->x > $bboxWorldMax->x) {
        $camera->target->x = $bboxWorldMin->x + ($player->position->x - $bboxWorldMax->x);
    }

    if ($player->position->y > $bboxWorldMax->y) {
        $camera->target->y = $bboxWorldMin->y + ($player->position->y - $bboxWorldMax->y);
    }
}

// Initialization
//--------------------------------------------------------------------------------------
$screenWidth = 800;
$screenHeight = 450;

$raylib->initWindow($screenWidth, $screenHeight, "raylib [core] example - 2d camera");

$player = new Player(400, 280);
$envItems = [
    new EnvItem(new Rectangle(0, 0, 1000, 400), false, Color::lightGray()),
    new EnvItem(new Rectangle(0, 400, 1000, 200), true, Color::gray()),
    new EnvItem(new Rectangle(300, 200, 400, 10), true, Color::gray()),
    new EnvItem(new Rectangle(250, 300, 100, 10), true, Color::gray()),
    new EnvItem(new Rectangle(650, 300, 100, 10), true, Color::gray()),
];

$camera = new Camera2D(
    new Vector2($screenWidth / 2, $screenHeight / 2),
    $player->position,
    0.0,
    1.0,
);

// Store pointers to the multiple update camera functions
$cameraUpdateFunctions = [
    'UpdateCameraCenter',
    'UpdateCameraCenterInsideMap',
    'UpdateCameraCenterSmoothFollow',
    'UpdateCameraEvenOutOnLanding',
    'UpdateCameraPlayerBoundsPush',
];

$cameraOption = 0;

$cameraDescriptions = [
    "Follow player center",
    "Follow player center, but clamp to map edges",
    "Follow player center; smoothed",
    "Follow player center horizontally; updateplayer center vertically after landing",
    "Player push camera on getting too close to screen edge"
];

$raylib->setTargetFPS(60);
//--------------------------------------------------------------------------------------

// Main game loop
while (!$raylib->windowShouldClose()) {
    // Update
    //----------------------------------------------------------------------------------
    $deltaTime = $raylib->getFrameTime();

    UpdatePlayer($raylib, $player, $envItems, $deltaTime);

    $camera->zoom += $raylib->getMouseWheelMove() * 0.05;

    if ($camera->zoom > 3.0) {
        $camera->zoom = 3.0;
    } elseif ($camera->zoom < 0.25) {
        $camera->zoom = 0.25;
    }

    if ($raylib->isKeyPressed(Raylib::KEY_R)) {
        $camera->zoom = 1.0;
        $player->position = new Vector2(400, 280);
    }

    if ($raylib->isKeyPressed(Raylib::KEY_C)) {
        $cameraOption = ($cameraOption + 1) % count($cameraUpdateFunctions);
    }

    // Call update camera function by its pointer
    $cameraUpdateFunctions[$cameraOption]($raylib, $camera, $player, $envItems, $deltaTime, $screenWidth, $screenHeight);
    //----------------------------------------------------------------------------------

    // Draw
    //----------------------------------------------------------------------------------
    $raylib->beginDrawing();

        $raylib->clearBackground(Color::lightGray());

        $raylib->beginMode2D($camera);

            /** @var EnvItem $ei */
            foreach ($envItems as $ei) {
                $raylib->drawRectangleRec($ei->rect, $ei->color);
            }

            $playerRect = new Rectangle(
                $player->position->x - 20,
                $player->position->y - 40,
                40,
                40,
            );
            $raylib->drawRectangleRec($playerRect, Color::red());

        $raylib->endMode2D();

        $raylib->drawText("Controls:", 20, 20, 10, Color::black());
        $raylib->drawText("- Right/Left to move", 40, 40, 10, Color::darkGray());
        $raylib->drawText("- Space to jump", 40, 60, 10, Color::darkGray());
        $raylib->drawText("- Mouse Wheel to Zoom in-out, R to reset zoom", 40, 80, 10, Color::darkGray());
        $raylib->drawText("- C to change camera mode", 40, 100, 10, Color::darkGray());
        $raylib->drawText("Current camera mode:", 20, 120, 10, Color::darkGray());
        $raylib->drawText($cameraDescriptions[$cameraOption], 40, 140, 10, Color::darkGray());

    $raylib->endDrawing();
    //----------------------------------------------------------------------------------
}

// De-Initialization
//--------------------------------------------------------------------------------------
$raylib->closeWindow();        // Close window and OpenGL context
//--------------------------------------------------------------------------------------
