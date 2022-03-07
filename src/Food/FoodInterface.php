<?php

namespace App\Food;

use App\Decorator\IngredientMixerInterface;

interface FoodInterface extends IngredientMixerInterface
{
    public const STATUS_FAIL = -1;
    public const STATUS_RAW = 0;
    public const STATUS_DONE = 1;

    public function cook(): void;

    public function getStatus(): int;
}
