<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 09.02.2022
 * Time: 17:33
 */

namespace app\helpers;

use Exception;

/**
 * Хелпер конфигурации
 *
 * Class ConfigHelper
 * @package app\helpers
 */
class ConfigHelper
{
    /**
     * Конфиг
     *
     * @var array
     */
    private array $config;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $filename = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'app.ini';
        $config = parse_ini_file($filename);

        if ($config === false) {
            throw new Exception('Config file not found');
        }

        $this->config = $config;
    }

    /**
     * API ключ youtube
     *
     * @return string|null
     */
    public function getYoutubeApiKey(): ?string
    {
        $config = $this->config;

        return $config['youtube_api_key'] ?? null;
    }

    /**
     * Хост ElasticSearch
     *
     * @return string|null
     */
    public function getEsHost(): ?string
    {
        $config = $this->config;

        return $config['es_host'] ?? null;
    }
}
