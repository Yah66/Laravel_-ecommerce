<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MainCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'photo',
        'slug',
        'status',

    ];
    protected $casts = [
        'name' => 'json',
    ];

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
    /**
     * Get all of the vendors for the MainCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class, 'category_id', 'id');
    }

    /**
     * Get all of the products for the MainCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}