<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatesSeeder::class,
            CitiesSeeder::class,
            AdminSeeder::class,
            CouriersSeeder::class,
            PaymentStatusSeeder::class,
            OrderStatusSeeder::class,
            PaymentMethodsSeeder::class,
            CourierCityFeeSeeder::class,
            BrandsSeeder::class,
            CategoriesSeeder::class,
        ]);
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

    }
}
