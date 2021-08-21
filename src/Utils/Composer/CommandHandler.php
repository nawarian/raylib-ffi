<?php

declare(strict_types=1);

namespace Nawarian\Raylib\Utils\Composer;

use Laminas\Code\DeclareStatement;
use Laminas\Code\Reflection\ClassReflection;
use Laminas\Code\Reflection\MethodReflection;
use Nawarian\Raylib\Raylib;
use Laminas\Code\Generator\FileGenerator;

final class CommandHandler
{
    public static function generateFunctionsFile(): void
    {
        $globalRaylibVariableName = 'raylib_' . md5('raylib');
        $file = new FileGenerator();

        $file
            ->setFilename(__DIR__ . '/../../generated-functions.php')
            ->setDeclares([DeclareStatement::strictTypes(1)])
            ->setNamespace('Nawarian\\Raylib');

        // Declare global variable
        $body = <<<PHP
        // phpcs:disable
        \$factory = new RaylibFactory();
        /**
        * @psalm-suppress InvalidGlobal 
        */
        global \${$globalRaylibVariableName};
        \${$globalRaylibVariableName} = \$factory->newInstance();
        unset(\$factory);


        PHP;

        // Declare equivalent raylib functions
        $methods = self::fetchRaylibMethods();
        foreach ($methods as $method) {
            $name = ucfirst($method->getName());
            $params = [];
            $paramsCall = [];
            foreach ($method->getParameters() as $param) {
                $type = $param->detectType();

                // class
                if ($type !== null && class_exists($type) && $class = $param->getClass()) {
                    $file->setUse($class->getName());

                    if ($param->isVariadic()) {
                        $params[] = "{$class->getShortName()} ...\${$param->getName()}";
                    } else {
                        $params[] = "{$class->getShortName()} \${$param->getName()}";
                    }
                // primitive
                } else {
                    if ($param->isVariadic()) {
                        $params[] = "{$type} ...\${$param->getName()}";
                    } else {
                        $params[] = "{$type} \${$param->getName()}";
                    }
                }
                $paramsCall[] = $param->isVariadic() ? "...\${$param->getName()}" : "\${$param->getName()}";
            }
            $paramsStr = implode(', ', $params);
            $paramCallStr = implode(', ', $paramsCall);

            $returnTypeStr = '';
            $returnStr = '';
            if ($method->hasReturnType() && $returnType = $method->getReturnType()) {
                $returnTypeName = (string) $method->getReturnType();

                // special handling for class
                if (class_exists((string) $returnType)) {
                    /**
                     * @psalm-suppress ArgumentTypeCoercion
                     */
                    $returnTypeRef = new ClassReflection((string) $method->getReturnType());

                    $file->setUse($returnTypeRef->getName());
                    $returnTypeName = $returnTypeRef->getShortName();
                }

                $returnTypeStr .= ': ';

                if ($returnType->allowsNull()) {
                    $returnTypeStr .= '?';
                }

                $returnTypeStr .= $returnTypeName;

                if ((string) $returnType !== 'void') {
                    $returnStr = 'return ';
                }
            }

            $body .= <<<PHPFUNCTION
            /**
             * @psalm-suppress MissingParamType
             */
            function {$name}({$paramsStr}){$returnTypeStr}
            {
                global \${$globalRaylibVariableName};
                {$returnStr}\${$globalRaylibVariableName}->{$method->getName()}($paramCallStr);
            }


            PHPFUNCTION;
        }

        $body .= PHP_EOL . '// phpcs:enable';

        $file
            ->setBody($body)
            ->write();
    }

    /**
     * @return iterable<MethodReflection>
     */
    private static function fetchRaylibMethods(): iterable
    {
        $ref = new ClassReflection(Raylib::class);
        foreach ($ref->getMethods() as $method) {
            // skip all magic and deprecated methods
            if (
                str_starts_with($method->getName(), '__')
                || str_contains($method->getDocComment() ?: '', '@deprecated')
            ) {
                continue;
            }

            yield $method;
        }
    }
}
