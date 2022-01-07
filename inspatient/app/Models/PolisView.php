<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class PolisView extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $allowedFilters = ['patient_name', 'birthday', 'insurance_name', 'number'];

}