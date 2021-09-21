<?php

class FoodComponents
{
    /**
     * @var Food
     */
    protected $food;

    public function __construct(Food $food)
    {
        $this->food = $food;
    }

    /**
     * Декоратор делегирует всю работу обёрнутому компоненту.
     */
    public function addComponent(BaseProduct $product): BaseProduct
    {
        return $this->food->addComponent($product);
    }

}
