<?php


namespace App\IO;


interface OutputInterface
{
    /**
     * @throws IOException
     */
    public function write(string $data): int;
}
