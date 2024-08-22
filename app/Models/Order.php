<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tracking_no', 'customer_name', 'customer_email', 'customer_address', 'customer_mobile_no', 'city_id', 'shipping_method_id', 'grand_total'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function statuses(): BelongsToMany
    {
        return $this->belongsToMany(OrderStatus::class)->withTimestamps();
    }
    public function payments(): HasMany
    {
        return $this->hasMany(OrderPayment::class);
    }
    public function shipment(): HasOne
    {
        return $this->hasOne(Shipment::class);
    }
    public static function pending(Order $order): bool
    {
        $pendingStatus = OrderStatus::where('name', 'pending')->first()->id;
        return $order->statuses()->where('order_id', $order->id)->where('order_status_id', $pendingStatus)->exists();
    }
    public static function processing(Order $order): bool
    {
        $processingStatus = OrderStatus::where('name', 'processing')->first()->id;
        return $order->statuses()->where('order_id', $order->id)->where('order_status_id', $processingStatus)->exists();
    }
    public static function completed(Order $order): bool
    {
        $completeStatus = OrderStatus::where('name', 'completed')->first()->id;
        return $order->statuses()->where('order_status_id', $completeStatus)->exists();
    }
    public static function cancelled(Order $order): bool
    {
        $cancelledStatus = OrderStatus::where('name', 'cancelled')->first()->id;
        return $order->statuses()->where('order_status_id', $cancelledStatus)->exists();
    }
    public static function latestPendingOrder(Order $order): bool
    {
        $latestStatus = $order->statuses()->orderBy('pivot_created_at', 'desc')->first();
        return $latestStatus->pivot->order_status_id === 1;
    }
}
