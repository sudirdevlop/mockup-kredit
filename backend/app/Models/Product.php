<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'interest_rate_min',
        'interest_rate_max',
        'tenor_min',
        'tenor_max',
        'amount_min',
        'amount_max',
        'requirements',
        'benefits',
        'provider',
        'image',
        'is_active',
    ];

    protected $casts = [
        'interest_rate_min' => 'decimal:2',
        'interest_rate_max' => 'decimal:2',
        'amount_min' => 'decimal:2',
        'amount_max' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function creditSimulations()
    {
        return $this->hasMany(CreditSimulation::class);
    }
}
