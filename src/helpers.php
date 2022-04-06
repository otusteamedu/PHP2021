<?php

if (!function_exists('random_string')) {
    function random_string($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr( str_shuffle( $chars ), 0, $length );
    }
}