<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'photo', 
        'bio', 
        'experience_years'
    ];

    protected $appends = ['resolved_photo_url'];

    public function getResolvedPhotoUrlAttribute(): ?string
    {
        if (empty($this->photo)) {
            return null;
        }

        if (str_starts_with($this->photo, 'http://') || str_starts_with($this->photo, 'https://')) {
            return $this->photo;
        }

        return asset('storage/' . $this->photo);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function rentProperties()
    {
        return $this->hasMany(RentProperty::class);
    }
}
