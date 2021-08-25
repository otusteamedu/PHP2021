<?php

declare(strict_types=1);

namespace MySite\app\Support\Database\Clients;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;
use MySite\app\Support\Contracts\DatabaseClient;

/**
 * Class ElasticSearchClient
 * @package MySite\app\Support\Database\Clients
 */
final class MariaClient implements DatabaseClient
{

    /**
     * @return EntityManager
     * @throws ORMException
     */
    public static function run(): EntityManager
    {
        $dbParams = array(
            'driver' => 'pdo_mysql',
            'user' => getenv('DB_LOGIN'),
            'password' => getenv('DB_PASS'),
            'dbname' => getenv('DB_NAME'),
            'host' => getenv('DB_HOST')
        );
        $config = Setup::createAnnotationMetadataConfiguration(
            [__DIR__ . "/../../Entities"],
            getenv('DEV_MODE')
        );
        return EntityManager::create($dbParams, $config);
    }
}
