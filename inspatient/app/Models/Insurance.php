<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Insurance extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $allowedFilters = ['name', 'address', 'phone', 'email'];
    protected $fillable = ['name', 'address', 'phone', 'email', 'description'];


}
