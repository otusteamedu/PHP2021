<?php

if (!function_exists('view')) {
    function view($view, $data = [])
    {
        return \App\Http\View::view($view, $data);
    }
}