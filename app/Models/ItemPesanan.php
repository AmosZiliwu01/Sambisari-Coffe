<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPesanan extends Model
{

    protected $table = 'item_pesanan';

    protected $fillable = [
        'idpesanan',
        'idproduct',
        'qty',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'idproduct');
    }
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'idpesanan');
    }
}
