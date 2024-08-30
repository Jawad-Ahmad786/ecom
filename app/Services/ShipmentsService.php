<?php

namespace App\Services;
use App\Models\Shipment;
use Carbon\Carbon;
class ShipmentsService
{
    public function store(int $orderId, int $courierFeeId) :Shipment
    {
       return Shipment::create([
            'order_id' => $orderId,
            'courier_city_fee_id' => $courierFeeId,
            'date' => Carbon::now()
        ]);
    }
}