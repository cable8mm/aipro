<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertEmail extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'action_name' => 'string',
            'email_list' => 'string'
        ];
    }
}
