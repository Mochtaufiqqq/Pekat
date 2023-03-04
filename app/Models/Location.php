<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['id_pengaduan','location','latitude','longitude'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
