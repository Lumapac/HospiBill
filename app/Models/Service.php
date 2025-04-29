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
     * Get the patients that are using this service.
     */
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
