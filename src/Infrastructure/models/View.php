<?php

namespace App\Infrastructure\Models;


use App\Application\Services\ViewInterface;
use App\Application\Services\ViewMapperInterface;
use App\Application\Services\ViewNative;
use App\Application\Services\ViewTwig;

class View implements ViewMapperInterface
{

    public function __invoke(): ViewInterface
    {
        if (!empty(VIEW_TYPE) && VIEW_TYPE == 'twig') {
            return new ViewTwig();
        } else {
            return new ViewNative();
        }
    }
}