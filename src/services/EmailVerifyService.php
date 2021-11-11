<?php
/**
 * Created by PhpStorm.
 * User: itily
 * Date: 11.11.2021
 * Time: 17:48
 */

namespace app\services;

use app\components\EmailVerify;
use InvalidArgumentException;

/**
 * Верификация Email
 *
 * Class EmailVerifyService
 * @package app\components
 */
class EmailVerifyService
{
    /**
     * @var array
     */
    private array $emails;

    /**
     * EmailVerifyService constructor.
     * @param array $emails
     */
    public function __construct(array $emails)
    {
        $this->emails = $emails;
    }

    /**
     * Верификация по данным из запроса
     * @param array $data
     * @return EmailVerifyService
     */
    public static function fromRequest(array $data): EmailVerifyService
    {
        if (array_key_exists('emails', $data) === false) {
            throw new InvalidArgumentException('Параметр Emails не найден');
        }

        return self::fromString($data['emails']);
    }

    /**
     * Верификация по строке Email адресов
     * @param string $value
     * @return EmailVerifyService
     */
    public static function fromString(string $value): EmailVerifyService
    {
        if (empty($value) === true) {
            throw new InvalidArgumentException('Не задана строка Email адресов');
        }

        $emails = explode(';', $value);

        return new self($emails);
    }

    /**
     * Верификация Email адресов
     */
    public function verify()
    {
        $emails = $this->emails;

        foreach ($emails as $email) {
            $emailVerify = new EmailVerify($email);
            $emailVerify->execute();
        }
    }
}