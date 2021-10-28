<?php

class GoogleFinder
{
    private $grabber;
    private $filter;

    public function __construct(
        Grabber $grabber,
        HtmlExtractor $filter
    )
    {
        $this->grabber = $grabber;
        $this->filter = $filter;
    }

    public function find($searchString)
    {
        // return array of founded results;
    }
}