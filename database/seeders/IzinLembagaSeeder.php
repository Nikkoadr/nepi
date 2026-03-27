<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IzinLembagaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('izin_lembaga')->insert([
            [
                'lembaga_id' => 1,
                'no_sertifikat' => 'IZIN-001',
                'masa_berlaku' => '2028-12-31',
                'jenis_izin' => 'baru',
                'status' => 'Aktif',
                'keterangan' => 'Lengkap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'lembaga_id' => 2,
                'no_sertifikat' => 'IZIN-002',
                'masa_berlaku' => '2027-06-30',
                'jenis_izin' => 'perpanjangan',
                'status' => 'Aktif',
                'keterangan' => 'Lengkap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'lembaga_id' => 3,
                'no_sertifikat' => 'IZIN-003',
                'masa_berlaku' => '2026-05-20',
                'jenis_izin' => 'perpanjangan',
                'status' => 'Habis',
                'keterangan' => 'Perlu perpanjangan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'lembaga_id' => 4,
                'no_sertifikat' => 'IZIN-004',
                'masa_berlaku' => '2029-01-01',
                'jenis_izin' => 'baru',
                'status' => 'Aktif',
                'keterangan' => 'Baru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'lembaga_id' => 5,
                'no_sertifikat' => 'IZIN-005',
                'masa_berlaku' => '2025-10-10',
                'jenis_izin' => 'perpanjangan',
                'status' => 'Kadaluarsa',
                'keterangan' => 'Belum diperpanjang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}