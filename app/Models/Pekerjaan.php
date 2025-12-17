<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pekerjaan extends Model
{
    use HasFactory, SoftDeletes; // Tambahan HasFactory - Mirna

    protected $table = 'pekerjaan';

    protected $fillable = ['nama', 'deskripsi'];

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'pekerjaan_id');
    }
}
