<?php


namespace MySite\app\Features\FastFood\Contracts;

use Attribute;

/**
 * Interface FastFoodChangeStatusesContract
 * @package MySite\app\Features\FastFood\Contracts
 */
#[Attribute]
interface FastFoodChangeStatusesContract
{
    /**
     * @return void
     */
    public function isReadyForCooking(): void;

    /**
     * @return void
     */
    public function isCooking(): void;

    /**
     * @return void
     */
    public function isDone(): void;

    /**
     * @return void
     */
    public function isFailed(): void;
}
