<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OjkData extends Model
{
    use HasFactory;

    protected $table = 'ojk_data';

    protected $fillable = [
        'institution_name',
        'institution_type',
        'registration_number',
        'status',
        'address',
        'phone',
        'email',
        'website',
        'registration_date',
        'additional_info',
    ];

    protected $casts = [
        'registration_date' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('institution_type', $type);
    }
}
