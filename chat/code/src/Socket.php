<?php

    class Socket {
        protected           $socket;
        protected string    $sock_bind;

        public function __construct() {
            
        }

        public function create(): void {
            $this->socket = socket_create(AF_UNIX, SOCK_DGRAM, 0);
            if ($this->socket === false) {
                throw new Exception("Невозможно создать сокет: ".socket_strerror(socket_last_error()));
            }
        }

        public function bind(string $sock_bind): void {
            $this->sock_bind = $sock_bind;
            if (socket_bind($this->socket, $this->sock_bind) === false) {
                throw new Exception("Невозможно привязать сокет {$this->sock_bind}: ".socket_strerror(socket_last_error()));
            }
        }

        public function read(): string {
            if (!socket_set_block($this->socket)) {
                throw new Exception("Невозможно установить блокирующий режим для сокета: ".socket_strerror(socket_last_error()));
            };

            $buffer  = "";
            $address = "";
            if (socket_recvfrom($this->socket, $buffer, 65536, 0, $address) === false) {
                throw new Exception("Невозможно принять данные: ".socket_strerror(socket_last_error()));
            };

            return $buffer;
        }

        public function write(string $message, string $sock_to): void {
            if (!socket_set_nonblock($this->socket)) {
                throw new Exception("Невозможно установить не блокирующий режим для сокета: ".socket_strerror(socket_last_error()));
            };

            if (socket_sendto($this->socket, $message, strlen($message), 0, $sock_to) === false) {
                throw new Exception("Невозможно отправить данные: ".socket_strerror(socket_last_error()));
            };
        }

        public function close(): void {
            socket_close($this->socket);

            if (file_exists($this->sock_bind)) {
                unlink($this->sock_bind);
            };
        }

        public function __destruct() {
            $this::close();
        }
    }

?>