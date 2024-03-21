<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'lesson_id',
        'module_id',
        'unit_id',
        'user_id',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function module() {
        return $this->belongsTo(Module::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }
    
}
