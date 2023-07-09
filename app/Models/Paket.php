<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'paket';
    protected $fillable = [
        'nama',
        'deskripsi',
        'masa_aktif',
        'potongan_harga',
        'status'
    ];
}
