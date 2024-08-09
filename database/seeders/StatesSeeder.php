<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'Punjab'],
            ['name' => 'Sindh'],
            ['name' => 'Khyber Pakhtunkhwa'],
            ['name' => 'Balochistan'],
            ['name' => 'Azad Jammu and Kashmir'],
            ['name' => 'Gilgit-Baltistan'],
            ['name' => 'Islamabad Capital Territory']
        ];

        foreach($states as $state)
        {
            State::create($state);
        }
    }
}
