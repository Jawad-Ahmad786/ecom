<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentStatus;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $statuses = ['paid', 'partial'];

         foreach ($statuses as $status) {
             PaymentStatus::create(['name' => $status]);
         }
    }
}
