<?php

declare(strict_types=1);

namespace Nawarian\Raylib;

trait CStylePrintfTypeTranslatorTrait
{
    public function translateCStylePrintfTypeField(string $text): string
    {
        // @todo implement a proper Printf parser
        // @see https://en.wikipedia.org/wiki/Printf_format_string
        $text = str_replace('%i', '%d', $text);

        return $text;
    }
}
