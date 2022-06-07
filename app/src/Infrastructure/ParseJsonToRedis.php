<?php

namespace Src\Infrastructure;

class ParseJsonToRedis
{
    private array $result = [];
    private array $keys = [
        'priority',
        'event',
        'param1',
        'param2'
    ];

    /**
     * @param array $array
     * @return array
     */
    public function arrayParse(array $array = []): array
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->arrayParse($value);
            } else {
                if (in_array($key, $this->keys)) {
                    $this->result[$key] = $value;
                }
            }
        }

        return $this->result;
    }

    /**
     * @param array $array
     * @return bool
     */
    private function addToRedis(array $array = []): bool
    {
        $redis = new RedisTasks();

        foreach ($array as $value) {
            $data = json_decode($value, true);
            $this->result = [];
            $key = [];
            $this->arrayParse($data);

            if (!empty($this->result['param1'])) {
                $key[] = "param:1:{$this->result['param1']}";
            }

            if (!empty($this->result['param2'])) {
                $key[] = "param:2:{$this->result['param2']}";
            }

            $redis->add(
                implode(':', $key),
                $this->result['priority'],
                $this->result['event']
            );
        }
        return true;
    }

    /**
     * @return bool
     */
    private function parseResult(): bool
    {
        $fileName = "./file/data.txt";
        $resultParse = false;
        if (file_exists($fileName)) {
            $array = explode("\n", file_get_contents($fileName));
            if (!empty($array)) {
                $resultParse = $this->addToRedis($array);
            }
        }
        return $resultParse;
    }

    /**
     * @return bool
     */
    public function run(): bool
    {
        return $this->parseResult();
    }
}