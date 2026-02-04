<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Contact Model
 * 
 * Represents contact form submissions from website visitors.
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $subject
 * @property string $message
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property int|null $read_by
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'is_read',
        'read_at',
        'read_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user who marked this contact as read.
     */
    public function readByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'read_by');
    }

    /**
     * Scope a query to only include unread contacts.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Mark the contact as read.
     */
    public function markAsRead(?int $userId = null): void
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
            'read_by' => $userId,
        ]);
    }
}
