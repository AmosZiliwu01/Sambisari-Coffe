<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;


    public static function getLastCode($prefix)
    {
        $lastNumber = (int)Transaction::query()
            ->where('code', 'like', $prefix . '%')
            ->withTrashed()
            ->get()->count();
        return $prefix . str_pad(($lastNumber + 1), 4, '0', STR_PAD_LEFT);

    }

    public function ItemTransaction()
    {
        return $this->hasMany(ItemTransaction::class, 'id_transaction');
    }


}
