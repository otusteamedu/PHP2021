<?php

namespace App;

use App\Product\Product;
use App\Order\Order;

class App
{

    public function run()
    {
        $url = $_SERVER['REQUEST_URI'];

        $object = explode("/", $url);

        if ($object[1] == 'product') {
            (new Product())->Product();
        }

        if ($object[1] == 'order') {
            (new Order())->Order();
            
        }
    }
}