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

    protected $appends = ['resolved_image_url'];
    
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

    public function getResolvedImageUrlAttribute(): string
    {
        if (empty($this->image_url)) {
            return 'https://via.placeholder.com/400x300';
        }

        if (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://')) {
            return $this->image_url;
        }

        return asset('storage/' . $this->image_url);
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }
}