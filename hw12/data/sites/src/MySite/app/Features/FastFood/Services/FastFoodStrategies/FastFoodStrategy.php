<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodStrategies;


use MySite\app\Features\FastFood\Contracts\FastFoodFactoryContract;
use MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories\BurgerFactory;

/**
 * Class FastFoodStrategy
 * @package MySite\app\Features\FastFood\Services\FastFoodStrategies
 */
#[FastFoodFactoryContract()]
class FastFoodStrategy
{

    /**
     * FastFoodStrategy constructor.
     * @param FastFoodFactoryContract $factory
     */
    public function __construct(
        private FastFoodFactoryContract $factory
    ) {
    }

    public function complete()
    {
        if ($this->factory instanceof BurgerFactory) {
            $this
                ->factory
                ->cook()
                ->pack();
        } else {
            $this
                ->factory
                ->cook()
                ->pack()
                ->addSideDish();
        }
    }
}
