<?php

class Samedata {
    protected $server;
    protected $stop_word;
    public function __construct() {
        $t=new Config;
        $this->server=$t->getPortConfig();
        $this->stop_word=$t->getStopword();
        
    }
    
}