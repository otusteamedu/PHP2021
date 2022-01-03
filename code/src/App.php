<?php

namespace App;

use App\Strategy\FinishedProduct;

use App\Strategy\WhiteFactoryBurger;
use App\Strategy\WhiteFactorySandwich;

use App\Observer\Products;
use App\Observer\Observer;

class App
{

    private $whiteBurger;
    private $statusWhiteBurger;
    private $observerWhiteBurger;

    private $whiteSandwich;
    private $statusWhiteSandwich;
    private $observerWhiteSandwich;

    public function run()
    {

        $this->whiteBurger = new FinishedProduct(new WhiteFactoryBurger());
        $this->whiteBurger = $this->whiteBurger->execute(100);

        echo $this->whiteBurger . "<br>";

        $this->statusWhiteBurger = new Products(1);
        $this->observerWhiteBurger = new Observer();
        $this->statusWhiteBurger->attach($this->observerWhiteBurger);
        $this->statusWhiteBurger->action();
        
        echo "<br>";
        echo "<br>";

        $this->whiteSandwich = new FinishedProduct(new WhiteFactorySandwich());
        $this->whiteSandwich = $this->whiteSandwich->execute(100);

        echo $this->whiteSandwich . "<br>";

        $this->statusWhiteSandwich = new Products(2);
        $this->observerWhiteSandwich = new Observer();
        $this->statusWhiteSandwich->attach($this->observerWhiteSandwich);
        $this->statusWhiteSandwich->action();

    }
}