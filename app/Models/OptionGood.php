<?php

namespace App\Models;

use Cable8mm\GoodCode\Enums\GoodCodeType;
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
            $optionGood->updateSpecificFields();
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

    /**
     * Generate specific fields for the option good.
     *
     * @return bool The method returns the result of success or fail
     */
    public function updateSpecificFields(): bool
    {
        if (is_null($this->master_code)) {
            $this->master_code = GoodCodeType::OPTION->prefix().$this->id;
        }

        $this->option_count = $this->optionGoodOptions()->count();

        return $this->saveQuietly();
    }
}
