<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class RegisterGoodRequest extends Model
{
    use Actionable, HasFactory;

    protected $with = ['author', 'worker'];

    protected function casts(): array
    {
        return [
            'author_id' => 'integer',
            'title' => 'string',
            'request_file_url' => 'string',
            'worker_id' => 'integer',
            'respond_file_url' => 'string',
            'has_supplier_monitoring_price' => 'integer',
            'status' => 'string',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (RegisterGoodRequest $registerGoodRequest) {
            $registerGoodRequest->author_id = $registerGoodRequest->author_id ?? Auth::user()->id;
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
