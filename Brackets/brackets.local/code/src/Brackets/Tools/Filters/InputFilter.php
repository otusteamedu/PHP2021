<?php


declare(strict_types=1);


namespace Brackets\Tools\Filters;


class InputFilter
{

    /**
     * get POST param value
     *
     * @param string $paramName
     * @return string|null
     */
    public static function getPostValue(string $paramName): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST[$paramName])) {
            return $_POST[$paramName];
        } else {
            return null;
        }
    }

}