<?php

declare(strict_types=1);

namespace Tests;


use Elasticsearch\Client;
use MySite\app\Support\Facades\Schema;

/**
 * ./vendor/bin/phpunit --testdox ./tests/ElasticTest.php
 *
 * Class ElasticTest
 * @package Tests
 */
class ElasticTest extends BaseTest
{

    public function testConnectionClient()
    {
        $client = Schema::connection();
        $this->assertInstanceOf(Client::class, $client);
    }
}
