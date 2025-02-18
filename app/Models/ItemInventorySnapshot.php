<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemInventorySnapshot extends Model
{
    use HasFactory;

    protected $with = ['author', 'item'];

    protected function casts(): array
    {
        return [
            'author_id' => 'integer',
            'item_id' => 'integer',
            'playauto_master_code' => 'string',
            'inventory' => 'integer',
            'type' => 'string',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
