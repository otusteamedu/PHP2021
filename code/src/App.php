<?php

namespace App;
use Adding\Adding;
use Statistics\Statistics;
use Display\Display;

class App
{

    public function run($argv) {

        new Adding($argv);

        $statistics = (new Statistics())->sortAllChannelsStatistics();

        (new Display())->outputResult($statistics);
    }
   
}

