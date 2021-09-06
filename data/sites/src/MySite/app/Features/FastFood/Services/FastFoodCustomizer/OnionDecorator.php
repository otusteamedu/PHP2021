<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodCustomizer;


use MySite\app\Features\FastFood\Contracts\FastFoodFactoryContract;

/**
 * Class OnionDecorator
 * @package MySite\app\Features\FastFood\Services\FastFoodCustomizer
 */
class OnionDecorator extends BaseDecorator
{
    public const NAME = 'Лук';

    /**
     * @inheritDoc
     */
    public function addTopping(FastFoodFactoryContract $factory): void
    {
        parent::addTopping($factory);
        $factory->addTopping(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function removeTopping(FastFoodFactoryContract $factory): void
    {
        // TODO: Implement removeTopping() method.
    }
}
