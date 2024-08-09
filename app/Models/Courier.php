<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsToMany(City::class, 'courier_city_fee');
    }
}
