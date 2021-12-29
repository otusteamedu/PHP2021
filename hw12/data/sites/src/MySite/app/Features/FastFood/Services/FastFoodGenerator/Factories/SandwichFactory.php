<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories;


use MySite\app\Support\Facades\Logger;

/**
 * Class SandwichFactory
 * @package MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories
 */
class SandwichFactory extends BaseFactory
{

    /**
     * @inheritDoc
     */
    public function pack(): static
    {
        Logger::notice('Упаковать в пластик');
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addSideDish(): static
    {
        Logger::notice('Добавить картофель фри');
        return $this;
    }
}
