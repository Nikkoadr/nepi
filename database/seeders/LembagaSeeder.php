<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LembagaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lembaga')->insert([
            [
                'jenis_lembaga_id' => 1, // PKBM
                'kategori_paud_id' => null,
                'npsn' => 'PKBM001',
                'nama_lembaga' => 'PKBM Cerdas Bangsa',
                'pengelola' => 'Budi Santoso',
                'alamat' => 'Cirebon',
                'telepon' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_lembaga_id' => 2, // LKP
                'kategori_paud_id' => null,
                'npsn' => 'LKP001',
                'nama_lembaga' => 'LKP Skill Maju',
                'pengelola' => 'Siti Aminah',
                'alamat' => 'Cirebon',
                'telepon' => '082345678901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_lembaga_id' => 3, // PAUD
                'kategori_paud_id' => 1, // TK
                'npsn' => 'PAUD001',
                'nama_lembaga' => 'TK Ceria',
                'pengelola' => 'Dewi Lestari',
                'alamat' => 'Cirebon',
                'telepon' => '083456789012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_lembaga_id' => 3, // PAUD
                'kategori_paud_id' => 2, // KB
                'npsn' => 'PAUD002',
                'nama_lembaga' => 'KB Melati',
                'pengelola' => 'Ahmad Fauzi',
                'alamat' => 'Cirebon',
                'telepon' => '084567890123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jenis_lembaga_id' => 3, // PAUD
                'kategori_paud_id' => 3, // TPA
                'npsn' => 'PAUD003',
                'nama_lembaga' => 'TPA Kasih Ibu',
                'pengelola' => 'Nur Aisyah',
                'alamat' => 'Cirebon',
                'telepon' => '085678901234',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}