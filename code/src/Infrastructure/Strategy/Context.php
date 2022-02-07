<?php
declare(strict_types=1);

namespace App\Infrastructure\Strategy;


use App\Infrastructure\AbstractFactory\BurgerFactory;
use App\Infrastructure\AbstractFactory\HotDogFactory;
use App\Infrastructure\AbstractFactory\IAbstractFactory;
use App\Infrastructure\AbstractFactory\SandwichFactory;
use Exception;


class Context
{
    private AbstractStrategy $strategy;

    protected IAbstractFactory $factory;

    private string $baseProduct;
    private array $arrayIngredients;

    public function __construct(string $baseProduct, array $arrayIngredients)
    {
        $this->baseProduct = $baseProduct;
        $this->arrayIngredients = $arrayIngredients;
    }

    public function setStrategy(AbstractStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function doSomeBusinessLogic():void
    {
        /* Abstract Factory pattern
         *
         * Choose factory and buildProduct
         *
         */
        switch ($this->baseProduct){
            case 'burger':
                $this->factory = new BurgerFactory();
                break;
            case 'hot dog':
                $this->factory = new HotDogFactory();
                break;
            case 'sandwich':
                $this->factory = new SandwichFactory();
                break;
            default:
                throw new Exception("Указан неверный базовый продукт\n");
        }

        $this->strategy->buildProduct($this->arrayIngredients, $this->factory);
    }
}