<?php


namespace Chat\Sockets\Templates;


abstract class SocketImplementation implements Runnable
{

    protected function readline(): string
    {
        return rtrim(fgets(STDIN));
    }

}