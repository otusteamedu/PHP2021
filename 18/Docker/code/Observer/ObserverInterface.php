<?php

interface ObserverInterface
{
    public function handle(Observable $object);

}