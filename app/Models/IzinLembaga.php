<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IzinLembaga extends Model
{
    protected $table = 'izin_lembaga';

    protected $fillable = [
        'lembaga_id',
        'no_sertifikat',
        'masa_berlaku',
        'status',
        'jenis_izin',
        'keterangan'
    ];


    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class);
    }

    public function kategoriPaud()
    {
        return $this->belongsTo(KategoriPaud::class, 'kategori_paud_id');
    }

    public function izin()
    {
        return $this->hasOne(IzinLembaga::class, 'lembaga_id');
    }

}