<?php


declare(strict_types=1);


namespace Brackets\Tools\Strings;


final class BracketsValidator
{

    private string $string;

    public function __construct(string $inputString)
    {
        $this->initString($inputString);
    }

    /*
     *
     * Remove "wrong" characters
     *
     * @param string $inputString
     */
    private function initString(string $inputString): void
    {
        $inputString = trim($inputString);
        $inputString = stripslashes($inputString);
        $inputString = htmlspecialchars($inputString);
        $this->string = $inputString;
    }

    /**
     *
     * Check if brackets position is correct
     *
     * @param string $openBracket Open bracket char
     * @param string $closeBracket Close bracket char
     * @return bool
     */
    public function isValid(string $openBracket = "(", string $closeBracket = ")"): bool
    {

        $possibleChars = [$openBracket, $closeBracket];

        $bracketSize = 0;

        for ($i = 0; $i < strlen($this->string); $i++) {
            //Only brackets are possible in string
            if (!in_array($this->string[$i], $possibleChars)) {
                return false;
            }
            if ($this->string[$i] == $openBracket) {
                $bracketSize++;
            } else {
                $bracketSize--;
            }
            if ($bracketSize < 0) {
                return false;
            }
        }
        return $bracketSize == 0;
    }

}