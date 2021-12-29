<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories;


use MySite\app\Support\Facades\Logger;

/**
 * Class BurgerFactory
 * @package MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories
 */
class BurgerFactory extends BaseFactory
{
    /**
     * @inheritDoc
     */
    public function pack(): static
    {
        Logger::notice('Упаковать в картон');
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addSideDish(): static
    {
        Logger::notice('Добавить картофель по-перевенски');
        return $this;
    }
}
