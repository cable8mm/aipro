<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class HelpfulFile extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function (HelpfulFile $helpfulFile) {
            $helpfulFile->author_id = $helpfulFile->author_id ?? Auth::user()->id ?? null;
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
