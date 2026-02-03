<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'application_number',
        'amount',
        'tenor',
        'interest_rate',
        'status',
        'notes',
        'applicant_data',
        'submitted_at',
        'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'submitted_at' => 'datetime',
        'processed_at' => 'datetime',
        'applicant_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function generateApplicationNumber()
    {
        $prefix = 'APP';
        $date = now()->format('Ymd');
        $latest = self::whereDate('created_at', today())->count();
        $number = str_pad($latest + 1, 4, '0', STR_PAD_LEFT);
        return "{$prefix}-{$date}-{$number}";
    }
}
