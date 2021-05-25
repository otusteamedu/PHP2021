<?php

    class Answer {

        protected Config    $obj_config;
        
        public function __construct() {
            $this->obj_config  = new Config();
        }

        public function page_200():void {
            http_response_code(200);
            readfile($this->obj_config->get("page_200"));
        }

        public function page_400():void {
            http_response_code(400);
            readfile($this->obj_config->get("page_400"));
        }

        public function __destruct() {

        }
    }

?>