<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class PromotionCode extends Model
{
    use Actionable, HasFactory;

    protected $with = ['author'];

    protected function casts(): array
    {
        return [
            'master_code' => 'string',
            'memo' => 'string',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
