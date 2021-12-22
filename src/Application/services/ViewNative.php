<?php

namespace App\Application\Services;

class ViewNative implements ViewInterface
{

    /**
     * Рендер php шаблона
     * @param $template
     * @param array $data
     */
    public function render($template, $data = [])
    {
        extract($data);
        include __DIR__ . '\..\..\..\public_html\views\\' . $template . '.php';
    }
}