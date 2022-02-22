<?php

namespace Nawarian\Raylib\Generator;

use Laminas\Code\Generator\MethodGenerator;

class CustomMethodGenerator extends MethodGenerator
{
    public function getVisibility()
    {
        switch (true) {
            case $this->flags & self::FLAG_PROTECTED:
                return self::VISIBILITY_PROTECTED;
            case $this->flags & self::FLAG_PRIVATE:
                return self::VISIBILITY_PRIVATE;
            case $this->flags & self::FLAG_PUBLIC:
                return self::VISIBILITY_PUBLIC;
            default:
                return '';
        }
    }
}
