<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking'; 

    protected $fillable = [
        'ruangan_id', 'nama_pengunjung', 'kontak_pengunjung', 'waktu_pemakaian_awal', 'waktu_pemakaian_akhir', 'tanggal'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
