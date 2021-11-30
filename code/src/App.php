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
            (new AddEvent())->AddEvent();
        }
        if ($url == '/del') {
            (new DelEvent())->Del();
        }
        if ($url == '/event') {
            (new GetEvent())->GetEvent();
        }
        if ($url == '/all_events') {
            (new GetAllEvent())->GetAllEvent();
        }
        if ($url == '/all_conditions') {
            (new GetAllConditions())->GetAllConditions();
        }
    }
}