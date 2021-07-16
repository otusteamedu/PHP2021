<?php

namespace App\Http;

class View
{

    protected static $attributes = [];

    static function view(string $view, array $data = [])
    {
        $viewContent = self::render(VIEWS_PATH . $view, $data);
        $data['content'] = $viewContent;
        echo self::render(LAYOUTS_PATH . 'index', $data);
    }

    private static function render(string $template, $data = [])
    {
        $data = array_merge(self::$attributes, $data);
        ob_start();
        self::protectedIncludeScope($template, $data);
        return ob_get_clean();
    }

    protected static function protectedIncludeScope(string $template, array $data): void
    {
        extract($data);
        include "$template.php";
    }
}