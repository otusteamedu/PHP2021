<?php


namespace App;


class Config
{
    /**
     * @var array
     */
    private $values;

    /**
     * Constructor.
     *
     * @param array $values
     */
    public function __construct($values)
    {
        $this->values = $values;
    }

    /**
     * Get configuration value by key.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->values[$key];
    }

}