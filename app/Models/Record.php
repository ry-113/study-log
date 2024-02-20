<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function subject() {
        return $this->belongsTo('App\Models\Subject');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
