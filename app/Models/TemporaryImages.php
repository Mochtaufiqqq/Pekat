<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryImages extends Model
{
    use HasFactory;

    protected $table= 'temporary_images';

    protected $fillable = ['folder','file'];
}
