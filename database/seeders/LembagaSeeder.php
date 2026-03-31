<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LembagaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lembaga')->insert([

            // =======================
            // PAUD (10)
            // =======================
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 1, 'npsn' => '20265783', 'nama_lembaga' => 'TK HARAPAN KITA', 'pengelola' => 'IRAWATY DIAH', 'alamat' => 'Cirebon', 'telepon' => '085317945796', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 1, 'npsn' => '69992543', 'nama_lembaga' => 'TK NURUL HASANAH', 'pengelola' => 'RODIYAH', 'alamat' => 'Cirebon', 'telepon' => '082127836058', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 1, 'npsn' => '20265770', 'nama_lembaga' => 'TK SARI PUTRA', 'pengelola' => 'LIES SETIAWATI', 'alamat' => 'Cirebon', 'telepon' => '082318868683', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 2, 'npsn' => '69839546', 'nama_lembaga' => 'KB AL IDZHAR', 'pengelola' => 'DELLI WIRNAWATI', 'alamat' => 'Cirebon', 'telepon' => '085324410128', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 2, 'npsn' => '69839541', 'nama_lembaga' => 'KB AL IQRO', 'pengelola' => 'JUNAEDI', 'alamat' => 'Cirebon', 'telepon' => '085224599245', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 3, 'npsn' => '69929633', 'nama_lembaga' => 'TPA AL IRSYAD', 'pengelola' => 'AMELIA', 'alamat' => 'Cirebon', 'telepon' => '089651899743', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 4, 'npsn' => '69839597', 'nama_lembaga' => 'SPS KRIYAN', 'pengelola' => 'WIDIA ASTUTI', 'alamat' => 'Cirebon', 'telepon' => '082130763036', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 4, 'npsn' => '69839602', 'nama_lembaga' => 'SPS NUSA INDAH', 'pengelola' => 'ONI SUKAESIH', 'alamat' => 'Cirebon', 'telepon' => '085925890369', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 1, 'npsn' => '70049953', 'nama_lembaga' => 'TK MODY ISMANTO', 'pengelola' => 'ERAWATI', 'alamat' => 'Cirebon', 'telepon' => '087829302765', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 3, 'kategori_paud_id' => 1, 'npsn' => '20265736', 'nama_lembaga' => "TK DARU'L HIKAM", 'pengelola' => 'RIKHA WULANDARI', 'alamat' => 'Cirebon', 'telepon' => '085295719122', 'created_at' => now(), 'updated_at' => now()],

            // =======================
            // PKBM (10)
            // =======================
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P2962944', 'nama_lembaga' => 'PKBM Handayani', 'pengelola' => 'Mamah Fatimah', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P2962945', 'nama_lembaga' => 'PKBM At-Thohiriyah', 'pengelola' => 'Rodianah', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P9945770', 'nama_lembaga' => 'PKBM Sunan Gunung Jati', 'pengelola' => 'Dede Suparman', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P9945774', 'nama_lembaga' => 'PKBM Homeschooling', 'pengelola' => 'Erna Aprillia', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P9970445', 'nama_lembaga' => 'PKBM Sekar Sari', 'pengelola' => 'Nana Rohanah', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P9984408', 'nama_lembaga' => 'PKBM Namira', 'pengelola' => 'Finalia', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P9998962', 'nama_lembaga' => 'PKBM Cahaya Ilmu', 'pengelola' => 'Nur Azizah', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P2962941', 'nama_lembaga' => 'PKBM Nurjati', 'pengelola' => 'Kusen Mulyadi', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P2962947', 'nama_lembaga' => 'PKBM Kayuwalang', 'pengelola' => 'Windiyani', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 1, 'kategori_paud_id' => null, 'npsn' => 'P2962942', 'nama_lembaga' => 'PKBM Sultan Agung', 'pengelola' => 'Iwan Andayana', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],

            // =======================
            // LKP (10)
            // =======================
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'K5662153', 'nama_lembaga' => 'LKP BINA VOKALIA', 'pengelola' => 'Shaali Wahyu', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'K5662158', 'nama_lembaga' => 'LKP SISKA', 'pengelola' => 'Sri Sakti', 'alamat' => 'Cirebon', 'telepon' => '0231205009', 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'K5662205', 'nama_lembaga' => 'LKP KUMON', 'pengelola' => 'Ivana Stella', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'LKP0001', 'nama_lembaga' => 'LKP IPIEMS', 'pengelola' => 'Murdiono', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'K5662229', 'nama_lembaga' => 'LKP BTQ', 'pengelola' => 'Sahroni', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'K5662206', 'nama_lembaga' => 'LKP ITP', 'pengelola' => 'Rodijah', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'K9980926', 'nama_lembaga' => 'LKP Bentani', 'pengelola' => 'Monika', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'K5662149', 'nama_lembaga' => 'LKP GET', 'pengelola' => 'Izzul Fata', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'K5662226', 'nama_lembaga' => 'LKP Rumah Belajar', 'pengelola' => 'Irma', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],
            ['jenis_lembaga_id' => 2, 'kategori_paud_id' => null, 'npsn' => 'K5662214', 'nama_lembaga' => 'LKP Budi Cendrawati', 'pengelola' => 'Setiawati', 'alamat' => 'Cirebon', 'telepon' => null, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
