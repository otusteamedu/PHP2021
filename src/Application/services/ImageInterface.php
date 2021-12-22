<?php

namespace App\Application\Services;

interface ImageInterface
{
    public function watermark($file);
}