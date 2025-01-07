<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'issuer_id' => 'integer',
            'classification' => 'string',
            'title' => 'string',
            'status' => 'string',
            'worker_id' => 'integer',
        ];
    }
}
