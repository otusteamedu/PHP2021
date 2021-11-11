<?php

declare(strict_types=1);

namespace Src;

use Exception;
use Src\Cli\ColorCli;
use Src\Reader\TxtReader;
use Src\Validator\EmailValidator;

class App
{
    public function run(): void
    {
        try {
            $this->processEmails();
        } catch (Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }

    /**
     * @throws Exception
     */
    private function getEmails(): array
    {
        if (empty($_SERVER['argv'][1])) {
            throw new Exception("The first parameter should be a file with a list of email addresses");
        }
        $emails = (new TxtReader())->readToArray($_SERVER['argv'][1]);
        if (empty($emails)) {
            throw new Exception('File is empty');
        }

        return $emails;
    }

    /**
     * @throws Exception
     */
    private function processEmails(): void
    {
        $colorCli = new ColorCli();
        $emailValidator = new EmailValidator();

        foreach ($this->getEmails() as $email) {
            echo $email . ': ';
            if ($emailValidator->isValid($email)) {
                echo $colorCli->colorText('valid', 'green');
            } else {
                echo $colorCli->colorText('invalid', 'red');
            }
            echo PHP_EOL;
        }
    }
}
