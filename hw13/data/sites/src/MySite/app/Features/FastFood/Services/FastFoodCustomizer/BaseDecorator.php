<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodCustomizer;

use MySite\app\Features\FastFood\Contracts\CustomizerContract;
use MySite\app\Features\FastFood\Contracts\FastFoodFactoryContract;

/**
 * Class BaseDecorator
 * @package MySite\app\Features\FastFood\Services\FastFoodCustomizer
 */
#[CustomizerContract()]
abstract class  BaseDecorator implements CustomizerContract
{
    /**
     * BaseDecorator constructor.
     * @param CustomizerContract $customizer
     */
    public function __construct(
        protected CustomizerContract $customizer)
    {
    }

    /**
     * @inheritDoc
     */
    public function addTopping(FastFoodFactoryContract $factory): void
    {
        $this->customizer->addTopping($factory);
    }

    /**
     * @inheritDoc
     */
    public function removeTopping(FastFoodFactoryContract $factory): void
    {
        $this->customizer->removeTopping($factory);
    }
}
