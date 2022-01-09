<?php
namespace App;


class App
{
    private ProductFactoryInterface $productFactory;
    private Strategy $productStrategy;

    public function initialize()
    {
        $productType = strtolower($_GET['product']);
        global $container;
        switch ($productType) {
            case 'burger':
                $this->productStrategy = $container->make(BurgerStrategy::class);
                break;
            case 'hotdog':
                $this->productStrategy = $container->make(HotDogStrategy::class);
                break;
            case 'sandwich':
                $this->productStrategy = $container->make(SandwichStrategy::class);
                break;
            default:
                throw new \Exception('this type does not exists');
        }
        $this->productStrategy->make(new RecieptIterator($_GET['fillings']));
    }

    public function setStrategy(Strategy $strategy)
    {
        $this->productStrategy = $strategy;
    }
}