<?php

class saladDecorator extends FoodComponents
{

    public function addComponent(BaseProduct $product):BaseProduct{

        $product->setTomato();

    }

}