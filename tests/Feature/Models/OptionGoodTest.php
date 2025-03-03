<?php

namespace Tests\Feature\Models;

use App\Models\OptionGood;
use App\Models\OptionGoodOption;
use Cable8mm\GoodCode\Enums\GoodCodeType;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OptionGoodTest extends TestCase
{
    use RefreshDatabase;

    public function test_option_method(): void
    {
        $this->seed([
            UserSeeder::class,
        ]);

        $optionGood = OptionGood::factory()->create();

        OptionGoodOption::factory()->state([
            'option_good_id' => $optionGood->id,
            'name' => 'option one',
        ])->create();

        OptionGoodOption::factory()->state([
            'option_good_id' => $optionGood->id,
            'name' => 'option two',
        ])->create();

        $this->assertNotNull($optionGood->option('this is a good option one'));

        $this->assertNotNull($optionGood->option('this is a good option two'));

        $this->assertNull($optionGood->option('this is a good option three'));
    }

    public function test_update_specific_fields_method(): void
    {
        $this->seed([
            UserSeeder::class,
        ]);

        $optionGood = OptionGood::factory()->state([
            'author_id' => 1,
            'goods_code' => null,
        ])->create();

        OptionGoodOption::factory()->state([
            'option_good_id' => $optionGood->id,
        ])->count(3)->create();

        $optionGood->updateSpecificFields();

        $this->assertSame(GoodCodeType::OPTION->prefix().$optionGood->id, $optionGood->goods_code);

        $this->assertSame(3, $optionGood->option_count);
    }

    public function test_find_goods_code_method(): void
    {
        $this->seed([
            UserSeeder::class,
        ]);

        $optionGood = OptionGood::factory()->state([
            'author_id' => 1,
            'goods_code' => null,
        ])->create();

        $optionGood->updateSpecificFields();

        $this->assertNotNull($optionGood->findGoodsCode(GoodCodeType::OPTION->prefix().$optionGood->id));
    }
}
