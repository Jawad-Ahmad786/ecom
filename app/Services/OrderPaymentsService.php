<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentStatus;

class OrderPaymentsService
{
    public function store(array $data, Order $order): array
    {
        if(Order::latestPendingOrder($order)){
            return [
                'status' => 'error',
                'status_code' => 500,
                'message' => 'Payment cannot be processed for pending orders',
            ];
        }
        if (Order::cancelled($order)) {
            return [
                'status' => 'error',
                'status_code' => 500,
                'message' => 'Payment cannot be processed for cancelled orders',
            ];
        }
      if($order->grand_total == 0){
          return [
              'status' => 'error',
              'status_code' => 400,
              'message' => 'Order is already paid'
              ];
      }

      if ($data['paid_amount'] > $order->grand_total) {
          return [
              'status' => 'error',
              'status_code' => 400,
              'message' => 'Paid amount is greater than the total'
             ];
      }

      if($data['paid_amount'] < $order->grand_total){
            $paymentStatus = PaymentStatus::where('name', 'partial')->first()->id;
      }

      if($data['paid_amount'] === $order->grand_total){
            $paymentStatus = PaymentStatus::where('name', 'paid')->first()->id;
      }
     $payment = $order->payments()->create([
           'payment_status_id' => $paymentStatus,
           'payment_method_id' => $data['payment_method_id'],
           'paid_amount' => $data['paid_amount'],
       ]);

      $remainingAmount = $order->grand_total - $data['paid_amount'];
      if($remainingAmount === 0){
           $completedStatus = OrderStatus::where('name', 'completed')->first()->id;
           $order->statuses()->attach($completedStatus);
      }
      $order->update([
            'grand_total' => $remainingAmount
      ]);
        return [
            'status' => 'success',
            'status_code' => 201,
            'message' => 'Payment has been successfully done',
            'payment' => $payment,
        ];
    }
}