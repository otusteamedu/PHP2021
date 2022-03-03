<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 02.03.2022
 * Time: 21:48
 */

namespace app;

use PDO;

/**
 * Инстанс базы данных
 *
 * Class DataBase
 * @package app
 */
class DataBase
{
    /**
     * @var PDO|null
     */
    private static ?PDO $pdo = null;

    /**
     *
     */
    private function __construct()
    {
    }

    /**
     * Экземпляр объекта
     *
     * @return PDO
     */
    public static function instance(): PDO
    {
        if (static::$pdo === null) {
            static::$pdo = new PDO(
                getenv('DB_DNS'),
                getenv('DB_USERNAME'),
                getenv('DB_PASSWORD')
            );
        }

        return static::$pdo;
    }
}
