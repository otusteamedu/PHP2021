<?php declare(strict_types=1);

namespace App\Http\Handler;

use App\Http\Interfaces\HandlerInterface;
use App\Http\Interfaces\RequestInterface;
use App\Http\Interfaces\ResponseInterface;
use App\Http\Response\JsonResponse;
use App\Validator\BracketsValidatorInterface;

class Handler implements HandlerInterface
{
    public function __construct(
        private BracketsValidatorInterface $bracketsValidator
    ) {
    }

    public function handle(RequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() !== 'POST') {
            return new JsonResponse(405, ['message' => 'Method not allowed']);
        }

        $brackets = $request->getPost('string');

        if ($brackets === null) {
            return new JsonResponse(400, ['message' => 'Empty string']);
        }

        try {
            $isValid = $this->bracketsValidator->validate($brackets);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(400, ['message' => $e->getMessage()]);
        }

        if ($isValid === false) {
            return new JsonResponse(400, ['message' => 'Invalid brackets sequence']);
        }

        return new JsonResponse(200, ['message' => 'OK']);
    }
}
