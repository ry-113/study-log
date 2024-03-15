<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    //主キーをUUIDのような文字列にするときに必要
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'module_id',
        'level',
        'name',
        'achievement',
        'description'
    ];
}
