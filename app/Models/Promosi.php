<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    protected $table = "promosi";

    protected $primaryKey = "id_promosi";

    protected $fillable = ["judul_promosi", "deskripsi", "image_promosi", "start_date", "end_date", "discount_price", "active_status", "id_product"];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}



