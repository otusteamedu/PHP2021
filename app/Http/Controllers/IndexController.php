<?php

namespace App\Http\Controllers;


use App\Service\AbstractFactory\AbstractFactoryInterface;
use App\Service\AbstractFactory\AbstractFoodFactory;
use App\Service\Decorator\KetchupTopping;
use App\Service\Decorator\MustardTopping;
use App\Service\Decorator\OnionTopping;
use App\Service\Decorator\PepperTopping;
use App\Service\Decorator\SaladTopping;
use App\Service\Observer\FoodObserver;
use App\Service\Observer\FoodObserverInterface;
use App\Service\Observer\Observer;
use App\Service\Observer\ObserverInterface;
use App\Service\Proxy\SandwichProxy;
use App\Service\Strategy\BreakfastStrategy;
use App\Service\Strategy\DinnerStrategy;
use App\Service\Strategy\Food;

class IndexController extends Controller
{
    public $factory;
    public $foodObserver;

    public function __construct(AbstractFactoryInterface $factory,
                                ObserverInterface        $observer,
                                FoodObserverInterface    $foodObserver)
    {
        $this->factory = $factory;
        $this->foodObserver = $foodObserver;
        $this->foodObserver->attach($observer);

    }


    public function index()
    {
        $productA = $this->factory->createBurger();
        $productB = $this->factory->createHotDog();
        $productC = $this->factory->createSandwich();

        $this->foodObserver->state = 'start';
        $this->foodObserver->notify();
        echo $productA->getTopping() . "<br>";

        $decoratorA = new KetchupTopping($productA);
        $decoratorA2 = new OnionTopping($decoratorA);
        $decoratorA3 = new PepperTopping($decoratorA2);
        echo $decoratorA3->getTopping() . "<br>";

        $this->foodObserver->state = 'end';
        $this->foodObserver->notify();

        $decoratorB = new MustardTopping($productA);

        echo $decoratorB->getTopping() . "<br>";

        echo 'Sandwich ' . $productC->getTempirature() . "<br>";
        $proxyProductC = new SandwichProxy($productC);
        echo 'Sandwich proxy ' . $proxyProductC->getTempirature() . "<br>";


        $breakfast = new Food(new BreakfastStrategy());
        $breakfast = $breakfast->execute();
        echo $breakfast->getTopping() . "<br>";

        $dinner = new Food(new DinnerStrategy());
        echo $dinner->execute()->getTopping() . "<br>";

    }

}
