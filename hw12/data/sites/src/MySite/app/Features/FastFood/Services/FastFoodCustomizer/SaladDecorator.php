<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodCustomizer;


use MySite\app\Features\FastFood\Contracts\FastFoodFactoryContract;

/**
 * Class SaladDecorator
 * @package MySite\app\Features\FastFood\Services\FastFoodCustomizer
 */
class SaladDecorator extends BaseDecorator
{
    public const NAME = 'Салат';

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
        parent::removeTopping($factory);
        $factory->removeTopping(self::NAME);
    }
}
