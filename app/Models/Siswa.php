<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = ['user_id', 'ekstrakurikuler_id', 'nis', 'kelas', 'jenis_kelamin'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ekstrakurikuler() {
        return $this->belongsTo(Ekstrakurikuler::class);
    }
}
