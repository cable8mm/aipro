<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Actions\Actionable;

class OptionGood extends Model
{
    use Actionable, HasFactory;

    protected $with = ['user'];

    protected function casts(): array
    {
        return [
            'master_code' => 'string',
            'name' => 'string',
            'option_count' => 'integer',
            'my_shop_sale_option_count' => 'integer',
            'other_shop_sale_option_count' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function optionGoodOptions(): HasMany
    {
        return $this->hasMany(OptionGoodOption::class);
    }
}
