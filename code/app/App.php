<?php declare(strict_types=1);

namespace App;

use App\Services\ValidateEmailService;

class App
{
    private const PATH_FILE='storage/emails';

    public function handle()
    {
        $this->validateEmail = new ValidateEmailService();
        $this->emails = file(self::PATH_FILE, FILE_IGNORE_NEW_LINES);

        foreach ($this->emails as $email)
        {
            try {
                $this->validateEmail->handle($email);
                echo "$email is correct <br>";
            } catch (\Exception $exception) {
                if ($exception->getCode() === 400) {
                    echo "$email is wrong <br>";
                }
            }
        }
    }
}
