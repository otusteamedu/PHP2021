<?php

namespace Src\service;

interface ResponseInterface
{
    public function OkResponse($message);
    public function BadResponse($message);
    public function NotFoundResponse();
}