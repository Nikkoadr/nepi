<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisLembaga extends Model
{
    protected $table = 'jenis_lembaga';

    protected $fillable = ['nama'];

    public function lembaga()
    {
        return $this->hasMany(Lembaga::class);
    }
}