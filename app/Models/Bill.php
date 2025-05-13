<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bill_number',
        'patient_id',
        'service_id',
        'amount',
        'amount_paid',
        'due_date',
        'status', // 'pending', 'paid', 'overdue', 'partially_paid'
        'payment_method',
        'notes',
    ];
    
    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'due_date' => 'date',
    ];

    /**
     * Get the patient that owns the bill.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the service associated with the bill.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get the payments for this bill.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the remaining balance on this bill.
     */
    public function getRemainingBalanceAttribute()
    {
        return $this->amount - $this->amount_paid;
    }
    
    /**
     * Get formatted amount with currency symbol.
     */
    public function getFormattedAmountAttribute()
    {
        return '₱' . number_format($this->amount, 2);
    }
    
    /**
     * Get formatted amount paid with currency symbol.
     */
    public function getFormattedAmountPaidAttribute()
    {
        return '₱' . number_format($this->amount_paid, 2);
    }
    
    /**
     * Get formatted remaining balance with currency symbol.
     */
    public function getFormattedRemainingBalanceAttribute()
    {
        return '₱' . number_format($this->remaining_balance, 2);
    }
    
    /**
     * Check if the bill is overdue.
     */
    public function getIsOverdueAttribute()
    {
        return $this->status !== 'paid' && Carbon::now()->gt($this->due_date);
    }
    
    /**
     * Get formatted status with color class.
     */
    public function getStatusClassAttribute()
    {
        return match ($this->status) {
            'paid' => 'bg-green-100 text-green-800',
            'partially_paid' => 'bg-yellow-100 text-yellow-800',
            'overdue' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
    
    /**
     * Get payment progress percentage.
     */
    public function getPaymentProgressAttribute()
    {
        if ($this->amount == 0) {
            return 0;
        }
        
        return min(100, round(($this->amount_paid / $this->amount) * 100));
    }
} 