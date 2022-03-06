<?php

namespace App\Factory;

use App\Food\Burger;
use App\Food\FoodInterface;
use App\Food\Hotdog;
use App\Food\Sandwich;
use Exception;

class FoodFactory implements FoodFactoryInterface
{
    private FoodInterface $food;

    public function __construct(FoodInterface $food)
    {
        $this->food = $food;
    }

    /**
     * @throws Exception
     */
    public static function get(string $foodType): self
    {
        switch ($foodType) {
            case FoodFactoryInterface::BURGER:
                return new self(new Burger());
            case FoodFactoryInterface::HOTDOG:
                return new self(new Hotdog());
            case FoodFactoryInterface::SANDWICH:
                return new self(new Sandwich());
            default:
                throw new Exception('unknown food type');
        }
    }

    public function makeFood(): FoodInterface
    {
        return clone $this->food;
    }
}
