<?php
declare(strict_types=1);

namespace App\http;
class httpResponse
{
    protected int $status = 0;
    protected array $headers  = [];

    public function __construct( $status , $headers )
    {

        $this->status = $status;
        $this->headers = $headers;

    }



    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setHeaders(array $headers){

        $this->headers = $headers;
        return $this;


    }


    public function getHeaders():array {
        return $this->headers;

    }

}
