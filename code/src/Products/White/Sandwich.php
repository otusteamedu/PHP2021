<?php 

namespace App\Products\White;

use App\Strategy\FinishedProduct;
use App\Strategy\WhiteFactorySandwich;
use App\Observer\Products;
use App\Observer\Observer;

class Sandwich
{
    private $whiteSandwich;
    private $statusWhiteSandwich;
    private $observerWhiteSandwich;

    public function Sandwich()
    {
        $this->whiteSandwich = new FinishedProduct(new WhiteFactorySandwich());
        $this->whiteSandwich = $this->whiteSandwich->execute(100);

        echo $this->whiteSandwich . "<br>";

        $this->statusWhiteSandwich = new Products(2);
        $this->observerWhiteSandwich = new Observer();
        $this->statusWhiteSandwich->attach($this->observerWhiteSandwich);
        $this->statusWhiteSandwich->action();
    }
}