<?php

namespace App\Services;

class CustomerDetailsService
{
    public function addCustomerDetails(object $order, string $name, string $email): bool
    {
        return $order->update([
            'customer_details' => [
                'name' => $name,
                'email' => $email
            ]
        ]);
    }
}