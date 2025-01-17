<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Nova\Actions\Actionable;

class RegisterOptionGoodRequest extends Model
{
    use Actionable, HasFactory;

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'request_file_url' => 'string',
            'respond_file_url' => 'string',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}
