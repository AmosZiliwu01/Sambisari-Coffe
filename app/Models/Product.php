<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'barcode',
        'name',
        'price',
        'gambar_product',
        'id_kategori',
        'total_views',
        'isi_product'
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    public function ItemTransaction()
    {
        return $this->hasManyThrough(ItemTransaction::class, Transaction::class, 'id', 'id_transaction', 'id');
    }
}
