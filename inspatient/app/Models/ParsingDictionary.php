<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParsingDictionary extends Model
{
    use HasFactory;

    protected $primaryKey = 'value';
    public $incrementing = false;
    protected $keyType = 'string';
}
