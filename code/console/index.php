<?php

use App\Factory\BurgerFactory;
use App\Factory\Orders\CustomElementsBuilder;
use App\Factory\Orders\SimpleCheeseBuilder;
use App\Factory\Orders\SimpleOrder;
use App\Factory\HotdogFactory;
use App\Factory\ProductsStatus;
use App\Factory\SandwichFactory;

require_once __DIR__ . "/../bootstrap/app.php";

$observer = new ProductsStatus();

$burgerFactory = new BurgerFactory();
$hotdogFactory = new HotdogFactory();
$sandwichFactory = new SandwichFactory();

$burgerBuilder1 = new SimpleCheeseBuilder($burgerFactory, $observer);
$burgerBuilder2 = new CustomElementsBuilder($burgerFactory, $observer, ["новая булка", "фарш", "сырный соус", "маринованный огурец"]);
$hotdogBuilder = new SimpleCheeseBuilder($hotdogFactory, $observer);
$sandwichBuilder = new CustomElementsBuilder($sandwichFactory, $observer, ["черный хлеб", "острый соус", "салями", "пармезан", "салатный лист"]);


$order = new SimpleOrder("Заказ 123");
$order->addProduct($burgerBuilder1);
$order->addProduct($burgerBuilder2);
$order->addProduct($hotdogBuilder);
$order->addProduct($hotdogBuilder);
$order->addProduct($sandwichBuilder);
echo PHP_EOL;
$order->printOrder();
