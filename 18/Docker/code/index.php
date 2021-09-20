<?php

function createProduct(FactoryProduct $product){

    $product->createProduct();
}

createProduct(new FactoryBurger());
createProduct(new FactoryHotdog());

$select_food = new SelectFood();

/* реализация стратегии: в конструторе указываем абстрактный метод фабрики */
if (  isset($_POST['burger']) ) {
    $select_food->setFoodType(new BurgerFood(FactoryProduct));
    $food = $select_food->execute();

    $observer = new FoodObserver($food);
    $publisher = new FoodPublisher();

    $publisher->addObserver($observer);
    $publisher->sendReadyNotify();

}

//Decorator

$food = new Food();

$onion1 = new addCheese($food);

$chese = new CheeseInFood($onion1);

$salat = new SalatInFood($chese);




