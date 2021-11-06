<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 31.10.2021
 * Time: 16:32
 */

namespace app;

use Exception;

/**
 * Class App
 */
class App
{
    private const SERVICE_CLIENT = 'client';

    private const SERVICE_SERVER = 'server';

    /**
     * Назвнаие сервиса
     * @var string
     */
    private string $serviceName;

    /**
     * App constructor.
     * @param string $serviceName
     */
    public function __construct(string $serviceName)
    {
        $this->serviceName = $serviceName;

        set_time_limit(0);
        ob_implicit_flush();
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        $serviceName = $this->serviceName;

        switch ($serviceName) {
            case self::SERVICE_SERVER:
                $server = new Server();
                $server->run();

                break;
            case self::SERVICE_CLIENT:
                $client = new Client();
                $client->run();

                break;
            default:
                throw new Exception('Не верное имя сервиса');
        }
    }
}