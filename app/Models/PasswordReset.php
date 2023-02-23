<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $table = 'password_resets';

    protected $fillable = ['nik_user','petugas_id','token'];

    public function user()
    {
        return $this->hasMany(Masyarakat::class,'nik_user');
    }

    public function officer()
    {
        return $this->hasMany(Petugas::class, 'petugas_id');
    }
}
