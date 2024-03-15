<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    //主キーをUUIDのような文字列にするときに必要
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'level',
        'number',
        'name',
        'achievement',
        'description'
    ];
}
