<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'module_id',
        'unit_id',
        'number',
        'name',
        'achievement',
        'description'
    ];
}
