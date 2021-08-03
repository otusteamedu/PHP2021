<?php


declare(strict_types=1);


namespace Chat;


use \Chat\Sockets\Templates\Runnable;

final class Console
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