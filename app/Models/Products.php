<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'nama_produk',
        'harga_modal',
        'harga_jual',
        'stok',
        'tersedia',
    ];

    protected $casts = [
        'harga_modal' => 'float',
        'harga_jual' => 'float',
        'stok' => 'integer',
        'tersedia' => 'boolean',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}
