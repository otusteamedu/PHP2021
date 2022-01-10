<?php


namespace App\Application\Strategies;


use App\Domain\Models\BaseProduct;

interface Strategy
{
    public function make(array $fillings) : BaseProduct;
}