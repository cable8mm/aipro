<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HelpfulFileSeeder extends Seeder
{
    private array $helpfulFiles = [
        [
            'author_id' => 1,
            'attachment' => 'helpful_files/sample_goods_add.xlsx',
            'description' => '상품 업로드용 엑셀파일입니다.',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->helpfulFiles as $helpfulFile) {
            \App\Models\HelpfulFile::factory([
                'author_id' => $helpfulFile['author_id'],
                'attachment' => $helpfulFile['attachment'],
                'description' => $helpfulFile['description'],
            ])->create();
        }
    }
}
