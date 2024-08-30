<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Islamabad', 'state_id' => 7],
            ['name' => 'Karachi', 'state_id' => 2],
            ['name' => 'Lahore', 'state_id' => 1],
            ['name' => 'Faisalabad', 'state_id' => 1],
            ['name' => 'Rawalpindi', 'state_id' => 1],
            ['name' => 'Multan', 'state_id' => 1],
            ['name' => 'Peshawar', 'state_id' => 3],
            ['name' => 'Quetta', 'state_id' => 4],
            ['name' => 'Gujranwala', 'state_id' => 1],
            ['name' => 'Sialkot', 'state_id' => 1],
            ['name' => 'Bahawalpur', 'state_id' => 1],
            ['name' => 'Sukkur', 'state_id' => 2],
            ['name' => 'Hyderabad', 'state_id' => 2],
            ['name' => 'Mardan', 'state_id' => 3],
            ['name' => 'Sargodha', 'state_id' => 1],
            ['name' => 'Sheikhupura', 'state_id' => 1],
            ['name' => 'Jhelum', 'state_id' => 1],
            ['name' => 'Dera Ghazi Khan', 'state_id' => 1],
            ['name' => 'Kotli', 'state_id' => 5],
            ['name' => 'Mirpur', 'state_id' => 5],
            ['name' => 'Chiniot', 'state_id' => 1],
            ['name' => 'Okara', 'state_id' => 1],
            ['name' => 'Nawabshah', 'state_id' => 2],
            ['name' => 'Larkana', 'state_id' => 2],
            ['name' => 'Sahiwal', 'state_id' => 1],
            ['name' => 'Khushab', 'state_id' => 1],
            ['name' => 'Kasur', 'state_id' => 1],
            ['name' => 'Mingora', 'state_id' => 3],
            ['name' => 'Bannu', 'state_id' => 3],
            ['name' => 'Haripur', 'state_id' => 3],
            ['name' => 'Abbotabad', 'state_id' => 3],
            ['name' => 'Liaquatpur', 'state_id' => 1],
            ['name' => 'Tando Adam', 'state_id' => 2],
            ['name' => 'Dera Ismail Khan', 'state_id' => 3],
            ['name' => 'Pakpattan', 'state_id' => 1],
            ['name' => 'Jhang', 'state_id' => 1],
            ['name' => 'Khanewal', 'state_id' => 1],
            ['name' => 'Jaranwala', 'state_id' => 1],
            ['name' => 'Gujrat', 'state_id' => 1],
            ['name' => 'Bhakkar', 'state_id' => 1],
            ['name' => 'Sadiqabad', 'state_id' => 1],
            ['name' => 'Chakwal', 'state_id' => 1],
            ['name' => 'Mianwali', 'state_id' => 1],
            ['name' => 'Rajanpur', 'state_id' => 1],
            ['name' => 'Tando Allahyar', 'state_id' => 2],
            ['name' => 'Tando Muhammad Khan', 'state_id' => 2],
            ['name' => 'Noshehra', 'state_id' => 3],
            ['name' => 'Swat', 'state_id' => 3],
            ['name' => 'Swabi', 'state_id' => 3],
            ['name' => 'Jauharabad', 'state_id' => 1],
            ['name' => 'Khairpur', 'state_id' => 2],
            ['name' => 'Mandi Bahauddin', 'state_id' => 1],
            ['name' => 'Pattoki', 'state_id' => 1],
            ['name' => 'Mirpur Khas', 'state_id' => 2],
            ['name' => 'Umarkot', 'state_id' => 2],
            ['name' => 'Jacobabad', 'state_id' => 2],
            ['name' => 'Sanghar', 'state_id' => 2],
            ['name' => 'Dadu', 'state_id' => 2],
            ['name' => 'Shikarpur', 'state_id' => 2],
            ['name' => 'Loralai', 'state_id' => 4],
            ['name' => 'Chaman', 'state_id' => 4],
            ['name' => 'Zhob', 'state_id' => 4],
            ['name' => 'Gwadar', 'state_id' => 4],
            ['name' => 'Kohat', 'state_id' => 3],
            ['name' => 'Lakki Marwat', 'state_id' => 3],
            ['name' => 'Hafizabad', 'state_id' => 1],
            ['name' => 'Mansehra', 'state_id' => 3],
            ['name' => 'Muzaffarabad', 'state_id' => 5],
            ['name' => 'Rawalakot', 'state_id' => 5],
        ];

        foreach($cities as $city)
        {
            City::create($city);
        }

    }
}
