<?php

namespace App\Services\Repositories;


use Illuminate\Support\Collection;

interface PatientRepository
{

    public function getAll():Collection;
}