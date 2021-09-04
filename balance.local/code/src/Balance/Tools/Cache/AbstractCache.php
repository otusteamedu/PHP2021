<?php


declare(strict_types=1);


namespace Balance\Tools\Cache;


abstract class AbstractCache
{

    public abstract function get(string $key): mixed;

    public abstract function set(string $key, mixed $value): mixed;

}