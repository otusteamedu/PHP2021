<?php

declare(strict_types=1);

namespace MySite\Features\MailChecker\Dto;

use MySite\Features\MailChecker\Traits\EmailValidateTrait;

/**
 * Class EmailValidate
 * @package MySite\Features\MailChecker\Dto
 */
class EmailValidate
{

    use EmailValidateTrait;

    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $domain;
    /**
     * @var bool
     */
    private bool $isValid = true;
    /**
     * @var string|null
     */
    private ?string $comment = null;


    public static function createFromString(string $email): EmailValidate
    {
        $emailValidate = new EmailValidate();

        $explodeData = self::getNameAndDomain($email);

        $emailValidate
            ->setEmail($email)
            ->setName($explodeData['name'])
            ->setDomain($explodeData['domain']);

        return $emailValidate;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return EmailValidate
     */
    public function setEmail(string $email): EmailValidate
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return EmailValidate
     */
    public function setName(string $name): EmailValidate
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return EmailValidate
     */
    public function setDomain(string $domain): EmailValidate
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     * @return EmailValidate
     */
    public function setIsValid(bool $isValid): EmailValidate
    {
        $this->isValid = $isValid;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     * @return EmailValidate
     */
    public function setComment(?string $comment): EmailValidate
    {
        $this->comment = $comment;
        return $this;
    }


}
