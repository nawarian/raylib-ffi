<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Command;

use Laminas\Code\DeclareStatement;
use Laminas\Code\Generator\FileGenerator;
use Nawarian\Raylib\Generator\RaylibClassTypeGenerator;
use Nawarian\Raylib\Generator\RaylibFunctionGenerator;

final class GenerateRaylibWrappers
{
    private const OUTPUT_DIR = __DIR__ . '/../../generated';
    private const SKIP_FUNCTIONS = [
        'SetTraceLogCallback',
        'TraceLog',
        'SetLoadFileDataCallback',
        'SetSaveFileDataCallback',
        'SetLoadFileTextCallback',
        'SetSaveFileTextCallback',
        'TextFormat',
        'TextJoin',
    ];

    public static array $knownTypes = [];
    public static string $globalRaylibVariable = '$raylib';

    public static function generate(): void
    {
        $spec = json_decode(file_get_contents(__DIR__ . '/../../resources/raylib_api.json'));

        // Generate class types
        foreach ($spec->structs as $struct) {
            $class = RaylibClassTypeGenerator::fromRaylibStruct($struct);
            self::$knownTypes[] = '\\' . $class->getNamespaceName() . '\\' . $class->getName();

            $fileGenerator = new FileGenerator();
            $fileGenerator
                ->setDeclares([DeclareStatement::strictTypes(1)])
                ->setClass($class)
                ->setFilename(self::OUTPUT_DIR . '/' . $struct->name . '.php')
                ->write();
        }
        self::$knownTypes = array_unique(self::$knownTypes);

        // Generate functions.php
        $fileGenerator = new FileGenerator();
        $functions = [];
        foreach ($spec->functions as $function) {
            if (in_array($function->name, self::SKIP_FUNCTIONS)) {
                continue;
            }

            $functions[] = RaylibFunctionGenerator::fromRaylibStruct($function)->generate();
        }

        $fileGenerator
            ->setDeclares([DeclareStatement::strictTypes(1)])
            ->setBody(implode(PHP_EOL, $functions))
            ->setFilename(self::OUTPUT_DIR . '/functions.php')
            ->setNamespace('Nawarian\\Raylib\\Generated')
            ->write();
    }
}
