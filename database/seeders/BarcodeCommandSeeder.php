<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BarcodeCommandSeeder extends Seeder
{
    // ITF-14 format
    // @see http://www.axicon.com/checkdigitcalculator.html
    // 박스 바코드는 DB 일련번호로 만들어 짐.
    private array $barcodeCommands = [
        ['id' => 1, 'name' => '강제검수', 'barcode' => '90000001000019'],	// command 1
        ['id' => 2, 'name' => '검수완료', 'barcode' => '90000001000026'],	// command 2
        ['id' => 7, 'name' => '부분검수완료', 'barcode' => '90000001000071'],	// command 7
        ['id' => 3, 'name' => '검수취소', 'barcode' => '90000001000033'],	// command 3
        ['id' => 4, 'name' => '임시저장', 'barcode' => '90000001000040'],	// command 4
        ['id' => 5, 'name' => '임시저장취소', 'barcode' => '90000001000057'],	// command 5
        ['id' => 6, 'name' => '송장입력', 'barcode' => '90000001000064'],	// command 6
        ['id' => 9, 'name' => '스크롤업', 'barcode' => '90000001000095'],	// command 9
        ['id' => 10, 'name' => '스크롤다운', 'barcode' => '90000001000101'],	// command 10
        ['id' => 11, 'name' => '송장출력', 'barcode' => '90000001000118'],	// command 11
    ];

    private array $barcodeBoxCommands = [
        ['id' => 1000, 'name' => '박스없음', 'barcode' => '90000001010001'],	// command 1000
        ['id' => 1001, 'name' => '박스삭제', 'barcode' => '90000001010018'],	// command 1001
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->barcodeCommands as $command) {
            \App\Models\BarcodeCommand::factory()->create([
                'id' => $command['id'],
                'name' => $command['name'],
                'barcode' => $command['barcode'],
            ]);
        }

        foreach ($this->barcodeBoxCommands as $command) {
            \App\Models\BarcodeCommand::factory()->create([
                'id' => $command['id'],
                'name' => $command['name'],
                'barcode' => $command['barcode'],
            ]);
        }
    }
}
