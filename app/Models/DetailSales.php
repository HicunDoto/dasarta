<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSales extends Model
{
    use HasFactory;
    protected $table = 'detail_sales';
    protected $fillable = [
        'alamat','no_hp','jenis','users_id'
    ];

    public function sales(){
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
