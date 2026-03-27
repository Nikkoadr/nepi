<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisLembagaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_lembaga')->insert([
            [
                'nama' => 'PKBM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'LKP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'PAUD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
