<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Polis extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'number',
        'patient_id',
        'insurance_id',
        'startDate',
        'endDate',
        'avans',
        'program_id',
        'description'
    ];

    protected $allowedFilters = ['number'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
}
