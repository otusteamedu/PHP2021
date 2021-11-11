<?php declare(strict_types=1);

namespace App\Services;

class ValidateRequestService
{
    private string $str;

    public function __construct(string $str)
    {
        $this->str = $str;
    }

    public function isValid(): bool
    {
        $str_cor = substr_count($this->str, '(') === substr_count($this->str, ')');

        if ($str_cor) {
            $bkt = 0;

            foreach(str_split($this->str) as $symb) {
                switch ($symb) {
                    case '(':
                        $bkt++;
                        break;
                    case ')':
                        $bkt--;
                        break;
                }

                if ($bkt < 0) {
                    break;
                }
            }

            if ($bkt !== 0) {
                $str_cor = false;
            }
        }

        return $str_cor;
    }

    public function isBalance(string $string): bool
    {
        $openingBrackets = array("(", "[", "{");
        $closingBrackets = array(")", "]", "}");
        $stack = array();

        for ($i = 0, $iMax = strlen($string); $i < $iMax; $i++) {
            $char = $string[$i];

            if (in_array($char, $openingBrackets)) {
                $stack[] = $char;
            }

            if (in_array($char, $closingBrackets)) {
                $matchingOpeningBracket = $openingBrackets[array_search($char, $closingBrackets)];
                $topOfStack = array_values(array_slice($stack, -1))[0];
                if ($topOfStack == $matchingOpeningBracket) {
                    array_pop($stack);
                } else {
                    return false;
                }
            }

            if ((strlen($string) - 1) == $i) {
                return true;
            }
        }
    }
}
