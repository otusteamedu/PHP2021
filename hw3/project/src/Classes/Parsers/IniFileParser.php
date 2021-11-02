<?php

namespace App\Classes\Parsers;


use App\Classes\Exceptions\FileNotReadableException;
use App\Classes\Exceptions\FileParsingErrorException;
use App\Contracts\Parsers\FileToArrayParserContract;

class IniFileParser implements FileToArrayParserContract
{
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function parse(): array
    {
        if (! is_readable($this->filePath)) {

            throw new FileNotReadableException('Cannot read file: ' . $this->filePath);
        }

        $result = parse_ini_file($this->filePath, true);

        if ($result === false) {

            throw new FileParsingErrorException();
        }

        return $result;
    }


}
