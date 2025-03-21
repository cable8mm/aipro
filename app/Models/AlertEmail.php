<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Nova\Actions\Actionable;

class AlertEmail extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'name' => 'string',
            'action_name' => 'string',
        ];
    }

    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
