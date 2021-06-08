<?php


namespace App\IO;


class Console implements InputInterface, OutputInterface
{
    /**
     * @throws IOException
     */
    public function read(): string
    {
        $data = fgets(STDIN);

        if ($data === false) {
            throw new IOException('Cannot read from stdin');
        }

        return $data;
    }

    /**
     * @throws IOException
     */
    public function write(string $data): int
    {
        $nByte = fwrite(STDOUT, $data);

        if ($nByte === false) {
            throw new IOException('Cannot write to stdout');
        }

        return $nByte;
    }
}
