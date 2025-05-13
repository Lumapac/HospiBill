<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'duration',
        'requirements',
        'availability',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];
    
    /**
     * Get the patients that are using this service.
     */
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
    
    /**
     * Get all bills associated with this service.
     */
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
    
    /**
     * Format the price with currency symbol.
     */
    public function getFormattedPriceAttribute()
    {
        return '₱' . number_format($this->price, 2);
    }
    
    /**
     * Get count of patients using this service.
     */
    public function getPatientCountAttribute()
    {
        return $this->patients()->count();
    }
}
