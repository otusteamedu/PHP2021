<?php

namespace App;
use AddEvent\AddEvent;
use DelEvent\DelEvent;
use GetEvent\GetEvent;
use GetAllEvent\GetAllEvent;
use GetAllConditions\GetAllConditions;

class App
{
    public function run()
    {
        $url = $_SERVER['REQUEST_URI'];
        if ($url == '/add') {
            new AddEvent();
        }
        if ($url == '/del') {
            new DelEvent();
        }
        if ($url == '/event') {
            new GetEvent();
        }
        if ($url == '/all_events') {
            new GetAllEvent();
        }
        if ($url == '/all_conditions') {
            new GetAllConditions();
        }
    }
}