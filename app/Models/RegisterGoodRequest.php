<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterGoodRequest extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'requester_id' => 'integer',
            'title' => 'string',
            'request_file_url' => 'string',
            'worker_id' => 'integer',
            'respond_file_url' => 'string',
            'has_supplier_monitoring_price' => 'integer',
            'status' => 'string',
        ];
    }
}
