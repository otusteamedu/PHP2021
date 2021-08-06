<?php


declare(strict_types=1);


namespace Balance\Tools\Service;


use ADoronichev\Validators\EmailValidator;
use Balance\Tools\Response\HttpResponse;


final class ValidationService
{

    private ?string $string;
    private ?StorageService $storage = null;

    public function __construct(?string $inputString, $hasStorage = false)
    {
        $this->string = $inputString;
        if ($hasStorage) {
            $this->storage = new StorageService();
        }
    }

    /**
     * Return HttpRespone of email validation
     *
     * @return HttpResponse
     */
    public function getEmailValidation(): HttpResponse
    {
        if (is_null($this->string)) {
            return new HttpResponse(400, "No POST-param with name email passed");
        }

        if (!is_null($this->storage)) {
            $isValid = $this->storage->get($this->string)
                ?? $this->storage->set($this->string, $this->validateEmail());
        } else {
            $isValid = $this->validateEmail();
        }

        if (!$isValid) {
            return new HttpResponse(400, "Wrong string (not valid e-mail)!");
        }
        return new HttpResponse(200, "OK", "OK");
    }

    private function validateEmail(): bool
    {
        $validator = new EmailValidator($this->string);
        return $validator->isValid(true);
    }

}