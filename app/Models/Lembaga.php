<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lembaga';

    protected $fillable = [
        'jenis_lembaga_id',
        'kategori_paud_id',
        'npsn',
        'nama_lembaga',
        'pengelola',
        'alamat',
        'telepon',
    ];
    protected $with = ['jenis', 'kategoriPaud', 'izin'];

    public function jenis()
    {
        return $this->belongsTo(JenisLembaga::class, 'jenis_lembaga_id');
    }

    public function kategoriPaud()
    {
        return $this->belongsTo(KategoriPaud::class, 'kategori_paud_id');
    }

    public function izin()
    {
        return $this->hasOne(IzinLembaga::class, 'lembaga_id');
    }

    public function getEditRouteAttribute()
{
    return match ($this->jenis_lembaga_id) {
        1 => route('pkbm.edit', $this->id),
        2 => route('lkp.edit', $this->id),
        3 => route('paud.edit', $this->id),
        default => '#',
    };
}
}