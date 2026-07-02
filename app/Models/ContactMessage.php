<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'property_id',
        'rent_property_id',
        'inquiry_type',
        'is_read',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function rentProperty(): BelongsTo
    {
        return $this->belongsTo(RentProperty::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ContactMessageReply::class);
    }

    public static function inquiryTypeFromSubject(string $subject): string
    {
        return match ($subject) {
            'Apply to Rent' => 'apply_to_rent',
            'Schedule a Viewing' => 'schedule_viewing',
            default => 'general',
        };
    }

    public function resolveUser(): ?User
    {
        if ($this->user_id) {
            return $this->user;
        }

        return User::where('email', $this->email)->first();
    }

    public function scopeForUser($query, User $user)
    {
        return $query->where(function ($q) use ($user) {
            $q->where('user_id', $user->id)
                ->orWhere('email', $user->email);
        });
    }
}
