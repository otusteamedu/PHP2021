<?php

declare(strict_types=1);

namespace App\Infrastructure\Components;

use Exception;

class DataValidation
{
    private string  $name,
                    $phone,
                    $email,
                    $dateFrom,
                    $dateTo;

    public function __construct()
    {
        $this->name = $_POST['name'];
        $this->phone = $_POST['phone'];
        $this->email = $_POST['email'];
        $this->dateFrom = $_POST['dateFrom'];
        $this->dateTo = $_POST['dateTo'];
    }

    /**
     * @param string $data
     * @return string
     */
    protected function prepareInput(string $data): string
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    /**
     * @param string $name
     * @return bool
     * @throws Exception
     */
    protected function validName(string $name): bool
    {
        if (empty($this->prepareInput($name))) throw new Exception('Имя пустое;');
        return true;
    }

    /**
     * @param string $phone
     * @return bool
     * @throws Exception
     */
    protected function validPhone(string $phone): bool
    {
        $phone = $this->prepareInput($phone);
        if (empty($phone)) throw new Exception('телефон пустой;');
        if (!preg_match('/\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/',$phone)) throw new Exception('Неверный формат телефона;');
        return true;
    }

    /**
     * @param string $email
     * @return bool
     * @throws Exception
     */
    protected function validEmail(string $email): bool
    {
        $email = $this->prepareInput($email);
        if (empty($email)) throw new Exception('почта пустая;');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception('Неверный формат почты;');
        return true;
    }

    /**
     * @param string $date
     * @return bool
     * @throws Exception
     */
    protected function validDate(string $date): bool
    {
        $date = $this->prepareInput($date);
        if (empty($date)) throw new Exception('дата пустая;');
        if (preg_match('/^\d{2}[\.]\d{2}[\.]\d{4}$/',$date)) {
            $date = explode('.',$date);
            if (checkdate((int)$date[1],(int)$date[0],(int)$date[2])) return true;
        }
        throw new Exception('Неверный формат даты;');
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function validate(): bool
    {
        if ($this->validName($this->name) &&
            $this->validPhone($this->phone) &&
            $this->validEmail($this->email) &&
            $this->validDate($this->dateFrom) &&
            $this->validDate($this->dateTo)) return true;
        throw new Exception('Неправильно заполнена форма!');
    }
}