<?php

namespace App\Validators;

use App\Services\ResponseService;

class BracketValidator
{
    protected $request;
    protected ResponseService $response;
    protected string $string;

    protected const VALID_BRACKETS = [
        '(',
        ')'
    ];

    /**
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->response = new ResponseService();
    }

    public function run()
    {
        if (isset($this->request['String'])) {
            $this->string = $this->request['String'];
            return $this->validate();
        }

        return $this->response->setBadRequestHeader();
    }

    private function validate()
    {
        if ($this->checkCount() && $this->checkBrackets()) {
            return $this->response->setSuccessHeader();
        }

        return $this->response->setBadRequestHeader();
    }

    public function checkCount(): bool
    {
        return (substr_count($this->string, '(') === substr_count($this->string, ')'));
    }

    public function checkBrackets(): bool
    {
        $state = 0;
        foreach (str_split($this->string) as $key => $char) {
            if (!in_array($char, self::VALID_BRACKETS, true)) {
                return false;
            }

            if ($key === 0 && $char === ')') {
                return false;
            }

            if ($char === '(') {
                $state++;
            }

            if ($char === ')') {
                $state--;
            }
        }

        return $state === 0;
    }
}
