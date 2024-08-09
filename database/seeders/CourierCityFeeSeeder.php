<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class CourierCityFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $courierCities = [
             ['name' => 'Islamabad', 'courier_id' => 1, 'fee' => 1000],
             ['name' => 'Islamabad', 'courier_id' => 2, 'fee' => 800],
             ['name' => 'Karachi', 'courier_id' => 1, 'fee' => 1500],
             ['name' => 'Karachi', 'courier_id' => 2, 'fee' => 1200],
             ['name' => 'Lahore', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Lahore', 'courier_id' => 2, 'fee' => 500],
             ['name' => 'Faisalabad', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Faisalabad', 'courier_id' => 2, 'fee' => 500],
             ['name' => 'Rawalpindi', 'courier_id' => 1, 'fee' => 1000],
             ['name' => 'Rawalpindi', 'courier_id' => 2, 'fee' => 800],
             ['name' => 'Multan', 'courier_id' => 1, 'fee' => 550],
             ['name' => 'Multan', 'courier_id' => 2, 'fee' => 500],
             ['name' => 'Peshawar', 'courier_id' => 1, 'fee' => 1300],
             ['name' => 'Peshawar', 'courier_id' => 2, 'fee' => 1100],
             ['name' => 'Quetta', 'courier_id' => 1, 'fee' => 1900],
             ['name' => 'Quetta', 'courier_id' => 2, 'fee' => 1700],
             ['name' => 'Gujranwala', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Gujranwala', 'courier_id' => 2, 'fee' => 500],
             ['name' => 'Sialkot', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Sialkot', 'courier_id' => 2, 'fee' => 500],
             ['name' => 'Bahawalpur', 'courier_id' => 1, 'fee' => 400],
             ['name' => 'Bahawalpur', 'courier_id' => 2, 'fee' => 350],
             ['name' => 'Sukkur', 'courier_id' => 1, 'fee' => 600],
             ['name' => 'Sukkur', 'courier_id' => 2, 'fee' => 550],
             ['name' => 'Hyderabad', 'courier_id' => 1, 'fee' => 550],
             ['name' => 'Hyderabad', 'courier_id' => 2, 'fee' => 500],
             ['name' => 'Mardan', 'courier_id' => 1, 'fee' => 1000],
             ['name' => 'Mardan', 'courier_id' => 2, 'fee' => 900],
             ['name' => 'Sargodha', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Sargodha', 'courier_id' => 2, 'fee' => 600],
             ['name' => 'Sheikhupura', 'courier_id' => 1, 'fee' => 400],
             ['name' => 'Sheikhupura', 'courier_id' => 2, 'fee' => 300],
             ['name' => 'Jhelum', 'courier_id' => 1, 'fee' => 800],
             ['name' => 'Jhelum', 'courier_id' => 2, 'fee' => 700],
             ['name' => 'Dera Ghazi Khan', 'courier_id' => 1, 'fee' => 400],
             ['name' => 'Dera Ghazi Khan', 'courier_id' => 2, 'fee' => 300],
             ['name' => 'Kotli', 'courier_id' => 1, 'fee' => 1000],
             ['name' => 'Kotli', 'courier_id' => 2, 'fee' => 900],
             ['name' => 'Mirpur', 'courier_id' => 1, 'fee' => 1300],
             ['name' => 'Mirpur', 'courier_id' => 2, 'fee' => 1200],
             ['name' => 'Chiniot', 'courier_id' => 1, 'fee' => 1400],
             ['name' => 'Chiniot', 'courier_id' => 2, 'fee' => 1300],
             ['name' => 'Okara', 'courier_id' => 1, 'fee' => 600],
             ['name' => 'Okara', 'courier_id' => 2, 'fee' => 500],
             ['name' => 'Nawabshah', 'courier_id' => 1, 'fee' => 1700],
             ['name' => 'Nawabshah', 'courier_id' => 2, 'fee' => 1600],
             ['name' => 'Larkana', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Larkana', 'courier_id' => 2, 'fee' => 600],
             ['name' => 'Sahiwal', 'courier_id' => 1, 'fee' => 450],
             ['name' => 'Sahiwal', 'courier_id' => 2, 'fee' => 400],
             ['name' => 'Khushab', 'courier_id' => 1, 'fee' => 1350],
             ['name' => 'Khushab', 'courier_id' => 2, 'fee' => 1250],
             ['name' => 'Kasur', 'courier_id' => 1, 'fee' => 900],
             ['name' => 'Kasur', 'courier_id' => 2, 'fee' => 900],
             ['name' => 'Mingora', 'courier_id' => 1, 'fee' => 1000],
             ['name' => 'Mingora', 'courier_id' => 2, 'fee' => 900],
             ['name' => 'Bannu', 'courier_id' => 1, 'fee' => 1800],
             ['name' => 'Bannu', 'courier_id' => 2, 'fee' => 1700],
             ['name' => 'Haripur', 'courier_id' => 1, 'fee' => 1100],
             ['name' => 'Haripur', 'courier_id' => 2, 'fee' => 1000],
             ['name' => 'Abbotabad', 'courier_id' => 1, 'fee' => 1100],
             ['name' => 'Abbotabad', 'courier_id' => 2, 'fee' => 1000],
             ['name' => 'Liaquatpur', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Liaquatpur', 'courier_id' => 2, 'fee' => 600],
             ['name' => 'Tando Adam', 'courier_id' => 1, 'fee' => 900],
             ['name' => 'Tando Adam', 'courier_id' => 2, 'fee' => 800],
             ['name' => 'Dera Ismail Khan', 'courier_id' => 1, 'fee' => 300],
             ['name' => 'Dera Ismail Khan', 'courier_id' => 2, 'fee' => 200],
             ['name' => 'Pakpattan', 'courier_id' => 1, 'fee' => 750],
             ['name' => 'Pakpattan', 'courier_id' => 2, 'fee' => 700],
             ['name' => 'Jhang', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Jhang', 'courier_id' => 2, 'fee' => 650],
             ['name' => 'Khanewal', 'courier_id' => 1, 'fee' => 250],
             ['name' => 'Khanewal', 'courier_id' => 2, 'fee' => 200],
             ['name' => 'Jaranwala', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Jaranwala', 'courier_id' => 2, 'fee' => 600],
             ['name' => 'Gujrat', 'courier_id' => 1, 'fee' => 500],
             ['name' => 'Gujrat', 'courier_id' => 2, 'fee' => 450],
             ['name' => 'Bhakkar', 'courier_id' => 1, 'fee' => 500],
             ['name' => 'Bhakkar', 'courier_id' => 2, 'fee' => 450],
             ['name' => 'Sadiqabad', 'courier_id' => 1, 'fee' => 800],
             ['name' => 'Sadiqabad', 'courier_id' => 2, 'fee' => 700],
             ['name' => 'Chakwal', 'courier_id' => 1, 'fee' => 1200],
             ['name' => 'Chakwal', 'courier_id' => 2, 'fee' => 1150],
             ['name' => 'Mianwali', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Mianwali', 'courier_id' => 2, 'fee' => 600],
             ['name' => 'Rajanpur', 'courier_id' => 1, 'fee' => 900],
             ['name' => 'Rajanpur', 'courier_id' => 2, 'fee' => 800],
             ['name' => 'Tando Allahyar', 'courier_id' => 1, 'fee' => 300],
             ['name' => 'Tando Allahyar', 'courier_id' => 2, 'fee' => 200],
             ['name' => 'Tando Muhammad Khan', 'courier_id' => 1, 'fee' => 400],
             ['name' => 'Tando Muhammad Khan', 'courier_id' => 2, 'fee' => 300],
             ['name' => 'Noshehra', 'courier_id' => 1, 'fee' => 1300],
             ['name' => 'Noshehra', 'courier_id' => 2, 'fee' => 1200],
             ['name' => 'Swat', 'courier_id' => 1, 'fee' => 1600],
             ['name' => 'Swat', 'courier_id' => 2, 'fee' => 1500],
             ['name' => 'Swabi', 'courier_id' => 1, 'fee' => 800],
             ['name' => 'Swabi', 'courier_id' => 2, 'fee' => 700],
             ['name' => 'Jauharabad', 'courier_id' => 1, 'fee' => 700],
             ['name' => 'Jauharabad', 'courier_id' => 2, 'fee' => 600],
             ['name' => 'Khairpur', 'courier_id' => 1, 'fee' => 400],
             ['name' => 'Khairpur', 'courier_id' => 2, 'fee' => 300],
             ['name' => 'Mandi Bahauddin', 'courier_id' => 1, 'fee' => 250],
             ['name' => 'Mandi Bahauddin', 'courier_id' => 2, 'fee' => 200],
             ['name' => 'Pattoki', 'courier_id' => 1, 'fee' => 1000],
             ['name' => 'Pattoki', 'courier_id' => 2, 'fee' => 950],
             ['name' => 'Mirpur Khas', 'courier_id' => 1, 'fee' => 1500],
             ['name' => 'Mirpur Khas', 'courier_id' => 2, 'fee' => 1400],
             ['name' => 'Umarkot', 'courier_id' => 1, 'fee' => 500],
             ['name' => 'Umarkot', 'courier_id' => 2, 'fee' => 400],
             ['name' => 'Jacobabad', 'courier_id' => 1, 'fee' => 400],
             ['name' => 'Jacobabad', 'courier_id' => 2, 'fee' => 300],
             ['name' => 'Sanghar', 'courier_id' => 1, 'fee' => 1000],
             ['name' => 'Sanghar', 'courier_id' => 2, 'fee' => 900],
             ['name' => 'Dadu', 'courier_id' => 1, 'fee' => 1000],
             ['name' => 'Dadu', 'courier_id' => 2, 'fee' => 950],
             ['name' => 'Shikarpur', 'courier_id' => 1, 'fee' => 1450],
             ['name' => 'Shikarpur', 'courier_id' => 2, 'fee' => 1300],
             ['name' => 'Loralai', 'courier_id' => 1, 'fee' => 1000],
             ['name' => 'Loralai', 'courier_id' => 2, 'fee' => 900],
             ['name' => 'Chaman', 'courier_id' => 1, 'fee' => 1100],
             ['name' => 'Chaman', 'courier_id' => 2, 'fee' => 1050],
             ['name' => 'Zhob', 'courier_id' => 1, 'fee' => 2000],
             ['name' => 'Zhob', 'courier_id' => 2, 'fee' => 1900],
             ['name' => 'Gwadar', 'courier_id' => 1, 'fee' => 2500],
             ['name' => 'Gwadar', 'courier_id' => 2, 'fee' => 2200],
             ['name' => 'Kohat', 'courier_id' => 1, 'fee' => 2100],
             ['name' => 'Kohat', 'courier_id' => 2, 'fee' => 1900],
             ['name' => 'Lakki Marwat', 'courier_id' => 1, 'fee' => 2300],
             ['name' => 'Lakki Marwat', 'courier_id' => 2, 'fee' => 2200],
             ['name' => 'Hafizabad', 'courier_id' => 1, 'fee' => 800],
             ['name' => 'Hafizabad', 'courier_id' => 2, 'fee' => 750],
             ['name' => 'Mansehra', 'courier_id' => 1, 'fee' => 500],
             ['name' => 'Mansehra', 'courier_id' => 2, 'fee' => 400],
             ['name' => 'Muzaffarabad', 'courier_id' => 1, 'fee' => 1700],
             ['name' => 'Muzaffarabad', 'courier_id' => 2, 'fee' => 1650],
             ['name' => 'Rawalakot', 'courier_id' => 1, 'fee' => 2700],
             ['name' => 'Rawalakot', 'courier_id' => 2, 'fee' => 2550],
         ];

         foreach ($courierCities as $courierCity){
             $city = City::where('name', $courierCity['name'])->first();
           if($city){
               DB::table('courier_city_fee')->insert([
                   'city_id' => $city->id,
                   'courier_id' => $courierCity['courier_id'],
                   'fee' => $courierCity['fee'],
               ]);
           }
         }
    }
}
