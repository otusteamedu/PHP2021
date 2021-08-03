<?php


declare(strict_types=1);


namespace Brackets\Tools\Service;


use Brackets\Tools\Response\HttpResponse;
use Brackets\Tools\Strings\BracketsValidator;

final class ValidationService
{

    private ?string $string;

    public function __construct(?string $inputString)
    {
        $this->string = $inputString;
    }

    /**
     *
     * Return HttpRespone of brackets validation
     *
     * @return HttpResponse
     */
    public function getBracketsValidation(): HttpResponse
    {
        if (is_null($this->string)) {
            return new HttpResponse(400, "No POST-param with name string passed");
        }

        $validator = new BracketsValidator($this->string);
        $isValid = $validator->isValid();

        if (!$isValid) {
            return new HttpResponse(400, "Wrong string!");
        }
        return new HttpResponse(200, "OK", "OK");
    }

}