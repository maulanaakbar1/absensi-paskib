<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = ['siswa_id', 'tanggal', 'jam_masuk', 'status', 'keterangan'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
