<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterOptionGoodRequest extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'requester_id' => 'integer',
            'worker_id' => 'integer',
            'title' => 'string',
            'request_file_url' => 'string',
            'status' => 'string',
            'respond_file_url' => 'string',
        ];
    }
}
