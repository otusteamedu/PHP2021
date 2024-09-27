<?php

    Class App {

        protected Config    $obj_config;
        protected Socket   $obj_socket;

        public function __construct() {
            $this->obj_config  = new Config();
            $this->obj_socket = new Socket();
		}

        public function run():void {
            if (isset($_SERVER['argv'][1])) {
                $side = $_SERVER['argv'][1];
            } else {
                $side = "";
            };

            $this->obj_socket->create();
            $exit = false;

            switch ($side) {
                case 'client':
                    $this->obj_socket->bind($this->obj_config->get("client"));

                    while (!$exit) {
                        echo "Cообщение: ";
                        $message = rtrim(fgets(STDIN)); 
                        
                        $this->obj_socket->write($message, $this->obj_config->get("server"));
                        
                        if ($message == "exit") {
                            $exit = true;
                        } else {
                            echo "Ожидание...\r\n";
                            $message = $this->obj_socket->read();
                            echo "Ответ: $message\r\n";
                        };
                    };
                    break;
                case 'server':
                    $this->obj_socket->bind($this->obj_config->get("server"));

                    while (!$exit) {
                        echo "Ожидание...\r\n";
                        $message = $this->obj_socket->read();
                        echo "Cообщение: $message\r\n";

                        if ($message == "exit") {
                            $exit = true;
                        } else {
                            echo "Ответ: ";
                            $message = rtrim(fgets(STDIN));

                            $this->obj_socket->write($message, $this->obj_config->get("client"));
                        };
                    };
                    break;
                default:
                    throw new Exception("Не указан параметр client/server");
                    break;
            };
        }

        public function __destruct() {
            
        }
    }

?>