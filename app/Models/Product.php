<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $primaryKey = "id_product";
    protected $fillable = ["judul_product","isi_product","gambar_product","id_kategori"];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
