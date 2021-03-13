<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Util;

class StringUtil
{
    public static function snakeToCamelCase(string $input): string
    {
        return str_replace('_', '', lcfirst(ucwords($input, '_')));
    }
}
