<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'courier_city_fee_id', 'date'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
