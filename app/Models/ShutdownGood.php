<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class ShutdownGood extends Model
{
    use HasFactory;

    protected $with = ['author'];

    protected function casts(): array
    {
        return [
            'master_code' => 'string',
            'title' => 'string',
            'reason' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ShutdownGood $shutdownGood) {
            $shutdownGood->author_id = $shutdownGood->author_id ?? Auth::user()->id;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
