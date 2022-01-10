<?php


namespace App;


interface Strategy
{
    public function make(array $fillings);
}