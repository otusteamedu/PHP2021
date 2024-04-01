<?php

namespace Presentation;

class PageBuilder
{
    public function includeHead()
    {
        require_once 'parts/head.php';
    }

    public function includeMenu()
    {
        require_once 'parts/menu.php';
    }

    public function includeForm()
    {
        require_once 'parts/add_form.php';
    }

    public function includeScript()
    {
        require_once 'parts/script.php';
    }

    public function includeSuccess()
    {
        require_once 'parts/success.php';
    }

    public function includeSearch()
    {
        require_once 'parts/search.php';
    }

    public function includeShowAll()
    {
        require_once 'parts/show_all.php';
    }

    public function includeUpdate()
    {
        require_once 'parts/update.php';
    }

    public function includeDelete()
    {
        require_once 'parts/delete.php';
    }

    public function include404()
    {
        require_once 'parts/404.php';
    }
}
