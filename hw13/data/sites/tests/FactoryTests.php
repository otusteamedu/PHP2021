<?php

declare(strict_types=1);

namespace Tests;

use MySite\app\Features\FastFood\Contracts\FastFoodConstants;
use MySite\app\Features\FastFood\Observers\TerminalObserver;
use MySite\app\Features\FastFood\Proxies\FastFoodProxy;
use MySite\app\Features\FastFood\Services\FastFoodCustomizer\OnionDecorator;
use MySite\app\Features\FastFood\Services\FastFoodCustomizer\PepperDecorator;
use MySite\app\Features\FastFood\Services\FastFoodCustomizer\RecipeDecorator;
use MySite\app\Features\FastFood\Services\FastFoodCustomizer\SaladDecorator;
use MySite\app\Features\FastFood\Services\FastFoodGenerator\FastFoodFactory;

/**
 * ./vendor/bin/phpunit --testdox ./tests/FactoryTests.php
 *
 * Class EventTest
 * @package Tests
 */
class FactoryTests extends BaseTest
{

    public function testAddToppingsBurger()
    {
        $factory = new FastFoodFactory();
        $burger = $factory->generate(FastFoodConstants::BURGER);

        $recipeDecorator = new RecipeDecorator($burger);

        $onionDecorator = new OnionDecorator($recipeDecorator);
        $pepperDecorator = new PepperDecorator($onionDecorator);
        $pepperDecorator->addTopping($burger);

        $saladDecorator = new SaladDecorator($pepperDecorator);
        $saladDecorator->removeTopping($burger);

        $countToppings = count($burger->getToppings()->getItems());

        $this->assertEquals(8, $countToppings);
    }


    public function testChangeStatus()
    {
        $observer = new TerminalObserver();

        $factory = new FastFoodFactory();
        $burger = $factory->generate(FastFoodConstants::BURGER);

        $burger->attach($observer);

        $burgerProxy = new FastFoodProxy($burger);

        $burgerProxy->isReadyForCooking();
        $burgerProxy->isCooking();
        $burgerProxy->isDone();

        $countEvents = count($observer->getLog());
        $this->assertEquals(3, $countEvents);
    }

}
