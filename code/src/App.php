<?php

namespace App;
use App\Add\AddEvent;
use App\Del\DelEvent;
use App\Get\GetEvent;
use App\Get\GetAllEvent;
use App\Get\GetAllConditions;

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