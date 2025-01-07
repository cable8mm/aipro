<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayautoMasterCode extends Model
{
    use HasFactory;

    protected $primaryKey = 'playauto_master_code';

    public $incrementing = false;

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'playauto_master_code' => 'string'
        ];
    }
}
