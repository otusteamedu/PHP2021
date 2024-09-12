<?php

namespace App;

class EmailValidator
{

    /**
     * Метод проверяет переменную email на соответствие формату email
     * @param string $email
     * @return bool
     */
    private function checkEmailFormat(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    

    /**
     * Метод проверяет наличие у DNS сервера MX записи домена электронной почты
     * @param string $email
     * @return bool
     */
    private function checkEmailDnsMx(string $email): bool
    {
        $hostname = $this->getEmailHostname($email);

        if (!$hostname) {
            return false;
        }

        return checkdnsrr($hostname, "MX");
    }


    /**
     * Метод извлекает из email адреса имя домена и возвращает его
     * @param string $email
     * @return string
     */
    private function getEmailHostname(string $email): string
    {
        if (!$this->checkEmailFormat($email)) {
            return '';
        }

        $explodedEmail = explode('@', $email);

        return $explodedEmail[count($explodedEmail) - 1];
    }

    /**
     * Метод проверяет email адрес на соответствие все требованиям
     * @param string $email
     * @return bool
     */
    public function validate (string $email): bool
    {
        if (!$this->checkEmailFormat($email) || !$this->checkEmailDnsMx($email)) {
            return false;
        }

        return true;
    }

    /**
     * Метод проверяет массив email адресов и возвращает те которые прошли валидацию
     * @param array $emails
     * @return array
     */
    public function validateArray(array $emails): array
    {
        $correctEmails = [];

        foreach ($emails as $email) {
            if ($this->validate($email)) {
                $correctEmails[] = $email;
            }
        }

        return $correctEmails;
    }

}
