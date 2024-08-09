<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tracking_no', 'customer_name', 'customer_email', 'customer_address', 'customer_mobile_no', 'city_id', 'shipping_method_id', 'grand_total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function statuses()
    {
        return $this->belongsToMany(OrderStatus::class);
    }
    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }
}
