<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    public $incrementing = false;

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
