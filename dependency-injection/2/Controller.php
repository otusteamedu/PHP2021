<?php

class Controller
{
    public function action()
    {
        $finder = new GoogleFinder(
            new Grabber(),
            new HtmlExtractor()
        );

        $result = $finder->find('search str');
    }
}
