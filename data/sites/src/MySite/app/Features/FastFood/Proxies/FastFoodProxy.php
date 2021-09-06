<?php

declare(strict_types=1);

namespace MySite\app\Features\FastFood\Proxies;


use MySite\app\Features\FastFood\Contracts\FastFoodChangeStatusesContract;
use MySite\app\Support\Facades\Logger;

/**
 * Class FastFoodProxy
 * @package MySite\app\Features\FastFood\Proxies
 */
#[FastFoodChangeStatusesContract()]
class FastFoodProxy implements FastFoodChangeStatusesContract
{

    public function __construct(
        private FastFoodChangeStatusesContract $mainObject
    ) {
    }

    /**
     * @inheritDoc
     */
    public function isReadyForCooking(): void
    {
        // TODO: Можно проверить, есть ли все продукты на кухне
        $this->mainObject->isReadyForCooking();
    }

    /**
     * @inheritDoc
     */
    public function isCooking(): void
    {
        Logger::notice('began to cook');
        $this->mainObject->isCooking();
    }

    /**
     * @inheritDoc
     */
    public function isDone(): void
    {
        Logger::notice('finished to cook');
        $this->mainObject->isFailed();
    }

    /**
     * @inheritDoc
     */
    public function isFailed(): void
    {
        //TODO можно инициировать списания
        $this->mainObject->isFailed();
    }
}
