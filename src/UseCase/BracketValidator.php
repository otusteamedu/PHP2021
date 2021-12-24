<?php

namespace App\UseCase;

use App\Contract\ValidatorInterface;
use App\DTO\Request;
use App\DTO\Response;

class BracketValidator implements ValidatorInterface
{
    private const STATUS_EMPTY = 'String not defined';
    private const STATUS_INCORRECT = 'Incorrect string';
    private const STATUS_CORRECT = 'String validation completed successfully';
    private const ERROR_CODE = 400;

    /**
     * @param Request $req
     *
     * @return Response
     */
    public function validate(Request $req): Response
    {
        if (empty($req->getBody())) {
            return new Response(self::STATUS_EMPTY, self::ERROR_CODE);
        }

        if (!$this->isValidBacket($req->getBody())) {
            return new Response(self::STATUS_INCORRECT, self::ERROR_CODE);
        }

        return new Response(self::STATUS_CORRECT);
    }

    private function isValidBacket(string $str): bool
    {
        $bracketCounter = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str[$i] === '(') {
                $bracketCounter++;
            } elseif ($str[$i] === ')') {
                if ($bracketCounter < 1) {
                    return false;
                }
                $bracketCounter--;
            }
        }

        if ($bracketCounter > 0) {
            return false;
        }

        return true;
    }
}
