<?php

namespace App;

use App\Response;

class App
{
    /** @var Response $response */
    private $response;

    /** @var string $mode */
    private $mode;

    public function __construct(string $mode = '')
    {
        $this->response = Response::fail();

        $this->mode = $mode;
    }


    private function checkSymbols(string $string): bool
    {
        $list = str_split($string);

        for ($i = 0; $i < count($list); $i++) {
            if (! in_array($list[$i], ['(', ')'])) {
                $this->response->setMessage(sprintf('ошибка [некорректный символ] "%s"', $list[$i]));
                return false;
            }
        }

        return true;
    }


    private function checkNotEmpty($string): bool
    {
        if (   is_string($string)
            && (strlen($string) > 0)
        ) {
            return true;
        }

        $this->response->setMessage('ошибка: ожидалась непустая строка');

        return false;
    }


    private function checkBrackets(string $target): bool
    {
        $source = $target;

        do {
            $stepResult = str_replace('()', '', $source);

            if ($this->mode === 'cli') {
                echo sprintf('%s -> %s', $source, $stepResult) . PHP_EOL;                
            }

            $needStop = ($source === $stepResult) || ($stepResult === '');

            $source = $stepResult;

        } while (! $needStop);

        if ($stepResult !== '') {
            $this->response->setMessage('ошибка: скобки не закрыты!');
        }

        return ($stepResult === '');
    }


    public function run($string): Response
    {
        if (   $this->checkNotEmpty($string)
            && $this->checkSymbols($string)
            && $this->checkBrackets($string)
        ) {
            $this->response->setResult(true);
            $this->response->setMessage('ok');
        }

        return $this->response;
    }
}