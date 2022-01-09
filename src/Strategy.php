<?php


namespace App;


interface Strategy
{
    public function make(RecieptIterator $fillings);
}