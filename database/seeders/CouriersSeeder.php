<?php

namespace Database\Seeders;

use App\Models\Courier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouriersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $couriers = [
            ['name' => 'TCS'],
            ['name' => 'Leopards']
            ];

        foreach ($couriers as $courier){
                Courier::create($courier);
        }

    }
}
