<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';

    protected $fillable = ['id_masyarakat','petugas_id','token'];

    public function user()
    {
        return $this->hasMany(Masyarakat::class,'id_masyarakat');
    }

    public function officer()
    {
        return $this->hasMany(Petugas::class, 'petugas_id');
    }
}
