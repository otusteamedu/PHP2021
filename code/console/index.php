<?php

use App\Factory\BurgerFactory;
use App\Factory\Combos\CustomElementsBuilder;
use App\Factory\Combos\SimpleBuilder;
use App\Factory\Combos\FourBurgersCombo;
use App\Factory\Combos\SimpleOrder;
use App\Factory\Combos\ThreeHotdogsCombo;
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
