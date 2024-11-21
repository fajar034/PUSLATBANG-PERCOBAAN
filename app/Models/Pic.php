<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    protected $table = 'pic'; 

    protected $fillable = [
        'nama_pic', 'no_telepon'
    ];
}
