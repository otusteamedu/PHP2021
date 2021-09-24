<?php


namespace HW9\Controllers;

use HW9\Search\Search;
use HW9\Search\Settings\EnvAppSettings as SearchAppSettings;
use HW9\YouTube\Settings\EnvAppSettings as YoutubeAppSettings;
use HW9\YouTube\YouTube;

class BaseController
{
    protected $youtube = null;
    protected $search = null;

    protected function initYoutube() : void
    {
        $this->youtube = new YouTube();
        $this->youtube->initService(new YoutubeAppSettings());
    }

    protected function initSearch() : void
    {
        $this->search = new Search();
        $this->search->initClient(new SearchAppSettings());
    }
}
