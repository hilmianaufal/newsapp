<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['nama_tag'];

    public function artikels()
    {
        $this->belongsToMany(Artikel::class, 'artikel_tag' ,  'tag_id' , 'artikel_id');
    }
}
