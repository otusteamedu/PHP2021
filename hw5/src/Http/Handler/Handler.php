<?php declare(strict_types=1);

namespace App\Http\Handler;

use App\Http\Interfaces\HandlerInterface;
use App\Http\Interfaces\RequestInterface;
use App\Http\Interfaces\ResponseInterface;
use App\Http\Response\JsonResponse;
use App\Validator\EmailValidatorInterface;

class Handler implements HandlerInterface
{
    public function __construct(
        private EmailValidatorInterface $emailValidator
    ) {
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() !== 'POST') {
            return new JsonResponse(405, ['message' => 'Method not allowed']);
        }

        $emails = $request->getParam('emails');

        if (empty($emails)) {
            return new JsonResponse(400, ['message' => 'Empty email array']);
        }

        $validEmails = $this->emailValidator->validateArray($emails);

        return new JsonResponse(200, ['message' => 'OK', 'valid_emails' => $validEmails]);
    }
}
