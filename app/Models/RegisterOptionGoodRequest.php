<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegisterOptionGoodRequest extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'title' => 'string',
            'request_file_url' => 'string',
            'status' => 'string',
            'respond_file_url' => 'string',
        ];
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}
