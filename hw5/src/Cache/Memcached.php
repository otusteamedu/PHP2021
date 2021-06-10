<?php declare(strict_types=1);


namespace App\Cache;


class Memcached implements CacheInterface
{
    private \Memcached $memcached;

    public function __construct(array $config)
    {
        assert(!empty($config['host']), new \InvalidArgumentException('Cache config: empty host'));
        assert(!empty($config['port']), new \InvalidArgumentException('Cache config: need port'));

        $this->memcached = new \Memcached();
        $this->memcached->addServer($config['host'], $config['port']);
    }

    public function get(string $key): mixed
    {
        return $this->memcached->get($key);
    }

    public function set(string $key, mixed $value, int $expire = 0)
    {
        $this->memcached->set($key, $value, $expire);
    }
}
