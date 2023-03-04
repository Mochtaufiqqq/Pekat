<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengaduan;

class FotoLaporan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['folder','image','pengaduan_id'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
