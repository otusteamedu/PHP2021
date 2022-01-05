<?php


namespace App;


class Filter
{
    public static function getString()
    {
        return htmlentities((string)$_POST['string']);
    }
}