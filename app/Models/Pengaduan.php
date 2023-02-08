<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pengaduans';

    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
    'tgl_pengaduan',
    'nik',
    'isi_laporan',
    'lokasi_kejadian',
    'hide_identitas',
    'hide_laporan',
    'foto',
    'status'
];

    protected $dates = ['tgl_pengaduan','deleted_at'];

    public function user ()
    {
        return $this->hasOne(Masyarakat::class,'nik','nik');
    }

    // public function tanggapan()
    // {
    //     return $this->hasMany(Tanggapan::class,'id_petugas','id_pengaduan');
    // }

    // public function petugas()
    // {
    //     return $this->belongsTo(Petugas::class,);
    // }
}
