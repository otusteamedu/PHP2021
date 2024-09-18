<?php

namespace App\Helpers;

class Locales
{
    private array $arLocales;
    public function __construct()
    {
        require_once "{$_SERVER['DOCUMENT_ROOT']}/app_src/Locales/{$GLOBALS['local']}/locales.php";

        $this->arLocales = $LOCALES;
    }

    public function getLocales($code) {
        return $this->arLocales[$code];
    }
}
