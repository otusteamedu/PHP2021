<?php


declare(strict_types=1);


namespace Balance\Tools\Cache;


final class MemcachedCache extends AbstractCache
{

    private \Memcached $cache;
    private string $namespace;

    public function __construct()
    {
        $this->cache = new \Memcached();
        $this->namespace = $_ENV["MEMCACHED_NAMESPACE"];
        $this->initServers();
    }

    /**
     * To set one server write in .ENV: MEMCACHED_SERVERS=memcached.local:11211
     * To set pool of servers write in .ENV: MEMCACHED_SERVERS=mem.local:11211,mem2.local:11211,mem3.local:11211
     */
    private function initServers(): void
    {
        $servers = explode(",", $_ENV["MEMCACHED_SERVERS"]);
        foreach ($servers as $server) {
            $serverParams = explode(":", $server);
            $this->cache->addServer(
                $serverParams[0],
                (int)$serverParams[1],
                isset($serverParams[2]) ? (int)$serverParams[2] : 0
            );
        }
    }

    /**
     * @param $key
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function get($key): mixed
    {
        $realKey = $this->getKey($key);
        $storedValue = $this->cache->get($realKey);
        //Check result code because get() returns FALSE both if not found or FALSE was stored
        return $this->cache->getResultCode() !== \Memcached::RES_NOTFOUND ? $storedValue : null;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function set(string $key, mixed $value): mixed
    {
        $realKey = $this->getKey($key);
        $setResult = $this->cache->set($realKey, $value);
        return $setResult ? $value : null;
    }

    /**
     * @param string $key
     * @return string
     */
    private function getKey(string $key): string
    {
        return md5($this->namespace . "." . $key);
    }

}