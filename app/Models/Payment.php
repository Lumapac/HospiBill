<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bill_id',
        'amount',
        'payment_method', // 'cash', 'card', 'bank_transfer', etc.
        'reference_number',
        'notes',
        'cashier_id', // ID of the user (cashier) who processed the payment
    ];

    /**
     * Get the bill associated with the payment.
     */
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    /**
     * Get the cashier who processed the payment.
     */
    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
} 