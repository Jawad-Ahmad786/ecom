<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class City extends Model
{
    use HasFactory;

    public function courier(): BelongsToMany
    {
        return $this->belongsToMany(Courier::class, 'courier_city_fee');
    }
}
