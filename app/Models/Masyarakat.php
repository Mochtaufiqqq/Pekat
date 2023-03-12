<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    use HasFactory;

    protected $table = 'masyarakats';

    protected $primaryKey = 'id';

    protected $fillable = [
    'nik',
    'nama',
    'username',
    'alamat',
    'email',
    'password',
    'telp',
    'tgl_lahir',
    'foto_ktp',
    'foto_profil'
];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }

}
