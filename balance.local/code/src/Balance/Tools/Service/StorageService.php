<?php


declare(strict_types=1);


namespace Balance\Tools\Service;


use Balance\Tools\Cache\AbstractCache;
use Balance\Tools\Cache\MemcachedCache;

final class StorageService
{

    private ?AbstractCache $cache = null;

    public function __construct()
    {
        if (isset($_ENV["CACHE_MODE"])) {
            switch ($_ENV["CACHE_MODE"]) {
                case "memcached":
                    $this->cache = new MemcachedCache();
                    break;
                default:
                    throw new \Exception("No " . $_ENV["CACHE_MODE"] . " storage found!");
            }
        } else {
            throw new \Exception("CACHE_MODE was not set in .env!");
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->cache->get($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function set(string $key, mixed $value): mixed
    {
        return $this->cache->set($key, $value);
    }

}