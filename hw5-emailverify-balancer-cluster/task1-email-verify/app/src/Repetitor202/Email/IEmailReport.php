<?php


namespace Repetitor202\Email;


interface IEmailReport
{
    public function validateList(array $emails): void;

    public function setValidateEmail(bool $trueFalse = true): void;

    public function setValidateHostname(bool $trueFalse = true): void;
}