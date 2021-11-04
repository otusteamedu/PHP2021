<?php
namespace Src\Request;

use Src\Validators\RequestValidator;

class Request
{
    public $post;
    public $get;

    public function __construct() {
        $this->post = $this->cleanInput($_POST);
        $this->get = $this->cleanInput($_GET);
        return $this;
    }

    private function cleanInput($data) {
        if (is_array($data)) {
            $cleaned = [];
            foreach ($data as $key => $value) {
                $cleaned[$key] = $this->cleanInput($value);
            }
            return $cleaned;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }

    public function get()
    {
        return new RequestValidator($this, 'get');
    }

    public function post()
    {
        return new RequestValidator($this, 'post');
    }
}