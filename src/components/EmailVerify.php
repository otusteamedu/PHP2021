<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.11.2021
 * Time: 19:00
 */

namespace app\components;


use InvalidArgumentException;

/**
 * Верификация Email адреса
 *
 * Class EmailVerify
 * @package PHP2021\src\components
 */
class EmailVerify
{
    /**
     * @var string
     */
    private string $email;

    /**
     * EmailVerify constructor
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = trim($email);
    }

    /**
     *
     */
    public function execute()
    {
        $this->verifyCorrect();
        $this->verifyMxRecord();
    }

    /**
     * Проврка Email адреса на корректность
     */
    private function verifyCorrect()
    {
        $email = $this->email;
//        $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);

        $pattern = "/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i";
        $isValid = (bool)preg_match($pattern, $email);

        if ($isValid === false) {
            throw new InvalidArgumentException("Email $email указан не верно");
        }
    }

    /**
     * Проврка MX записи Email
     */
    private function verifyMxRecord()
    {
        $email = $this->email;
        list(, $hostname) = explode("@", $email);

        $isValid = getmxrr($hostname, $mxRecords);

        if (
            $isValid === false ||
            count($mxRecords) === 0
        ) {
            throw new InvalidArgumentException("MX запись $email не валидна");
        }
    }
}