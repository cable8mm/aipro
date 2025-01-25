<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Setting extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'key' => 'string',
            'value' => 'string',
            'memo' => 'string',
        ];
    }

    /**
     * Retrieves the value of the setting by key.
     */
    public static function get(string $key): string
    {
        return static::where('key', $key)->first()->value;
    }
}
