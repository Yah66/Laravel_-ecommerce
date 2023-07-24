<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'abbr',
        'locale',
        'name',
        'active',
        'dir'
    ];

    public function scopeSelection() {
        return $this->where('active',1)->get();
    }
}