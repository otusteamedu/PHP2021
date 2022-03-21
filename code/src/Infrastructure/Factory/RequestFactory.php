<?php
declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Contract\RequestFactoryInterface;
use App\Domain\Entity\Request;

class RequestFactory implements RequestFactoryInterface
{
    private Request $request;

    public function build(
        string $firstname,
        string $email,
        string $phone,
        string $date1,
        string $date2
    ): Request
    {
        try {
           $this->request = new Request($firstname, $email, $phone, $date1, $date2);
        }catch (\Exception $e) {
            echo $e->getMessage(). PHP_EOL;
        }

        return $this->request;
    }

}