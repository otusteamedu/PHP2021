<?php

    class Config {

        protected array     $data;
        protected string    $ini_file = "config.ini";

        public function __construct() {
            $this->data = parse_ini_file($this->ini_file);
		}

        public function get(string $key):string {
            if (isset($this->data[$key])) {
                return $this->data[$key];
            } else {
                throw new Exception('Ключ не существует');
            };
        }

        public function __destruct() {

        }

    }

?>