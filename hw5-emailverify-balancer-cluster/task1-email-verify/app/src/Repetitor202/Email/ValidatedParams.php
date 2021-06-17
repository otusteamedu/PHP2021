<?php


namespace Repetitor202\Email;


class ValidatedParams
{
    private ?bool $email = null;
    private ?bool $hostname = null;

    public function setEmail(bool $trueFalse): void
    {
        $this->email = $trueFalse;
    }

    public function getEmail(): ?bool
    {
        return $this->email;
    }

    public function setHostname(bool $trueFalse): void
    {
        $this->hostname = $trueFalse;
    }

    public function getHostname(): ?bool
    {
        return $this->hostname;
    }

}