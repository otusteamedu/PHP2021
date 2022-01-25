<?php

namespace App\Http;

class Answer
{
    private array $message;

    public function Answer(array $result)
    {

        http_response_code($result['code']);
        
        if (array_key_exists('data', $result)) {
           
            $this->message = [
                "message" => $result['message'],
                "data" => $result['data']
            ];

        } else {

            $this->message = [
                "message" => $result['message'],
            ];

        }

        echo json_encode($this->message, JSON_UNESCAPED_UNICODE);

    }

}