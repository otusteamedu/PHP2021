<?php


namespace App\Http\Interfaces;


interface EmitterInterface
{
    public function emit(ResponseInterface $response);
}
