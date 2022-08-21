<?php

namespace App\Infrastructure\Controllers;

class ResultController
{
    public function actionIndex(): void
    {
        require_once($_SERVER['DOCUMENT_ROOT']."/src/Infrastructure/Views/result.php");
    }
}