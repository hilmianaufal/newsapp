<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slides';

    protected $fillable = ['judul_slide', 'link', 'gambar_slide', 'status'];

    protected $hidden = ['created_at', 'updated_at'];
}
