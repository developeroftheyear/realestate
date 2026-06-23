<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'title',
        'address',
        'bedrooms',
        'bathrooms',
        'price',
        'description',
        'image_url',
        'area_sqft',
        'is_featured',
    ];
}
