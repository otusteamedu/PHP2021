<?php

namespace App\Source;

use Predis\Client;

class PredisTasks
{
    private object $redis;

    public function __construct()
    {
        $this->redis = $this->connect();
    }

    public function getRedis()
    {
        return $this->redis;
    }

    private function connect(): Client{
        $connection = array(
            "scheme" => "tcp",
            "host"=>"redis",
            "port" => 6379);

        return new \Predis\Client($connection);
    }

    public function zAddRedis($key,$priority,$event):void{
        $this->redis->zadd($key,[$event=>$priority]);
    }

    public function zRevRangeByScoreRedis($key):array{
        return $this->redis->zrevrangebyscore($key,'+inf', '-inf',['withscores'=>true,'limit'=>array(0,1)]);
    }


}