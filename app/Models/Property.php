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
        'agent_id',
    ];

    protected $appends = ['resolved_image_url'];

    public function getResolvedImageUrlAttribute(): string
    {
        if (empty($this->image_url)) {
            return 'https://placehold.co/400x300';
        }

        if (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://')) {
            return $this->image_url;
        }

        return asset('storage/' . $this->image_url);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }
}
