<?php

class Factory
{
    private $finder;

    public function getGoogleFinder()
    {
        if (!$this->finder) {
            $this->finder = new GoogleFinder(
                $this->getGrabber(),
                $this->getFilter(),
            );
        }

        return $this->finder;
    }

    private function getGrabber()
    {
        return new Grabber();
    }

    private function getFilter()
    {
        return new HtmlExtractor();
    }
}