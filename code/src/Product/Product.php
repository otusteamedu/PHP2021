<?php

namespace App\Product;

use App\Product\Action\Create;
use App\Product\Action\Select;
use App\Product\Action\UpdateAll;
use App\Product\Action\UpdatePatch;
use App\Product\Action\Delete;


class Product
{
    private $method;
    public function Product()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];

        if ($this->method == 'POST') {
            (new Create())->Create();
        }
        if ($this->method == 'GET') {
            (new Select())->Select();
        }
        if ($this->method == 'PUT') {
            (new UpdateAll())->UpdateAll();
        }
        if ($this->method == 'PATCH') {
            (new UpdatePatch())->UpdatePatch();
        }
        if ($this->method == 'DELETE') {
            (new Delete())->Delete();
        }

    }
}