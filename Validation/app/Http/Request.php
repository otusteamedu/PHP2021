<?php

namespace App\Http;

class Request
{
    private $data;
    private $files_data;


    public function __construct($data = [], $files = [])
    {
        $this->files_data = $files;
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

    public function file($key)
    {
        return !empty($this->files_data[$key]) ? $this->files_data[$key] : null;
    }

    public function files()
    {
        return $this->files_data;
    }
}