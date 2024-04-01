<?php

namespace Presentation;

class ResultHandler
{
    private PageDirector $pageDirector;

    public function __construct()
    {
        $pageBuilder = new PageBuilder();
        $this->pageDirector = new PageDirector($pageBuilder);
    }

    public function runSuccess(string $title)
    {
        $GLOBALS['TITLE'] = $title;
        $GLOBALS['H1'] = $title;

        $this->pageDirector->getSuccessPage();
    }

    public function runSearch($searchResult)
    {
        $GLOBALS['TITLE'] = 'Результаты поиска';
        $GLOBALS['SEARCHED_HERO'] = $searchResult;

        $this->pageDirector->getSearchPage();
    }
}
