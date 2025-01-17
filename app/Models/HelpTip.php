<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class HelpTip extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'word' => 'string',
            'help_tip' => 'string',
        ];
    }
}
