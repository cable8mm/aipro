<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoodInventorySnapshot extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'cms_maestro_id' => 'integer',
            'ct_good_id' => 'integer',
            'playauto_master_code' => 'string',
            'inventory' => 'integer',
            'type' => 'string',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function good(): BelongsTo
    {
        return $this->belongsTo(Good::class);
    }
}
