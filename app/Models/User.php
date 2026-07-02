<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use App\Notifications\InquiryReplyNotification;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'role_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roleRelation()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function isAdmin(): bool
    {
        if ($this->role === 'admin') {
            return true;
        }

        return $this->roleRelation?->name === 'admin';
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }

    public function hasUnreadInbox(): bool
    {
        return $this->unreadInboxCount() > 0;
    }

    public function unreadInboxCount(): int
    {
        return $this->unreadNotifications()
            ->where('type', InquiryReplyNotification::class)
            ->count();
    }
}
