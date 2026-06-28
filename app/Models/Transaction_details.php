<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction_details extends Model
{
    use HasFactory;

   protected $table = 'transaction_details';

    protected $fillable = [
        'transaction_id',
        'product_id',
        'jumlah',
        'harga_saat_transaksi',
        'subtotal',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'harga_saat_transaksi' => 'float',
        'subtotal' => 'float',
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transactions::class, 'transaction_id', 'id');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
