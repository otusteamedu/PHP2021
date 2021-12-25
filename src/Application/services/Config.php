<?php

namespace App\Application\Services;

class Config
{
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new \PHLAK\Config\Config(self::getConfigPath());
        }
        return self::$instance;
    }

    public static function getConfigPath()
    {
        return __DIR__ . "/../../../config/";
    }

    public static function getApp($key)
    {
        return self::getInstance()->get( $key);
    }
}