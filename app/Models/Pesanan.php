<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'nama_pelanggan',
        'total_harga',
        'product_id',
        'status',
        'iduser',
        'iduser',
    ];

//    public function product()
//    {
//        return $this->belongsTo(Product::class);
//    }
}
