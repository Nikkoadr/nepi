<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPaudSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategori_paud')->insert([
            [
                'nama' => 'TK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'KB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'TPA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'SPS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
