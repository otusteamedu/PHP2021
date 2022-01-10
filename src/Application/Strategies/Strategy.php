<?php


namespace App\Application\Strategies;


interface Strategy
{
    public function make(array $fillings);
}