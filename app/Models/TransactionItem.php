<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'transactions_id',
        'material',
        'quantity',
        'uom',
        'price'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'products_id');
    }
}

