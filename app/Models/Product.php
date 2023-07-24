<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'category_id',
        'price',
        'discount_price',
        'qty',
        'tax',
        'image',
        'description',
        'small_description',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
        'trending'
    ];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function main_category()
    {
        return $this->belongsTo(MainCategory::class, 'category_id');
    }
}