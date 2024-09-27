<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    // Define the table name (if different from default 'subscriptions')
    protected $table = 'subscriptions';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'type',
        'stripe_id',
        'stripe_status',
        'stripe_price',
        'quantity',
        'trial_ends_at',
        'ends_at',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'trial_ends_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to filter active subscriptions.
     */
    public function scopeActive($query)
    {
        return $query->where('stripe_status', 'active');
    }

    /**
     * Scope to filter subscriptions ending this month.
     */
    public function scopeEndingThisMonth($query)
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        return $query->whereBetween('ends_at', [$startOfMonth, $endOfMonth]);
    }
}
