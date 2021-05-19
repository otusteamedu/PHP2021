<?php


namespace MySite\Features\StringTester;


use JetBrains\PhpStorm\NoReturn;
use JetBrains\PhpStorm\Pure;
use MySite\Features\AbstractFeature;
use MySite\Features\HttpStatus;
use Psr\Http\Message\ServerRequestInterface;

class App extends AbstractFeature implements HttpStatus
{

    /**
     * @param ServerRequestInterface $request
     */
    #[NoReturn] public function run(ServerRequestInterface $request): void
    {
        $data = $request->getParsedBody();
        if (
            isset($data['string']) &&
            $data['string'] &&
            $this->checkString($data['string'])
        ) {
            $this->setCode(self::OK);
            $this->setResponse('Ok');
        }
    }

    /**
     * @param string $str
     * @return bool
     */
    #[Pure] public function checkString(string $str): bool
    {
        $exp_1 = $str[0] == '(';
        $exp_2 = substr_count($str, '(') == substr_count($str, ')');
        return $exp_1 && $exp_2;
    }
}
