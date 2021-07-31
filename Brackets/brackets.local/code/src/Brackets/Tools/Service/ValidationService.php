<?php


declare(strict_types=1);


namespace Brackets\Tools\Service;


use Brackets\Tools\Response\HttpRespone;
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
     * @return HttpRespone
     */
    public function getBracketsValidation(): HttpRespone
    {
        if (is_null($this->string)) {
            return new HttpRespone(400, "No POST-param with name string passed");
        }

        $validator = new BracketsValidator($this->string);
        $isValid = $validator->isValid();

        if (!$isValid) {
            return new HttpRespone(400, "Wrong string!");
        }
        return new HttpRespone(200, "OK", "OK");
    }

}