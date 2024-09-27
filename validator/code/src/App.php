<?php

    Class App {

        protected Config    $obj_config;
        protected Answer   $obj_answer;

        public function __construct() {
            $this->obj_config  = new Config();
            $this->obj_answer = new Answer();
		}

        public function run():void {
            $param = $this->obj_config->get("post_param");

            if (isset($_POST[$param])) {
                $string = $_POST[$param];
            } else {
                $string = "";
            };
            
            if (!empty($string)) {
                $count_bracket = 0;
                $checksumm     = 0;

                for ($i=0; $i < strlen($string); $i++) {
                    switch ($string[$i]) {
                        case '(':
                            $checksumm++;
                            $count_bracket++;
                            break;
                        case ')':
                            $checksumm--;
                            $count_bracket++;
                            break;
                    };

                    // )(
                    if ($count_bracket == 1 && $checksumm == -1) {
                        break;
                    };
                };
            } else {
                $checksumm = -1;
            };

            if ($checksumm == 0 && $count_bracket != 0) {
                $this->obj_answer->page_200();
            } else {
                $this->obj_answer->page_400();
            };
        }

        public function __destruct() {

        }
    }

?>