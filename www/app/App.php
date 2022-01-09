<?php

namespace App;

use App\Sapis\Cli;
use App\Sapis\Http;

class App
{
    public function run()
    {
        $type_of_interface = php_sapi_name();

        if ($type_of_interface === false) {
            throw new \Exception('Issue with defining of the current server API name.');
        }

        if ($type_of_interface == 'cli') { // maybe some other, let's keep it simple 
            $interface = new Cli();
        } else {
            $interface = new Http();
        }

        $interface->run();
    }
}