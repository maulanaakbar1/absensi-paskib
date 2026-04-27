<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    protected $fillable = ['user_id', 'nip', 'no_telp'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
