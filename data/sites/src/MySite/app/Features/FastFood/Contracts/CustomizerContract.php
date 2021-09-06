<?php


namespace MySite\app\Features\FastFood\Contracts;

use Attribute;

/**
 * Interface CustomizerContract
 * @package MySite\app\Features\FastFood\Contracts
 */
#[Attribute]
interface CustomizerContract
{

    /**
     * @param FastFoodFactoryContract $factory
     */
    public function addTopping(FastFoodFactoryContract $factory): void;


    /**
     * @param FastFoodFactoryContract $factory
     */
    public function removeTopping(FastFoodFactoryContract $factory): void;
}
