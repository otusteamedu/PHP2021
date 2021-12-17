<?php


namespace App\Contractor;


interface SocketContractor
{
    public function initializeSocket();
    public function closeConnectionAndSocket();
}