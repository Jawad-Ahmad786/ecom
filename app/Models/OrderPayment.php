<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'payment_status_id', 'payment_method_id', 'paid_amount'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
