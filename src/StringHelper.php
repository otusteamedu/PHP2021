<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 04.03.2022
 * Time: 16:57
 */

namespace app;

/**
 * Хелпер работы со строками
 *
 * Class StringHelper
 * @package app
 */
class StringHelper
{
    /**
     * Преобразование строки вида foo_bar в fooBar
     *
     * @param string $value
     * @return string
     */
    public static function camelize(string $value): string
    {
        $tokens = array_map("ucFirst", explode("_", $value));

        return lcfirst(implode("", $tokens));
    }

    /**
     * Преобразование строки вида foo_bar в FooBar
     *
     * @param string $value
     * @return string
     */
    public static function id2camel(string $value): string
    {
        return ucfirst(self::camelize($value));
    }
}
