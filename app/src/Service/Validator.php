<?php

namespace Src\Service;

use Exception;

class Validator
{
    /**
     * @var string
     */
    private string $errors = '';

    /**
     * @throws Exception
     */
    public function Email(array $emails = [])
    {
        foreach ($emails as $key => $email) {
            $key++;
            if ($this->checkEmpty((string)$email)) {
                if ($this->checkRegExp($email)) {
                    if (!$this->checkMX($email)) {
                        $this->errors .= "№{$key} - {$email}: MX not found;".PHP_EOL;
                    }
                } else {
                    $this->errors .= "№{$key} - {$email}: didn't validate;".PHP_EOL;
                }
            } else {
                $this->errors .= "№{$key}: email is empty;".PHP_EOL;
            }
        }
        if ($this->checkEmpty($this->errors)) throw new Exception($this->errors);
    }

    /**
     * @param string $str
     */
    private function checkRegExp(string $str = '')
    {
        return filter_var($str,FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string $str
     * @return bool
     */
    private function checkEmpty(string $str = ''): bool
    {
        return !empty($str);
    }

    /**
     * @param string $str
     * @return bool
     */
    private function checkMX(string $str = ''): bool
    {
        $email = explode($str,'@');
        return getmxrr($email[1],$hosts);
    }
}