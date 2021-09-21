<?php

class cheeseDecorator extends FoodComponents
{

    public function addComponent(BaseProduct $product):BaseProduct{
        parent::addComponent($product->setCheese());
    }

}