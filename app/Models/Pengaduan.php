<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FotoLaporan;

class Pengaduan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pengaduans';

    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
    'tgl_pengaduan',
    'id_masyarakat',
    'id_kategori',
    'judul_laporan',
    'isi_laporan',
    'lokasi_kejadian',
    'longitude',
    'latitude',
    'hide_identitas',
    'hide_laporan',
    'report_main_image',
    'status'
];

    protected $dates = ['tgl_pengaduan','deleted_at'];

    public function user()
    {
        return $this->hasOne(Masyarakat::class,'id','id_masyarakat');
    }

    public function tanggapan()
    {
        return $this->belongsTo(Tanggapan::class,'id_pengaduan','id_pengaduan');
    }

    public function Images()
    {
        return $this->hasMany(FotoLaporan::class,'pengaduan_id');
    }

    public function Location()
    {
        return $this->hasOne(Location::class,'id_pengaduan');
    }

    public function Kategori()
    {
        return $this->belongsTo(Kategori::class,'id_kategori');
    }


    // public function petugas()
    // {
    //     return $this->belongsTo(Petugas::class,);
    // }

    // public function petugas()
    // {
    //     return $this->belongsTo(Petugas::class,);
    // }
}
