<?php

namespace App\Models;

use Cable8mm\GoodCode\Enums\GoodCodeType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
     * Gets option fitted from the option field of `OrderSheetInvoice` table
     *
     * @param  string  $optionName  The name of the option field of `OrderSheetInvoice` table
     * @return OptionGoodOption The method returns the option
     *
     * @see https://stackoverflow.com/questions/472063/mysql-what-is-a-reverse-version-of-like
     */
    public function option(string $optionName): OptionGoodOption
    {
        return $this->optionGoodOptions()->where(DB::raw('\''.$optionName.'\''), 'like', DB::raw("CONCAT('%', name, '%')"))->first();
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

    public static function findMasterCode(string $code): OptionGood
    {
        return static::where('master_code', $code)->first();
    }
}
