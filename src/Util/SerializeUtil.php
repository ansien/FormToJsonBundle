<?php

declare(strict_types=1);

namespace Ansien\FormToJsonBundle\Util;

class SerializeUtil
{
    public static function isSerializable(mixed $value): bool
    {
        $return = true;
        $arr = [$value];

        array_walk_recursive($arr, function ($element) use (&$return) {
            if (is_object($element) && get_class($element) == 'Closure') {
                $return = false;
            }
        });

        return $return;
    }
}
