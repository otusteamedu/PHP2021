<?php

namespace App;

class StringHelper
{
    /**
     * @var
     */
    private $string;

    /**
     * @param $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @return array
     */
    public function getCleanedPieces()
    {
        $string_pieces  = explode(" ", $this->string);
        $cleaned_pieces = [];

        foreach (array_filter($string_pieces) as $string_piece) {
            $cleaned_pieces[] = trim($string_piece);
        }

        return $cleaned_pieces;
    }
}