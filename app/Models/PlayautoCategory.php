<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayautoCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
