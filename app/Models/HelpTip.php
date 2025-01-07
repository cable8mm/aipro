<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpTip extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'word' => 'string',
            'help_tip' => 'string',
        ];
    }
}
