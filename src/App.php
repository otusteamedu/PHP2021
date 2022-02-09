<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 07.11.2021
 * Time: 13:14
 */

namespace app;

use Exception;

/**
 * Class App
 * @package app
 */
class App
{
    /**
     * @throws Exception
     */
    public function run(array $argv)
    {
        $action = $argv[1] ?? null;

        switch ($action) {
            case 'store':
                $channelId = $argv[2] ?? '';
                $app = new StoreApp($channelId);

                break;

            case 'spider':
                $channels = explode(',', $argv[2] ?? '');
                $app = new SpiderApp($channels);

                break;

            case 'statistic':
                $channelId = $argv[2] ?? '';
                $app = new StatisticApp($channelId, 20);

                break;

            default:
                throw new Exception('Action not set');
        }

        $app->execute();
    }
}
