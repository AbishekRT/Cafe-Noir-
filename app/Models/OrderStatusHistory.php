<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * OrderStatusHistory Model
 * 
 * Tracks status changes for orders with timestamps and user attribution.
 * 
 * @property int $id
 * @property int $order_id
 * @property int|null $user_id
 * @property string|null $old_status
 * @property string $new_status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class OrderStatusHistory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_status_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'user_id',
        'old_status',
        'new_status',
        'notes',
    ];

    /**
     * Get the order for this status history entry.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the user who made this status change.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status change description.
     */
    public function getDescriptionAttribute(): string
    {
        $statuses = Order::getStatuses();
        $old = $this->old_status ? ($statuses[$this->old_status] ?? $this->old_status) : 'New Order';
        $new = $statuses[$this->new_status] ?? $this->new_status;

        return "Status changed from \"{$old}\" to \"{$new}\"";
    }
}
