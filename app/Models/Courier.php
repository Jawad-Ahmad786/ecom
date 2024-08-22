<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Courier extends Model
{
    use HasFactory;

    public function city(): BelongsToMany
    {
        return $this->belongsToMany(City::class, 'courier_city_fee');
    }
}
