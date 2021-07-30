<?php


declare(strict_types=1);


namespace Chat;


final class App
{

    public function run()
    {
        $callType = php_sapi_name();
        switch ($callType) {
            case "cli":
                global $argv;
                $console = new Console($argv);
                $console->run();
                break;
            default:
                throw new \Exception("Unknown call type");
        }
    }

}