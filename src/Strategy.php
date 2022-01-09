<?php


namespace App;


interface Strategy
{
    public function make(int $pepper, int $salt);
}