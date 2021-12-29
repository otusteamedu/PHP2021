<?php

declare(strict_types=1);

namespace App;

use App\Form\StringForm;
use App\Http\Request;
use App\Http\Response;
use Exception;
use InvalidArgumentException;

class App
{
    public function run(): void
    {
        try {
            $request = $this->getRequest();

            $form = new StringForm();
            $form->handleRequest($request);

            if (!$form->isValid()) {
                throw new InvalidArgumentException($form->getErrorMessage());
            }

            $this->sendSuccessResponse('Строка валидна');
        } catch (InvalidArgumentException $e) {
            $this->sendFailResponse($e->getMessage());
        } catch (Exception $e) {
            $this->sendResponse(500, '');
        }
    }

    private function getRequest(): Request
    {
        return new Request();
    }

    private function sendSuccessResponse(string $content): void
    {
        $this->sendResponse(200, $content);
    }

    private function sendFailResponse(string $content): void
    {
        $this->sendResponse(400, $content);
    }

    private function sendResponse(int $statusCode, string $content): void
    {
        $response = new Response($statusCode, $content);
        $response->send();
    }
}
