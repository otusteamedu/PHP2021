<?php

namespace Ivanboriev\TrustedBrackets;

use Ivanboriev\TrustedBrackets\Exceptions\BadRequestMethodException;
use Ivanboriev\TrustedBrackets\Exceptions\EmptyPayloadRequestException;
use Ivanboriev\TrustedBrackets\Exceptions\InvalidCharacterException;
use Ivanboriev\TrustedBrackets\Exceptions\NotEqualsPairException;
use Ivanboriev\TrustedBrackets\Exceptions\ParamRequestMissingException;
use Ivanboriev\TrustedBrackets\Request\Request;
use Ivanboriev\TrustedBrackets\Response\Response;
use Ivanboriev\TrustedBrackets\Validator\Validator;

class App
{
    const HANDLE_REQUEST_KEY = 'string';
    const BRACKETS_CHARS = ['(', ')'];

    private $request;


    public function __construct()
    {
        $this->request = new Request;
    }


    /**
     * @throws InvalidCharacterException
     * @throws BadRequestMethodException
     * @throws NotEqualsPairException
     * @throws ParamRequestMissingException
     * @throws EmptyPayloadRequestException
     */
    public function run()
    {
        if (!$this->request->isPost()) {
            throw new BadRequestMethodException;
        }

        if (!Validator::required(self::HANDLE_REQUEST_KEY, $this->request->payload())) {
            throw new ParamRequestMissingException(sprintf("Missing param request: ['%s']", self::HANDLE_REQUEST_KEY));
        }

        $bracketsString = $this->request->payload()[self::HANDLE_REQUEST_KEY];

        if (Validator::isEmpty($bracketsString)) {
            throw new EmptyPayloadRequestException;
        }

        if (!Validator::onlyChars(self::BRACKETS_CHARS, $bracketsString)) {
            throw new InvalidCharacterException(sprintf("The '%s' contains invalid characters!", self::HANDLE_REQUEST_KEY));
        }

        if (!Validator::equals(self::BRACKETS_CHARS[0], self::BRACKETS_CHARS[1], $bracketsString)) {
            throw new NotEqualsPairException;
        }

        Response::success("Bracket pair test passed!");

    }

}