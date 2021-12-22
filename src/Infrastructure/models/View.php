<?php

namespace App\Infrastructure\Models;


use App\Application\Services\ViewNative;
use App\Application\Services\ViewTwig;

class View
{
    public function __invoke()
    {
        if (!empty(VIEW_TYPE) && VIEW_TYPE == 'twig') {
            return new ViewTwig();
        } else {
            return new ViewNative();
        }
    }
}