<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class,'id_kategori');
    }
}
