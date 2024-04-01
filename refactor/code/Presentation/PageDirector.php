<?php

namespace Presentation;

use Infrastructure\DBConnection;
use Infrastructure\DBAdapter;

class PageDirector
{
    private RequestHandler $requestHandler;

    public function __construct(private $pageBuilder)
    {
        $GLOBALS['ROOT'] = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        $dbConnections = new DBConnection();
        $DbAdapter = new DBAdapter($dbConnections);
        $this->requestHandler = new RequestHandler($DbAdapter);
    }

    public function getMainPage()
    {
        $GLOBALS['TITLE'] = 'Super Hero Storage';
        $this->pageBuilder->includeHead();
        $this->pageBuilder->includeMenu();
        $this->pageBuilder->includeForm();
        $this->pageBuilder->includeScript();
    }

    public function getSuccessPage()
    {
        $this->pageBuilder->includeHead();
        $this->pageBuilder->includeSuccess();
        $this->pageBuilder->includeScript();
    }

    public function getSearchPage()
    {
        $this->pageBuilder->includeHead();
        $this->pageBuilder->includeSearch();
        $this->pageBuilder->includeScript();
    }

    public function getShowAllPage()
    {
        $GLOBALS['TITLE'] = 'Все супергерои в базе';
        $GLOBALS['HEROES'] = $this->requestHandler->getAll();

        $this->pageBuilder->includeHead();
        $this->pageBuilder->includeShowAll();
        $this->pageBuilder->includeScript();
    }

    public function getUpdatePage()
    {
        $GLOBALS['TITLE'] = 'Обновить';
        $GLOBALS['HEROES'] = $this->requestHandler->getAll();

        $this->pageBuilder->includeHead();
        $this->pageBuilder->includeUpdate();
        $this->pageBuilder->includeScript();
    }

    public function getDeletePage()
    {
        $GLOBALS['TITLE'] = 'Удалить';
        $GLOBALS['HEROES'] = $this->requestHandler->getAll();

        $this->pageBuilder->includeHead();
        $this->pageBuilder->includeDelete();
        $this->pageBuilder->includeScript();
    }

    public function get404page()
    {
        $GLOBALS['TITLE'] = 'Страница не найдена';

        $this->pageBuilder->includeHead();
        $this->pageBuilder->include404();
        $this->pageBuilder->includeScript();
    }
}
