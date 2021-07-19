<?php

namespace App\Http;

class Request
{
    private array $data;


    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return !empty($this->data[$key]) ? $this->data[$key] : $default;
    }

    public function all()
    {
        return $this->data;
    }
}