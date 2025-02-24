<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan'; 

    protected $fillable = [
        'pic_id', 
        'lantai', 
        'nama_ruangan', 
        'kapasitas_ruangan',
        'deskripsi',   // Kolom baru
        'fasilitas', // Kolo, baru
    ];

    public function pic()
    {
        return $this->belongsTo(Pic::class);
    }
}
# ruangan
