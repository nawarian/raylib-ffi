<?php

declare(strict_types=1);

function easeElasticOut(float $t, float $b, float $c, float $d): float
{
    if ($t == 0) {
        return $b;
    }

    if (($t /= $d) == 1) {
        return ($b + $c);
    }

    $p = $d * 0.3;
    $a = $c;
    $s = $p / 4;

    return (
        $a
        * pow(2, -10 * $t)
        * sin(($t * $d - $s) * (2 * pi()) / $p)
        + $c
        + $b
    );
}

function easeElasticIn(float $t, float $b, float $c, float $d): float
{
    if ($t === 0.0) {
        return $b;
    }

    if (($t /= $d) === 1.0) {
        return ($b + $c);
    }

    $p = $d * 0.3;
    $a = $c;
    $s = $p / 4;
    $postFix = $a * pow(2, 10 * ($t -= 1));

    return (-($postFix * sin(($t * $d - $s) * (2 * pi()) / $p)) + $b);
}

function easeBounceOut(float $t, float $b, float $c, float $d): float
{
    if (($t /= $d) < (1 / 2.75)) {
        return ($c * (7.5625 * $t * $t) + $b);
    } elseif ($t < (2 / 2.75)) {
        $postFix = $t -= (1.5 / 2.75);
        return ($c * (7.5625 * ($postFix) * $t + 0.75) + $b);
    } elseif ($t < (2.5 / 2.75)) {
        $postFix = $t -= (2.25 / 2.75);
        return ($c * (7.5625 * ($postFix) * $t + 0.9375) + $b);
    }

    $postFix = $t -= (2.625 / 2.75);
    return ($c * (7.5625 * ($postFix) * $t + 0.984375) + $b);
}

function easeQuadOut(float $t, float $b, float $c, float $d): float
{
    $t /= $d;

    return (-$c * $t * ($t - 2) + $b);
}

function easeCircOut(float $t, float $b, float $c, float $d): float
{
    $t = $t / $d - 1;

    return ($c * sqrt(1 - $t * $t) + $b);
}

function easeCubicOut(float $t, float $b, float $c, float $d): float
{
    $t = $t / $d - 1;

    return ($c * ($t * $t * $t + 1) + $b);
}

function easeSineOut(float $t, float $b, float $c, float $d): float
{
    return ($c * sin($t / $d * (pi() / 2)) + $b);
}

function EaseLinearIn(float $t, float $b, float $c, float $d): float
{
    return ($c * $t / $d + $b);
}
