<?php

namespace App\Models;

use Cable8mm\GoodCodeParser\Parsers\OptionGood as ParsersOptionGood;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Actionable;

class OptionGood extends Model
{
    use Actionable, HasFactory;

    protected $with = ['author'];

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

    protected static function booted(): void
    {
        static::creating(function (OptionGood $optionGood) {
            $optionGood->author_id = $optionGood->author_id ?? Auth::user()->id;
        });

        static::saved(function (OptionGood $optionGood) {
            if (is_null($optionGood->master_code)) {
                $optionGood->master_code = ParsersOptionGood::PREFIX.$optionGood->id;
                $optionGood->save();
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function optionGoodOptions(): HasMany
    {
        return $this->hasMany(OptionGoodOption::class);
    }
}
