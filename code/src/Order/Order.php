<?php

namespace App\Order;

use App\Order\Queue\Create;
use App\Order\Queue\Select;

class Order
{
    private $method;
    public function Order()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        if ($this->method == 'POST') {
            (new Create())->Create();
        }

        if ($this->method == 'GET') {
            (new Select())->Select();
        }
    }
    

}
