<?php


namespace Repetitor202\Email;


interface IValidator
{
    public function validate(string $email): bool;
    public function doReport(string $email): string;
}