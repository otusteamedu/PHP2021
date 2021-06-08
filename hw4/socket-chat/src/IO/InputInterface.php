<?php


namespace App\IO;


interface InputInterface
{
    /**
     * @throws IOException
     */
    public function read(): string;
}
