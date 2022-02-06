<?php

namespace code\Models;


Class Validation extends \code\Components\HeaderComponent {

    protected $string_param = false;

    public function __construct($data, $field="String") {
        if (!empty($data[$field])) {
            $this->string_param = $data[$field];
        }
    }

    public function validate() {
        if (!empty($this->string_param)) {
            $left = 0;
            foreach (str_split($this->string_param)as $symbol) {
                if ($symbol == ")") {
                    $left -= 1;
                } else
                if ($symbol == "(") {
                    $left += 1;
                }
                if ($left < 0) {
                    break;
                }
            }
            if ($left == 0) {
                $this->sendheader('HTTP/1.1 200 Ok', $this->string_param);
            }
        }
        $this->sendheader('HTTP/1.1 400 Bad request', $this->string_param);
    }

}
