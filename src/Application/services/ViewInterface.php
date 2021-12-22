<?php

namespace App\Application\Services;

interface ViewInterface
{

    /**
     * Рендер шаблона
     * @param $templateName
     * @param array $data
     * @return mixed
     */
    public function render($templateDir, $data = []);
}

