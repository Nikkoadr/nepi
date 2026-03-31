<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IzinLembagaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('izin_lembaga')->insert([

            // =======================
            // PAUD (1–10)
            // =======================
            ['lembaga_id' => 1, 'no_sertifikat' => '421.9/1770', 'masa_berlaku' => '2024-08-13'],
            ['lembaga_id' => 2, 'no_sertifikat' => '421.9/4931', 'masa_berlaku' => '2026-12-30'],
            ['lembaga_id' => 3, 'no_sertifikat' => '421.9/5038', 'masa_berlaku' => '2027-10-15'],
            ['lembaga_id' => 4, 'no_sertifikat' => '421.9/3311', 'masa_berlaku' => '2025-07-31'],
            ['lembaga_id' => 5, 'no_sertifikat' => '421.9/0607', 'masa_berlaku' => '2025-01-31'],
            ['lembaga_id' => 6, 'no_sertifikat' => '100.3.12/1207', 'masa_berlaku' => '2028-02-29'],
            ['lembaga_id' => 7, 'no_sertifikat' => '421.9/3005', 'masa_berlaku' => '2025-01-31'],
            ['lembaga_id' => 8, 'no_sertifikat' => '100.3.12/2035', 'masa_berlaku' => '2028-01-28'],
            ['lembaga_id' => 9, 'no_sertifikat' => '421.9/4970', 'masa_berlaku' => '2026-02-23'],
            ['lembaga_id' => 10, 'no_sertifikat' => '100.3.12/1656', 'masa_berlaku' => '2026-06-30'],

            // =======================
            // PKBM (11–20)
            // =======================
            ['lembaga_id' => 11, 'no_sertifikat' => '421.9/1329', 'masa_berlaku' => '2025-02-13'],
            ['lembaga_id' => 12, 'no_sertifikat' => '100.3.12/1555', 'masa_berlaku' => '2027-12-03'],
            ['lembaga_id' => 13, 'no_sertifikat' => '421.9/4699', 'masa_berlaku' => '2027-06-25'],
            ['lembaga_id' => 14, 'no_sertifikat' => '100.3.12/1830', 'masa_berlaku' => '2028-05-27'],
            ['lembaga_id' => 15, 'no_sertifikat' => '100.3.12/1072', 'masa_berlaku' => '2027-12-03'],
            ['lembaga_id' => 16, 'no_sertifikat' => '421.9/4624', 'masa_berlaku' => '2025-09-22'],
            ['lembaga_id' => 17, 'no_sertifikat' => '421.9/4168', 'masa_berlaku' => '2026-11-19'],
            ['lembaga_id' => 18, 'no_sertifikat' => '421.9/2486', 'masa_berlaku' => '2021-03-02'],
            ['lembaga_id' => 19, 'no_sertifikat' => '421.9/3313', 'masa_berlaku' => '2026-07-27'],
            ['lembaga_id' => 20, 'no_sertifikat' => '421.9/3461', 'masa_berlaku' => '2024-12-03'],

            // =======================
            // LKP (21–30)
            // =======================
            ['lembaga_id' => 21, 'no_sertifikat' => '421.9/2288', 'masa_berlaku' => null],
            ['lembaga_id' => 22, 'no_sertifikat' => '421.9/0742', 'masa_berlaku' => '2023-04-12'],
            ['lembaga_id' => 23, 'no_sertifikat' => '421.9/2533', 'masa_berlaku' => '2022-06-24'],
            ['lembaga_id' => 24, 'no_sertifikat' => '421.9/0081', 'masa_berlaku' => '2023-07-01'],
            ['lembaga_id' => 25, 'no_sertifikat' => '421.9/0960', 'masa_berlaku' => '2020-07-04'],
            ['lembaga_id' => 26, 'no_sertifikat' => '421.9/0000', 'masa_berlaku' => null],
            ['lembaga_id' => 27, 'no_sertifikat' => '421.9/1913', 'masa_berlaku' => '2026-03-17'],
            ['lembaga_id' => 28, 'no_sertifikat' => '421.9/0374', 'masa_berlaku' => '2024-12-17'],
            ['lembaga_id' => 29, 'no_sertifikat' => '100.3.12/1067', 'masa_berlaku' => '2027-10-15'],
            ['lembaga_id' => 30, 'no_sertifikat' => '100.3.12/1862', 'masa_berlaku' => '2028-07-23'],

        ]);
    }
}
