<?php

class addSalad extends FoodComponents
{

    public function addComponent(BaseProduct $product):BaseProduct{

        $product->setTomato();

    }

}