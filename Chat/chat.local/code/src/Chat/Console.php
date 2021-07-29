<?php


namespace Chat;


use Chat\Sockets\Runnable;

class Console
{

    private Runnable $appInstance;

    public function __construct(array $inputArgs)
    {
        $className = "Chat\\Sockets\\" . ucfirst($inputArgs[1]);
        if (class_exists($className)) {
            $this->appInstance = new $className();
        } else {
            throw new \Exception("Running mode class (\"$className\") was not found! Ckeck passed parameter!");
        }
    }

    public function run(): void
    {
        $this->appInstance->run();
    }

}