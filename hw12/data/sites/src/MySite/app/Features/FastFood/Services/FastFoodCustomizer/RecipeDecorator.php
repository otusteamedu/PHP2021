<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodCustomizer;

use MySite\app\Features\FastFood\Contracts\CustomizerContract;
use MySite\app\Features\FastFood\Contracts\FastFoodFactoryContract;

/**
 * Class RecipeDecorator
 * @package MySite\app\Features\FastFood\Services\FastFoodCustomizer
 */
#[FastFoodFactoryContract()]
class RecipeDecorator implements CustomizerContract
{

    /**
     * BaseDecorator constructor.
     * @param FastFoodFactoryContract $factory
     */
    public function __construct(
        private FastFoodFactoryContract $factory
    ) {
    }

    /**
     * @param FastFoodFactoryContract $factory
     */
    public function addTopping(FastFoodFactoryContract $factory): void
    {
        $this->factory->addBaseToppings();
    }

    /**
     * @param FastFoodFactoryContract $factory
     */
    public function removeTopping(FastFoodFactoryContract $factory): void
    {
        $this->factory->removeBaseToppings();
    }
}
