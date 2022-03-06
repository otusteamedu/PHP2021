<?php

namespace App\Factory;

use App\Food\FoodInterface;

interface FoodFactoryInterface
{
    public const BURGER = 'burger';
    public const HOTDOG = 'hotdog';
    public const SANDWICH = 'sandwich';

    public function makeFood(): FoodInterface;
}
