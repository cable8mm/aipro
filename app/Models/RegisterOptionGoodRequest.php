<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class RegisterOptionGoodRequest extends Model
{
    use Actionable, HasFactory;

    protected $with = ['author', 'worker'];

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'request_file_url' => 'string',
            'respond_file_url' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (RegisterOptionGoodRequest $registerOptionGoodRequest) {
            $registerOptionGoodRequest->author_id = $registerOptionGoodRequest->author_id ?? Auth::user()->id;
        });
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
