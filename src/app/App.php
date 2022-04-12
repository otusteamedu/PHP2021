<?php

namespace Ivanboriev\TrustedBrackets;


use Ivanboriev\TrustedBrackets\Exceptions\BadRequestMethodException;
use Ivanboriev\TrustedBrackets\Exceptions\InvalidArgumentException;
use Ivanboriev\TrustedBrackets\Request\Request;
use Ivanboriev\TrustedBrackets\Response\Response;
use Ivanboriev\TrustedBrackets\Validator\Rules\EndsWithRule;
use Ivanboriev\TrustedBrackets\Validator\Rules\EqualsRule;
use Ivanboriev\TrustedBrackets\Validator\Rules\NotEmptyRule;
use Ivanboriev\TrustedBrackets\Validator\Rules\OnlyRule;
use Ivanboriev\TrustedBrackets\Validator\Rules\RequiredRule;
use Ivanboriev\TrustedBrackets\Validator\Rules\StartsWithRule;
use Ivanboriev\TrustedBrackets\Validator\Validator;

class App
{
    private Request $request;

    private Validator $validator;



    public function __construct()
    {
        $this->request = new Request;

        $this->validator = new Validator;
    }


    /**
     * @throws BadRequestMethodException
     * @throws InvalidArgumentException
     */
    public function run(): void
    {
        if (!$this->request->isPost()) {
            throw new BadRequestMethodException;
        }

        $this->validator->make($this->request->payload(), [
            'string' => [
                new RequiredRule,
                new NotEmptyRule,
                new OnlyRule(['(', ')']),
                new StartsWithRule('('),
                new EndsWithRule(')'),
                new EqualsRule('(', ')')
            ]
        ]);

        if ($this->validator->fails()) {
            throw new InvalidArgumentException($this->validator->error());
        }

        Response::success("Bracket pair test passed!");

    }

}