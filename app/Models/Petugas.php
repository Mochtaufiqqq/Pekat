<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id_petugas';

    protected $fillable = [
    'nama_petugas',
    'username',
    'alamat',
    'email',
    'password',
    'password',
    'telp',
    'level'
];

    public function tanggapan()
    {
        return $this->belongsTo(Tanggapan::class,'id_petugas','id_petugas');
    }
}
