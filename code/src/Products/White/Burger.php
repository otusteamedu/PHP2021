<?php 

namespace App\Products\White;

use App\Strategy\FinishedProduct;
use App\Strategy\WhiteFactoryBurger;
use App\Observer\Products;
use App\Observer\Observer;

class Burger
{
    private $whiteBurger;
    private $statusWhiteBurger;
    private $observerWhiteBurger;

    public function Burger()
    {
        $this->whiteBurger = new FinishedProduct(new WhiteFactoryBurger());
        $this->whiteBurger = $this->whiteBurger->execute(100);

        echo $this->whiteBurger . "<br>";

        $this->statusWhiteBurger = new Products(1);
        $this->observerWhiteBurger = new Observer();
        $this->statusWhiteBurger->attach($this->observerWhiteBurger);
        $this->statusWhiteBurger->action();
    }
}