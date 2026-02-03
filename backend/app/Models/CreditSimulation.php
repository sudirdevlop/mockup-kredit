<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreditSimulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'loan_amount',
        'tenor',
        'interest_rate',
        'monthly_payment',
        'total_payment',
        'total_interest',
        'ip_address',
    ];

    protected $casts = [
        'loan_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'monthly_payment' => 'decimal:2',
        'total_payment' => 'decimal:2',
        'total_interest' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function calculate($loanAmount, $tenor, $interestRate)
    {
        $monthlyRate = $interestRate / 100 / 12;
        $monthlyPayment = $loanAmount * ($monthlyRate * pow(1 + $monthlyRate, $tenor)) / (pow(1 + $monthlyRate, $tenor) - 1);
        $totalPayment = $monthlyPayment * $tenor;
        $totalInterest = $totalPayment - $loanAmount;

        return [
            'monthly_payment' => round($monthlyPayment, 2),
            'total_payment' => round($totalPayment, 2),
            'total_interest' => round($totalInterest, 2),
        ];
    }
}
