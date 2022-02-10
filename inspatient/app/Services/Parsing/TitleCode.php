<?php

namespace App\Services\Parsing;

use App\Models\ParsingDictionary;

class TitleCode
{
    public function getTitleCode($value)
    {
        //todo переписать этот справочник на Redis
        $parsingDictionary = ParsingDictionary::find($value);
        return $parsingDictionary ?? null;
    }
}