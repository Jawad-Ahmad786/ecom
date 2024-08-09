<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'cod'],
            ['name' => 'paypal'],
            ['name' => 'stripe'],
            ['name' => 'jazzcash'],
            ['name' => 'easypaisa'],
            ];
        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
