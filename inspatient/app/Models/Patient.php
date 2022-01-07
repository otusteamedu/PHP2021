<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Patient extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;


    protected $fillable = ['name', 'birthday', 'phone', 'email', 'address', 'work', 'filial_id', 'aboutAdding', 'aboutRemove', 'description' ];

    protected $allowedFilters = ['name', 'birthday', 'phone'];

    function polis(){
        return $this->hasOne(Polis::class);
    }

    public function getFullAttribute(): string
    {
        return $this->attributes['name'] . ' ' . $this->attributes['birthday'];
    }

}
