<?php

declare(strict_types=1);

namespace App\Validators;

class EmailValidator
{
    protected array $request;
    protected string $email;

    /**
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function run()
    {
        $this->email = $this->request['email'];

        $this->validate();
    }

    private function validate(): void
    {
        if ($this->isValidEmail() && $this->isValidEmailHostMX()) {
            echo 'Email ' . $this->email . ' is valid. ';
        } else {
            echo 'Email ' . $this->email . ' NOT valid :( ';
        }
    }

    public function isValidEmail(): bool
    {
        return (bool)preg_match(
            "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",
            $this->email
        );
    }

    public function isValidEmailHostMX(): bool
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            [$username, $host] = explode('@', $this->email);

            return getmxrr($host, $hosts);
        }

        return false;
    }


}
