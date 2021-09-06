<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories;


use MySite\app\Support\Facades\Logger;

/**
 * Class HotDogFactory
 * @package MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories
 */
class HotDogFactory extends BaseFactory
{

    /**
     * @inheritDoc
     */
    public function pack(): static
    {
        Logger::notice('Упаковать в крафт');
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addSideDish(): static
    {
        return $this;
    }
}
