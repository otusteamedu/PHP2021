<?php

namespace App\Services\Repositories;

use App\Models\Patient;
use Illuminate\Support\Collection;

class EloquentPatientRepository implements PatientRepository
{

    public function getAll(): Collection
    {
        $qb = Patient::query();
        return $qb->get();
    }
}