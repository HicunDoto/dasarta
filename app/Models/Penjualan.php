<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'paket_id','customer_id','sales_id'
    ];
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
    }
    
    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id', 'id');
    }
}
