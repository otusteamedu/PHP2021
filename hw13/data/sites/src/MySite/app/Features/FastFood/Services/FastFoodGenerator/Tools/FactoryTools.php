<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodGenerator\Tools;

/**
 * Trait FactoryTools
 * @package MySite\app\Features\FastFood\Services\FastFoodGenerator\Tools
 */
trait FactoryTools
{

    /**
     * @param string $className
     * @return string
     */
    public static function getProductNameFromClass(string $className): string
    {
        $names = explode('\\', $className);
        $name = end($names);
        $name = str_replace('Factory', '', $name);
        return strtolower($name);
    }
}
