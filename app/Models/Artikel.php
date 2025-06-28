<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable =['judul','slug','body','kategori_id','user_id','is_actived', 'gambar_artikel','views'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class ,  'kategori_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class ,  'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class , 'artikel_tag','artikel_id' ,'tag_id');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class);
    }
}
