<?php

namespace App;

use App\Strategy\FinishedProduct;

use App\Strategy\WhiteFactoryBurger;
use App\Strategy\WhiteFactorySandwich;

use App\Observer\Products;
use App\Observer\Observer;

class App
{
    public function run()
    {

        $context = new FinishedProduct(new WhiteFactoryBurger());
        $context = $context->execute(100);

        echo $context . "<br>";

        $status = new Products(1);
        $observer = new Observer();
        $status->attach($observer);
        $status->action();
        
        echo "<br>";
        echo "<br>";

        $context = new FinishedProduct(new WhiteFactorySandwich());
        $context = $context->execute(100);

        echo $context . "<br>";

        $status = new Products(2);
        $observer = new Observer();
        $status->attach($observer);
        $status->action();

    }
}