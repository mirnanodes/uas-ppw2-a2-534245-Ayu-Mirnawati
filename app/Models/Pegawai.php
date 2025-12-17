<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use SoftDeletes; // Tambahan - Mirna
    protected $table = 'pegawai';
    protected $guarded = []; 

    public function pegawai()
    {
        return $this->hasOne(Pekerjaan::class);
    }
}
