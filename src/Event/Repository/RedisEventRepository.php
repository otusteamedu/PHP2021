<?php


namespace App\Event\Repository;

class RedisEventRepository implements EventRepositoryInterface
{

    private \Redis $conn;

    public function __construct(\Redis $conn)
    {
        $this->conn = $conn;
    }

    public function add(int $priority, array $conditions, array $event)
    {
        $key = $this->makeKey($conditions);
        $this->conn->zAdd($key, $priority, $event);
    }

    public function findHighPriorityEvent($conditions): ?array
    {
        $key = $this->makeKey($conditions);

        $event = $this->conn->zRevRange($key, 0, 0);
        return empty($event) ? null : $event[0];
    }

    public function findAllEvent($conditions): array
    {
        $key = $this->makeKey($conditions);
        return $this->conn->zRange($key, 0, -1);
    }

    public function flush()
    {
        $this->conn->flushAll();
    }

    protected function makeKey($conditions): string
    {
        if (empty($conditions)) {
            return '';
        }

        ksort($conditions);

        $keys = [];
        foreach ($conditions as $key => $val) {
            array_push($keys, "$key-$val");
        }

        return implode(':', $keys);
    }
}