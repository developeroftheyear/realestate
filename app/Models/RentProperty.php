<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentProperty extends Model
{
    protected $table = 'rent_properties';
    
    protected $fillable = [
        'title',
        'location',
        'monthly_rent',
        'security_deposit',
        'bedrooms',
        'bathrooms',
        'area_sqft',
        'lease_term',
        'available_from',
        'description',
        'image_url',
        'is_featured',
        'is_pet_friendly',
        'is_furnished'
    ];
    
    protected $casts = [
        'is_featured' => 'boolean',
        'is_pet_friendly' => 'boolean',
        'is_furnished' => 'boolean',
        'available_from' => 'date'
    ];
    
    // Helper method to format rent price
    public function formattedRent()
    {
        return '$' . number_format($this->monthly_rent, 0);
    }
    
    // Helper for deposit
    public function formattedDeposit()
    {
        return '$' . number_format($this->security_deposit, 0);
    }
}