<?php


namespace App\Socket;


interface SocketInterface
{
    /**
     * @throws SocketException
     */
    public function bind(string $addr);

    /**
     * @throws SocketException
     */
    public function connect(string $addr);

    /**
     * @throws SocketException
     */
    public function listen();

    /**
     * @throws SocketException
     */
    public function accept(): Socket;

    /**
     * @throws SocketException
     */
    public function read(): string;

    /**
     * @throws SocketException
     */
    public function write(string $data): int;

    public function close();
}
