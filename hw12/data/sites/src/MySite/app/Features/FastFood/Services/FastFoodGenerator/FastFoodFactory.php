<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Services\FastFoodGenerator;

use JetBrains\PhpStorm\Pure;
use MySite\app\Features\FastFood\Contracts\FastFoodChangeStatusesContract;
use MySite\app\Features\FastFood\Contracts\FastFoodConstants;
use MySite\app\Features\FastFood\Contracts\FastFoodFactoryContract;
use MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories\BurgerFactory;
use MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories\HotDogFactory;
use MySite\app\Features\FastFood\Services\FastFoodGenerator\Factories\SandwichFactory;
use SplSubject;

/**
 * Class FastFoodFactory
 * @package MySite\app\Features\FastFood\Services\FastFoodGenerator
 */
class FastFoodFactory
{

    /**
     * @param int $fastFoodId
     * @return FastFoodFactoryContract|FastFoodChangeStatusesContract|SplSubject
     */
    #[Pure] public function generate(int $fastFoodId): FastFoodFactoryContract|FastFoodChangeStatusesContract|SplSubject
    {
        return match ($fastFoodId) {
            FastFoodConstants::BURGER => new BurgerFactory(),
            FastFoodConstants::SANDWICH => new SandwichFactory(),
            FastFoodConstants::HOT_DOG => new HotDogFactory()
        };
    }
}
