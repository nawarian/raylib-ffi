<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Types;

final class Quaternion extends Vector4
{
    public static function fromMatrix(Matrix $matrix): self
    {
        $result = new self(0, 0, 0, 0);

        if (($matrix->m0 > $matrix->m5) && ($matrix->m0 > $matrix->m10)) {
            $s = sqrt(1 + $matrix->m0 - $matrix->m5 - $matrix->m10) * 2;

            $result->x = 0.25 * $s;
            $result->y = ($matrix->m4 + $matrix->m1) / $s;
            $result->z = ($matrix->m2 + $matrix->m8) / $s;
            $result->w = ($matrix->m9 - $matrix->m6) / $s;
        } elseif ($matrix->m5 > $matrix->m10) {
            $s = sqrt(1.0 + $matrix->m5 - $matrix->m0 - $matrix->m10) * 2;

            $result->x = ($matrix->m4 + $matrix->m1) / $s;
            $result->y = 0.25 * $s;
            $result->z = ($matrix->m9 + $matrix->m6) / $s;
            $result->w = ($matrix->m2 - $matrix->m8) / $s;
        } else {
            $s  = sqrt(1.0 + $matrix->m10 - $matrix->m0 - $matrix->m5) * 2;

            $result->x = ($matrix->m2 + $matrix->m8) / $s;
            $result->y = ($matrix->m9 + $matrix->m6) / $s;
            $result->z = 0.25 * $s;
            $result->w = ($matrix->m4 - $matrix->m1) / $s;
        }

        return $result;
    }
}
