<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    //主キーをUUIDのような文字列にするときに必要
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'module_id',
        'unit_id',
        'level',
        'name',
        'achievement',
        'description'
    ];

    public function module() {
        return $this->belongsTo(Module::class);
    }
    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    //scopeの登録
    public function scopeModuleLevelOne($query) {
        return $query->whereHas('module', function($query) {
            $query->where('level', 1);
        });
    }

    public function scopeUnitLevelOne($query) {
        return $query->whereHas('unit', function($query) {
            $query->where('level', 1);
        });
    }
}
