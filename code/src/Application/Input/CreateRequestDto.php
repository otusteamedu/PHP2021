<?php
declare(strict_types=1);

namespace App\Application\Input;

class CreateRequestDto
{
    static public string $firstname;
    static public string $email;
    static public string $phone;
    static public string $date1;
    static public string $date2;

    static function fromArray(array $bodyJson):CreateRequestDto
    {
        self::$firstname = $bodyJson['firstname'];
        self::$email = $bodyJson['email'];
        self::$phone = $bodyJson['phone'];
        self::$date1 = $bodyJson['date1'];
        self::$date2 = $bodyJson['date2'];

        return new CreateRequestDto();
    }

}