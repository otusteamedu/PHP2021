<?php

namespace App\Application\Services;

use App\Application\UseCase\CheckAuthStatus;
use App\Application\ValueObject\Email;
use App\Domain\Models\User;
use GUMP;


class Config extends BaseService
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