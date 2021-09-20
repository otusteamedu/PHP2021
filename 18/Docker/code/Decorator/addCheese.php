<?php

class addCheese extends FoodComponents
{

    public function addComponent(BaseProduct $product):BaseProduct{
        parent::addComponent($product->setCheese());
    }

}