<?php


namespace App;


class Filter
{
    public static function fire()
    {
        return htmlentities((string)$_POST['string']);
    }
}