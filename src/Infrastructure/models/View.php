<?php

namespace App\Infrastructure\Models;

use App\Services\ViewNative;
use App\Services\ViewTwig;

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