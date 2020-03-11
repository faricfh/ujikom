<?php

use Illuminate\Database\Seeder;
use App\Kurir;

class KurirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['kode' => 'jne', 'nama' => 'JNE'],
            ['kode' => 'pos', 'nama' => 'POS'],
            ['kode' => 'tiki', 'nama' => 'TIKI']
        ];
        Kurir::insert($data);
    }
}
