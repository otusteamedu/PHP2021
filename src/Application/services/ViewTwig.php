<?php

namespace App\Application\Services;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewTwig implements ViewInterface
{

    /**
     * Рендер twig шаблона
     * @param $templateDir
     * @param array $data
     * @return mixed|void
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render($templateDir, $data = [])
    {
        $parts = explode('/', $templateDir);
        $templateFolder = $parts[0];
        $templateName = $parts[1];
        $templatePath =  include __DIR__ . '\..\..\..\public_html\views\\' . $templateFolder;
        $template = $templateName . ".twig";
        $loader = new FilesystemLoader($templatePath);
        $this->twig = new Environment($loader);
        echo $this->twig->render($template, $data);
    }
}
