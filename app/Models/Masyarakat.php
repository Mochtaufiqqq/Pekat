<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'masyarakats';

    protected $primaryKey = 'nik';

    protected $fillable = [
    'nik',
    'nama',
    'username',
    'alamat',
    'email',
    'password',
    'telp',
    'tgl_lahir',
    'foto_ktp'
];

}
