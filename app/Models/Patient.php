<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'email',
        'phone',
        'address',
        'service_id',
        'notes',
    ];

    /**
     * Get the service that the patient is registered for.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    /**
     * Get all bills associated with this patient.
     */
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
    
    /**
     * Get the patient's full name.
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    
    /**
     * Check if the patient has any recent services.
     */
    public function hasRecentService()
    {
        return $this->service()->exists();
    }
    
    /**
     * Get the most recent bill for this patient.
     */
    public function getRecentBillAttribute()
    {
        return $this->bills()->orderBy('created_at', 'desc')->first();
    }
} 