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

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }
}
