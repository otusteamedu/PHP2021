<?php

namespace MySite\app\Support\Traits;

/**
 * Class EventTools
 * @package MySite\app\Support\Traits
 */
trait EventTools
{

    /**
     * @param array $conditions
     * @return string
     */
    private static function createKey(array $conditions): string
    {
        $chunks = [];
        ksort($conditions);

        foreach ($conditions as $key => $value) {
            $chunks[] = strtolower($key) . ':' . strtolower($value);
        }
        return join(':', $chunks);
    }
}
