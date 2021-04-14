<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

interface HasRaylibTraceLogConstants
{
    public const LOG_ALL = 0;
    public const LOG_TRACE = 1;
    public const LOG_DEBUG = 2;
    public const LOG_INFO = 3;
    public const LOG_WARNING = 4;
    public const LOG_ERROR = 5;
    public const LOG_FATAL = 6;
    public const LOG_NON = 7;
}
