<?php

class GoogleFinder
{
    private $grabber;
    private $filter;

    public function __construct()
    {
        $this->grabber = new Grabber();
        $this->filter = new HtmlExtractor();
    }

    public function find($searchString)
    {
        // return array of founded results;
    }
}