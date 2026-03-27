<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPaud extends Model
{
    protected $table = 'kategori_paud';

    protected $fillable = ['nama'];

    public function lembaga()
    {
        return $this->hasMany(Lembaga::class);
    }
}