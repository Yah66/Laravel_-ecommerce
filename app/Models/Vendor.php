<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name,
        mobile',
        'address',
        'active',
        'logo',
        'email',
        'category_id'
    ];
    /**
     * Get the user that owns the Vendor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(MainCategory::class, 'category_id');
    }

    public function scopeActive($q)
    {
        return $q->where('active', 1)->get();
    }
}