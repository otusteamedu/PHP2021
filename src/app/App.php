<?php

namespace App;

use App\Exceptions\EmailInvalidException;
use App\Exceptions\EmptyDataException;
use App\Exceptions\NoMxRecordException;
use App\Exceptions\WrongMethodException;

class App
{
    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            throw new WrongMethodException();
        }
        if (empty($_GET) or empty($email = $_GET['email'])) {
            throw new EmptyDataException();
        }

        if (!$this->validate($email)) {
            throw new EmailInvalidException();
        }

        $domain = $this->parseEmail($email)['domain'];
        if (!checkdnsrr($domain, 'MX')) {
            throw new NoMxRecordException($domain);
        }

        echo 'Email is valid';
    }

    protected function getMXrecords(string $domain): ?array
    {
        $mxhosts = array();
        $mxweights = array();
        if (getmxrr($domain, $mxhosts, $mxweights) === false) {
            throw new NoMxRecordException($domain);
        } else {
            array_multisort($mxweights, $mxhosts);
        }

        if (empty($mxhosts)) {
            $mxhosts[] = $domain;
        }
        return $mxhosts;
    }

    protected function validate(string $email): ?bool
    {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    protected function getUser($email): string
    {
        return $this->parseEmail($email)['user'];
    }

    protected function getDomain($email): string
    {
        return $this->parseEmail($email)['domain'];
    }

    protected function parseEmail($email): array
    {
        sscanf($email, "%[^@]@%s", $user, $domain);
        return [
            'user' => $user ?? null,
            'domain' => $domain ?? null
        ];
    }
}
