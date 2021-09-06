<?php

declare(strict_types=1);

namespace MySite\app\Controllers;

use MySite\app\Features\FastFood\Contracts\FastFoodConstants;
use MySite\app\Features\FastFood\Observers\TerminalObserver;
use MySite\app\Features\FastFood\Proxies\FastFoodProxy;
use MySite\app\Features\FastFood\Services\FastFoodCustomizer\OnionDecorator;
use MySite\app\Features\FastFood\Services\FastFoodCustomizer\PepperDecorator;
use MySite\app\Features\FastFood\Services\FastFoodCustomizer\RecipeDecorator;
use MySite\app\Features\FastFood\Services\FastFoodCustomizer\SaladDecorator;
use MySite\app\Features\FastFood\Services\FastFoodGenerator\FastFoodFactory;
use MySite\app\Features\FastFood\Services\FastFoodStrategies\FastFoodStrategy;
use MySite\app\Responses\ProductResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Class IndexController
 * @package MySite\app\Controllers
 */
class IndexController extends BaseController
{
    /**
     * @return ResponseInterface
     */
    public function burgerExample(): ResponseInterface
    {
        $factory = new FastFoodFactory();
        $observer = new TerminalObserver();

        $burger = $factory->generate(FastFoodConstants::BURGER);

        $strategy = new FastFoodStrategy($burger);

        $recipeDecorator = new RecipeDecorator($burger);

        $onionDecorator = new OnionDecorator($recipeDecorator);
        $pepperDecorator = new PepperDecorator($onionDecorator);
        $pepperDecorator->addTopping($burger);

        $saladDecorator = new SaladDecorator($pepperDecorator);
        $saladDecorator->removeTopping($burger);

        $burger->attach($observer);

        $burgerProxy = new FastFoodProxy($burger);

        $burgerProxy->isReadyForCooking();

        $strategy->complete();

        return (new ProductResponse())->getResponse($burger);
    }
}
