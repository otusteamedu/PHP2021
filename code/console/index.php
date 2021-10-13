<?php

use App\Factory\BurgerFactory;
use App\Factory\Orders\CustomElementsBuilder;
use App\Factory\Orders\SimpleBuilder;
use App\Factory\Orders\SimpleOrder;
use App\Factory\HotdogFactory;
use App\Factory\ProductsStatus;
use App\Factory\SandwichFactory;

require_once __DIR__ . "/../bootstrap/app.php";

$observer = new ProductsStatus();

$burgerFactory = new BurgerFactory();
$hotdogFactory = new HotdogFactory();
$sandwichFactory = new SandwichFactory();

$burgerBuilder = new SimpleBuilder($burgerFactory, $observer);
$hotdogBuilder = new CustomElementsBuilder($hotdogFactory, $observer);
$sandwichBuilder = new CustomElementsBuilder($sandwichFactory, $observer);


$order = new SimpleOrder("Заказ 123");
$order->addProduct($burgerBuilder);
$order->addProduct($hotdogBuilder);
$order->addProduct($hotdogBuilder);
$order->addProduct($hotdogBuilder);
$order->addProduct($sandwichBuilder);
echo PHP_EOL;
$order->printOrder();
