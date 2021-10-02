<?php

namespace App\Services\Youtube\Structures;

final class Titles
{
    private string $titleName;
    private string $valueName;

    public function __construct(string $titleName, string $valueName)
    {
        $this->titleName = $titleName;
        $this->valueName = $valueName;
    }

    public function getTitleName(): string
    {
        return $this->titleName;
    }

    public function getValueName(): string
    {
        return $this->valueName;
    }

}
